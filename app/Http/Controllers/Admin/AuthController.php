<?php

namespace App\Http\Controllers\Admin;

use App\Interfaces\AuthInterface;
use Illuminate\Http\Request;
use App\Services\AuthService as ObjService;

use Illuminate\Routing\Controller;

class AuthController extends Controller
{

    public function __construct(protected ObjService $objService){
    }

    public function index()
    {
        return $this->objService->index();
    }

    public function login(Request $request)
    {
        return $this->objService->login($request);
    }

    public function logout()
    {
        return $this->objService->logout();
    }

}//end class
