<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthUserController extends Controller
{
    public function register()
    {
        return view('client/register');
    }
    public function post_register(Request $request)
    {
        $this->validate($request, [
            'username' => 'required',
            'name'  => 'required',
            'email' => 'required | email:rfc | email:strict',
            'phone' => 'required | numeric',
            'password' => 'required|confirmed|min:6',
        ]);

        if (User::where('email', $request->email)->count() != 0) {
            return back()->with('error', 'Email đã tồn tại');
        }

        $user = new User();
        $user->username = $request->username;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->password = bcrypt($request->password);
        if ($user->save()) {
            return back()->with('success', 'Đăng ký thành công');
        } else {
            return back()->with('error', 'Đăng ký thất bại');
        }
    }
    public function login(Request $request)
    {
        $redirect_uri = $request->redirect_uri;
        return view('client/login', compact('redirect_uri'));
    }
    public function post_login(Request $request)
    {
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required|min:6',
        ]);

        if (Auth::guard('web')->attempt([
            'username' => $request->username,
            'password' => $request->password,
            'role' => 3
        ])) {
            return redirect()->route('user.dashboard');
        }

        Session::flash('error', 'Tài khoản hoặc mật khẩu không chính xác');
        return redirect()->back();
    }
    public function logout()
    {
        Auth::logout();
        return back();
    }
    public function forgot_password()
    {
        return view('client.forgot-password');
    }
    public function post_forgot_password(Request $request)
    {

        $this->validate($request, [
            'email' => 'required | email',
        ]);

        $email = $request->email;

        $checkUser = User::where('email', $email)->first();

        if (!$checkUser) {
            return back()->with('error', 'Địa chỉ email không tồn tại!');
        }

        $code = md5(time() . $email);
        $checkUser->code = $code;
        $checkUser->time_code = Carbon::now();
        $checkUser->save();

        $redirect_uri = route('reset-user-password', ['code' => $checkUser->code, 'email' => $email]);
        $this->sendEmail($checkUser, $redirect_uri);

        return back()->with('success', 'Link lấy lại mật khẩu đã gửi vào email của bạn!');
    }
    public function reset_password(Request $request)
    {
        $email = $request->email;
        $code = $request->code;
        $checkUser = User::where(['email' => $email, 'code' => $code])->first();
        if (!$checkUser) {
            return redirect()->route('forgot-user-password')->with('error', 'Đường dẫn tạo lại mật khẩu không đúng, vui lòng thử lại sau!');
        }
        return view('client.reset-password', compact('email', 'code'));
    }
}
