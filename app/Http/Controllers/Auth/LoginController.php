<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    use AuthenticatesUsers, RegistersUsers {
        RegistersUsers::guard insteadof AuthenticatesUsers;
        RegistersUsers::redirectPath insteadof AuthenticatesUsers;
    }

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

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|Response|\Illuminate\Routing\Redirector|\Symfony\Component\HttpFoundation\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function login(Request $request)
    {
        $this->validateLogin($request);

        if (User::where($this->username(), $request->get('username'))->count()) {
            if ($this->attemptLogin($request)) {
                return $this->sendLoginResponse($request);
            }

            return $this->sendFailedLoginResponse($request);
        }

        event(new Registered($user = $this->create($request->all())));

        $this->guard()->login($user, $request->filled('remember'));

        return $request->wantsJson()
            ? new Response('', 201)
            : redirect($this->redirectPath());
    }

    public function username()
    {
        return 'username';
    }

    protected function create(array $data)
    {
        return User::create([
            'username' => $data['username'],
            'password' => Hash::make($data['password']),
        ]);
    }

    public function validateLogin(Request $request)
    {
        $request->validate([
            $this->username() => 'required|string|min:3',
            'password' => 'required|string|min:6',
        ]);
    }
}
