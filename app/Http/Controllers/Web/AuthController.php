<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Services\UserService as ObjService;
use Illuminate\Http\Request;

class AuthController extends Controller
{

    public function __construct(protected ObjService $objService){
    }

    public function login()
    {
        return $this->objService->login();
    }

    public function register()
    {
        return view('site.auth.register');
    }

    public function loginPost(Request $request)
    {
       return $this->objService->loginPost($request);
    }

    public function registerPost(Request $request)
    {
        return $this->objService->registerPost($request);
    }


    public function logout()
    {
        return $this->objService->logout();
    }



}
