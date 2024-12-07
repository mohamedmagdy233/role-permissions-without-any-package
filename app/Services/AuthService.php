<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;

class AuthService extends BaseService
{
    public function index()
    {
        if (Auth::guard('admin')->check()) {
            return redirect()->route('adminHome');
        }
        return view('admin.auth.login');
    }

    public function login($request): \Illuminate\Http\JsonResponse
    {

        $data = $request->validate(
            [
                'email' => 'required|exists:admins',
                'password' => 'required'
            ],
            [
                'email.exists' => 'هذا البريد غير مسجل معنا',
                'email.required' => 'يرجي ادخال البريد الالكتروني',
                'password.required' => 'يرجي ادخال كلمة المرور',
            ]
        );
        if (Auth::guard('admin')->attempt($data)) {
            return response()->json(200);
        }
        return response()->json(405);
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        toastr()->info('تم تسجيل الخروج');
        return redirect()->route('admin.login');
    }
}
