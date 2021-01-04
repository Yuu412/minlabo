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

use App\Univ_data;
use App\Prefecture_image;

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
        $rules = [
          'password' => 'required|confirmed',
          'password_confirmation' => 'required',
        ];
        $messages = [
          'password.required' => '"パスワード"を入力してください。',
          'password.confirmed' => '"パスワードの確認"はパスワードと同じものを入力してください。',
          'password_confirmation.required' => '"パスワードの確認"を入力してください。"'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect('/register')
                ->withErrors($validator)
                ->withInput();
        }

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

    public function toMainRegister($email_token)
    {
        // 使用可能なトークンか
        if (User::where('email_verify_token', $email_token)->exists()) {
            $user = User::where('email_verify_token', $email_token)->first();

            // 本登録済みユーザーか
            if ($user->status == config('const.USER_STATUS.REGISTER')) //REGISTER=1
            {
                logger("status" . $user->status);
//                todo: 認証失敗時に表示するページを作る
                return view('auth.main.register')->with('message', 'すでに本登録されています。ログインして利用してください。');
            }

            // ユーザーステータス更新
            $user->status = config('const.USER_STATUS.MAIL_AUTHED');

            if ($user->save()) {
                $user->role = 5;
                $user->token = uniqid(rand(100, 999));
                $user->save();
                $token = $user->token;

                $all_prefectures = [
                        "北海道", "青森県", "秋田県", "山形県", "岩手県", "宮城県", "福島県",
                        "東京都", "神奈川県", "埼玉県", "千葉県", "栃木県", "茨城県", "群馬県",
                        "愛知県", "岐阜県", "静岡県", "三重県", "新潟県", "山梨県", "長野県", "石川県", "富山県", "福井県",
                        "大阪府", "兵庫県", "京都府", "滋賀県", "奈良県", "和歌山県",
                        "岡山県", "広島県", "鳥取県", "島根県", "山口県", "香川県", "徳島県", "愛媛県", "高知県",
                        "福岡県", "佐賀県", "長崎県", "熊本県", "大分県", "宮崎県", "鹿児島県", "沖縄県",
                ];
                //$qr = \QrCode::format('svg')->size(300)->generate(config('app.url') . "/review/" . $token);

                return view('auth.main.register', [
                    //"qr" => $qr,
                    "token" => $token,
                    'all_prefectures' => $all_prefectures,
                ]);
            } else {
//                todo: 認証失敗時に表示するページを作る
                return view('auth.main.register')->with('message', 'メール認証に失敗しました。再度、メールからリンクをクリックしてください。');
            }
        } else {
//                todo: 認証失敗時に表示するページを作る
            return view('auth.main.register')->with('message', '無効なトークンです。');
        }
    }

    public function toMain2Register(Request $request)
    {
      $rules = [
          'prefecture_name' => 'required|between:3,4',
      ];

      $messages = [
          'prefecture_name.between' => '都道府県を選択してください。',
      ];

      $validator = Validator::make($request->all(), $rules, $messages);

      if ($validator->fails()) {
          return redirect('/auth.main.register')
              ->withErrors($validator)
              ->withInput();
      }
      $token = $request->input('token');

      $faculty_lib_array = [
          "文学部", "教育学部", "経済学部", "経営学部", "商学部",
          "社会学部", "法学部", "外国語学部", "国際学部", "体育学部",
          "福祉学部", "芸術学部", "観光学部", "神学部", "総合政策学部",
          "音楽学部", "文系その他"
      ];
      $faculty_sci_array = [
          "理学部", "工学部", "理工学部", "情報学部", "農学部", "医学部",
          "看護学部", "薬学部", "歯学部", "建築学部", "海洋学部",
          "スポーツ健康科学部", "芸術工学部", "生命科学部", "理系その他"
      ];
      $prefecture_id = Prefecture_image::where('prefecture_name', $request->input('prefecture_name'))->value('id');
      $prefecture_univ_data = Univ_data::orderBy('created_at', 'asc')->where('prefecture_id', $prefecture_id)->get();

      return view('auth.main.register2', [
          'token' => $token,
          'prefecture_name' => $request->input('prefecture_name'),
          'prefecture_univ_data' => $prefecture_univ_data,
          'faculty_lib_array' => $faculty_lib_array,
          'faculty_sci_array' => $faculty_sci_array,
      ]);
    }

    public function toMainRegisterCheck(Request $request)
    {
      $token = $request->input('token');
      $rules = [
          'univ_name' => 'required|min:3',
          'faculty_name' => 'required|min:3|max:32',
          'department_name' => 'required|min:3|max:32',
      ];

      $messages = [
          'univ_name.required' => '大学を選択してください。',
          'univ_name.min' => '大学を選択してください。',
          'faculty_name.required' => '学部を選択して下さい。',
          'faculty_name.min' => '学部を正しく入力してください。',
          'faculty_name.max' => '名前は32文字以内で入力してください。',
          'department_name.required' => '学科を入力してください。（例:情報系学科）',
          'department_name.min' => '学科を正しく入力してください。（例:情報系学科）',
          'department_name.max' => '学科名は32文字以内で入力してください。',
      ];

      $validator = Validator::make($request->all(), $rules, $messages);

      if ($validator->fails()) {
        $faculty_lib_array = [
            "文学部", "教育学部", "経済学部", "経営学部", "商学部",
            "社会学部", "法学部", "外国語学部", "国際学部", "体育学部",
            "福祉学部", "芸術学部", "観光学部", "神学部", "総合政策学部",
            "音楽学部", "文系その他"
        ];
        $faculty_sci_array = [
            "理学部", "工学部", "理工学部", "情報学部", "農学部", "医学部",
            "看護学部", "薬学部", "歯学部", "建築学部", "海洋学部",
            "スポーツ健康科学部", "芸術工学部", "生命科学部", "理系その他"
        ];
        $prefecture_id = Prefecture_image::where('prefecture_name', $request->input('prefecture_name'))->value('id');
        $prefecture_univ_data = Univ_data::orderBy('created_at', 'asc')->where('prefecture_id', $prefecture_id)->get();

        return view('auth.main.register2',[
          'token' => $token,
          'prefecture_name' => $request->input('prefecture_name'),
          'prefecture_univ_data' => $prefecture_univ_data,
          'faculty_lib_array' => $faculty_lib_array,
          'faculty_sci_array' => $faculty_sci_array,
        ])->withErrors($validator);
      }
      $user = [
        'univ_name' => $request->univ_name,
        'faculty_name' => $request->faculty_name,
        'department_name' => $request->department_name,
        'token' => $token,
      ];

      return view('auth.main.register_check', [
          'user' => $user,
          'prefecture_name' => $request->input('prefecture_name'),
      ]);
    }

    public function mainRegistered(Request $request)
    {
      $user = User::where('token', $request->token)->first();
      if ($user->save()) {
          $user->role = 10;
          $user->univ_name = $request->input('univ_name');
          $user->faculty_name = $request->faculty_name;
          $user->department_name = $request->department_name;
          $user->status = 1;
          //入力データの保存
          $user->save();
      }

      return view('auth.main.registered', [
        'token' => $request->token,
        'user' => $user,
      ]);
    }
}
