<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Api\UserService as ObjService;
use Illuminate\Http\Request;

class AuthControlller extends Controller
{
       public function __construct(protected ObjService $objService){


       }



       public function signup(Request $request){
           return $this->objService->signup($request);
       }

       public function signIn()
       {

           return $this->objService->signIn(request());
       }

       public function restPassword(Request $request)
       {

           return $this->objService->restPassword($request);
       }

       public function logout()
       {
           return $this->objService->logout();
       }
       public function deleteMyAccount()
       {

           return $this->objService->deleteMyAccount();
       }

       public function loginWithGoogle(Request $request)
       {

           return $this->objService->loginWithGoogle($request);

       }
}
