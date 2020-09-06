<?php

namespace App\Http\Controllers\Auth;

use App\Mail\EmailVerification;
use Illuminate\Support\Facades\Mail;
use Illuminate\Auth\Events\Registered;
use Carbon\Carbon;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;
    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            //'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            //'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    public function pre_check(Request $request){
      $this->validator($request->all())->validate();
      //flash data
      $request->flashOnly( 'email');

      $bridge_request = $request->all();
      // password マスキング
      $bridge_request['password_mask'] = '*********';

      return view('auth.register_check')->with($bridge_request);
    }


    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $role = 1;

        $user = User::create([
             'email' => $data['email'],
             'password' => Hash::make($data['password']),
             'email_verify_token' => base64_encode($data['email']),
             'role' => $role,
         ]);

         $email = new EmailVerification($user);
         Mail::to($user->email)->send($email);

         return $user;
    }

    public function register(Request $request)
    {
      event(new Registered($user = $this->create( $request->all() )));

      return view('auth.registered');
    }


    public function showForm($email_token)
    {
      // 使用可能なトークンか
      if ( !User::where('email_verify_token', $email_token)->exists() )
      {
          return view('auth.main.register')->with('message', '無効なトークンです。');
      }
      else
      {
          $user = User::where('email_verify_token', $email_token)->first();

          // 本登録済みユーザーか
          if ($user->status == config('const.USER_STATUS.REGISTER')) //REGISTER=1
          {
              logger("status". $user->status );
              return view('auth.main.register')->with('message', 'すでに本登録されています。ログインして利用してください。');
          }

          // ユーザーステータス更新
          $user->status = config('const.USER_STATUS.MAIL_AUTHED');

          if($user->save()) {
              return view('auth.main.register', compact('email_token'));
          }
          else{
              return view('auth.main.register')->with('message', 'メール認証に失敗しました。再度、メールからリンクをクリックしてください。');
          }
      }
    }

    public function mainCheck(Request $request)
      {

        //データ保持用
        $email_token = $request->email_token;

        $user = new User();

        $user->univ_name = $request->univ_name;
        $user->faculty_name = $request->faculty_name;
        $user->department_name = $request->department_name;

        return view('auth.main.register_check', compact('user','email_token'));
      }

    public function mainRegister(Request $request)
    {
      $user = User::where('email_verify_token',$request->email_token)->first();
      $user->status = config('const.USER_STATUS.MAIL_AUTHED');
      $user->role = 5;
      $user->univ_name = $request->univ_name;
      $user->faculty_name = $request->faculty_name;
      $user->department_name = $request->department_name;
      $user->token = uniqid(rand(100, 999));
      $user->save();

      $token = $user->token;

      return view('auth.main.registered',[
        'token' => $token,
      ]);
    }


}
