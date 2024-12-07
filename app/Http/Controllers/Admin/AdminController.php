<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminRequest;
use App\Models\Admin;
use App\Services\AdminService as ObjService;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function __construct(protected ObjService $objService){
    }

    public function index(Request $request)
    {
        return $this->objService->index($request);
    }

    public function delete(Request $request)
    {
        return $this->objService->delete($request);
    }

    public function myProfile()
    {
        return $this->objService->myProfile();
    }

    public function create()
    {

        return $this->objService->create();
    }

    public function store(AdminRequest $request)
    {
        return $this->objService->store($request);
    }

    public function edit(Admin $admin)
    {
        return $this->objService->edit($admin);
    }

    public function update(AdminRequest $request, $id)
    {
        return $this->objService->update($request, $id);
    }
}//end class
