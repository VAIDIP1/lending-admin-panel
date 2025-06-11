<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use Illuminate\Support\{
    Arr, Str
};
use Illuminate\Support\Facades\{
    DB, Log, Storage, Auth, Crypt, Session as FacadesSession
};

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function validateEmail(Request $request)
    {
        if ($request->getMethod() == 'GET') {
            $data = $request->all();
            if ($data['email'] != '') {
                $role = (!empty($data['role'])) ? base64_decode($data['role']) : '';
                $count = User::where('email', $data['email']);
                if(!empty($role)) {
                    $count->where('role_id', $role);
                }
                $count = $count->exists();
                if ($count) {
                    return Response::json([
                        'success' => false,
                        'message' => "Email address already taken!",
                    ]);
                } else {
                    return Response::json([
                        'success' => true,
                        'message' => ""
                    ]);
                }
            }
            return Response::json([
                'success' => true,
                'message' => ""
            ]);
        }
    }

    public function store(Request $request)
    {
        dd($request->all());
    }
    
    public function postAdminLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            if (!empty($request->refer_url) && Str::contains($request->refer_url, '/admin')) {
                return redirect($request->refer_url);
            }
            // dd($credentials);
            return redirect()->route('dashboard')->withSuccess('You have Successfully loggedin');
        }

        return redirect()->back()->withInput()->withError('Oppes! You have entered invalid credentials');
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        if ($response = $this->loggedOut($request)) {
            return $response;
        }

        return $request->wantsJson()
            ? new JsonResponse([], 204)
            : redirect('/');
    }
    /**
     * The user has logged out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    protected function loggedOut(Request $request)
    {
        //
    }
    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard();
    }
}
