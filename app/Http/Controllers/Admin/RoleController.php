<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\RoleService as ObjService;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function __construct(protected ObjService $objService)
    {

    }

    public function index(Request  $request)
    {
        return $this->objService->index($request);
    }

    public function create()
    {
        return $this->objService->create();

    }


    public function store(Request $request)
    {
        return $this->objService->store($request);
    }


    public function delete(Request $request)
    {
        return $this->objService->destroy($request);

    }
}
