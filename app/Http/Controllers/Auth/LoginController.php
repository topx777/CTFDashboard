<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request as IlluminateRequest;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Request;

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
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function username()
    {
        return 'username';
    }

    /**
     * Function Logueo
     *
     * Function validacion de login
     *
     * @param Request $request Request
     * @return response()->json($array)
     * @throws \Throwable $ex
     **/
    public function login(Request $request)
    {
        if ($request->ajax()) {
            $response = [];
            try {
                $this->validateLogin($request);

                if ($this->hasTooManyLoginAttempts($request)) {

                    $this->fireLockoutEvent($request);
                    throw new \Exception("Demasiados intentos fallidos, de inicio de sesion");
                }

                if ($this->guard()->validate($this->credentials($request))) {
                    if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
                        $response["auth"] = true;
                        if (auth()->user()->admin == 1) {
                            $this->redirectTo = '/admin/home';
                        } else {
                            $this->redirectTo = '/team/dashboard';
                        }
                        $response['intended'] = $this->redirectPath();
                    } else {
                        $this->incrementLoginAttempts($request);
                        throw new \Exception("Usuario no activo");
                    }
                } else {
                    $this->incrementLoginAttempts($request);
                    throw new \Exception("Credenciales incorrectas");
                }
            } catch (\Throwable $ex) {
                $response["auth"] = false;
                $response["msgError"] = $ex->getMessage();
            } finally {
                return response()->json($response);
            }
        }
    }

    // public function authenticated(Request $request)
    // {
    //     if ($request->ajax()) {
    //         $credentials = $request->only('username', 'password');
    //         $response = [];
    //         try {
    //             $response['auth'] = Auth::attempt($credentials, $request->filled('remember'));
    //             if (auth()->check()) {
    //                 if (auth()->user()->admin == 1) {
    //                     $this->redirectTo = '/home';
    //                 } else {
    //                     $this->redirectTo = '/dashboard';
    //                 }
    //             }
    //         } catch (\Throwable $ex) {
    //             $response['auth'] = false;
    //             $response['errorMsg'] = $ex->getMessage();
    //         } finally {
    //             $response["intended"] = $this->redirectPath();
    //             return response()->json($response);
    //         }
    //     }
    // }
}
