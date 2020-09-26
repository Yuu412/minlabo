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
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            //'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            //'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    public function pre_check(Request $request)
    {
        $this->validator($request->all())->validate();
        //flash data
        $request->flashOnly('email');

        $email_flag = User::where('email', $request->email)->first();
        if (isset($email_flag)) {
            $token = $email_flag->token;
            if ($token == "default") {
                $error_msg = "すでに仮会員登録は完了しております。
                  本登録がまだの方は登録に使ったメールアドレスをご確認ください。
                  本登録が終了されている方は、以下からログインしてください。";
                return view('auth.register', [
                    'error_msg' => $error_msg,
                ]);
            } else {
                return view('auth.register', [
                    'token' => $token,
                ]);
            }
        } else {
            $bridge_request = $request->all();
            $bridge_request['password_mask'] = '*********';

            return view('auth.register_check')->with($bridge_request);
        }
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
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
        event(new Registered($user = $this->create($request->all())));

        return view('auth.registered', ["email" => $request->email]);
    }


    public function mainRegister($email_token)
    {
        // 使用可能なトークンか
        if (User::where('email_verify_token', $email_token)->exists())
        {
          $user = User::where('email_verify_token', $email_token)->first();

          // 本登録済みユーザーか
          if ($user->status == config('const.USER_STATUS.REGISTER')) //REGISTER=1
          {
            logger("status" . $user->status);
            return view('auth.main.register')->with('message', 'すでに本登録されています。ログインして利用してください。');
          }

          if ($user->save()) {
            $user = User::where('email_verify_token', $email_token)->first();
            $user->status = config('const.USER_STATUS.MAIL_AUTHED');
            $user->role = 5;
            $user->token = uniqid(rand(100, 999));
            $user->save();
            $token = $user->token;

            return view('auth.main.registered', [
              'token' => $token,
            ]);
          }
          else{
            return view('auth.main.register')->with('message', 'メール認証に失敗しました。再度、メールからリンクをクリックしてください。');
          }
        }
        else{
            return view('auth.main.register')->with('message', '無効なトークンです。');
        }
    }
}
