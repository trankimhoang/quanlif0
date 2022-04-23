<?php

namespace App\Http\Controllers\Web\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    public function showLoginForm()
    {
        if (Auth::guard('sv')->check()) {
            return redirect()->route('sv.index');
        } else if (Auth::guard('gv')->check()) {
            return redirect()->route('gv.index');
        }

        return view('web.auth.login');
    }

    public function login(Request $request)
    {
        if (Auth::guard('sv')->check()) {
            return redirect()->route('sv.index');
        } else if (Auth::guard('gv')->check()) {
            return redirect()->route('gv.index');
        }

        $type = $request->get('type');

        if (!empty($type)) {
            if ($type == 'sv') {
                $credentials = $request->only('email', 'password');

                if (Auth::guard('sv')->attempt($credentials)) {
                    // Authentication passed...
                    return redirect()->route('sv.index');
                }

                return redirect()->back()->withErrors(['msg' => 'Sai thông tin đăng nhập, bạn hãy thử lại']);
            } else if ($type == 'gv') {
                $credentials = $request->only('email', 'password');

                if (Auth::guard('gv')->attempt($credentials)) {
                    // Authentication passed...
                    return redirect()->route('gv.index');
                }

                return redirect()->back()->withErrors(['msg' => 'Sai thông tin đăng nhập, bạn hãy thử lại']);
            }
        }
    }

    public function logout(Request $request)
    {
        if (Auth::guard('sv')->check()) {
            Auth::guard('sv')->logout();
        } else if (Auth::guard('gv')->check()) {
            Auth::guard('gv')->logout();
        }

        return redirect()->route('login_user');
    }
}
