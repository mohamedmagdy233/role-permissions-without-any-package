<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use  App\Services\Api\UserService as ObjService;
use Illuminate\Http\Request;

class UserController extends Controller
{



    public function __construct(ObjService $objService)
    {
        $this->objService = $objService;
    }


    public function getCategories()
    {
        return $this->objService->getCategories();
    }
}
