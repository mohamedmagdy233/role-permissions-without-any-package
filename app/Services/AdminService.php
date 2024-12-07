<?php

namespace App\Services;

use App\Models\Admin;
use App\Models\Role;
use App\Models\RoleUser;
use App\Traits\PhotoTrait;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\DataTables;

class AdminService extends BaseService
{
    use PhotoTrait;

    public function index($request)
    {
        if ($request->ajax()) {
            $admins = Admin::latest()->get();
            return DataTables::of($admins)
                ->addColumn('action', function ($admins) {
                    $buttons = '';
                    if ($admins->id != 1 || auth()->guard('admin')->user()->id == 1) {
                        $buttons .= '
                            <button type="button" data-id="' . $admins->id . '" class="btn btn-pill btn-info-light editBtn">
                            <i class="fa fa-edit"></i>
                            </button>
                       ';
                    }

                    if (auth()->guard('admin')->user()->id != $admins->id && $admins->id != 1) {
                        $buttons .= '<button class="btn btn-pill btn-danger-light" data-toggle="modal"
                        data-target="#delete_modal" data-id="' . $admins->id . '" data-title="' . $admins->name . '">
                        <i class="fas fa-trash"></i>
                        </button>';
                    }

                    return $buttons;
                })
                ->editColumn('image', function ($admins) {
                    return '
                    <img alt="image" onclick="window.open(this.src)" class="avatar avatar-md rounded-circle" src="' . asset($admins->image) . '">
                    ';
                })
                ->escapeColumns([])
                ->make(true);
        } else {
            return view('admin/admin/index');
        }
    }


    public function delete($request)
    {
        $admin = Admin::where('id', $request->id)->first();
        if ($admin == auth()->guard('admin')->user()) {
            return response(['message' => "لا يمكن حذف المشرف المسجل به !", 'status' => 501], 200);
        } else {
            if (file_exists($admin->image)) {
                unlink($admin->image);
            }
            $admin->delete();
            return response(['message' => 'تم الحذف بنجاح', 'status' => 200], 200);
        }
    }

    public function myProfile()
    {
        $admin = auth()->guard('admin')->user();
        return view('admin/admin/profile', compact('admin'));
    }//end fun


    public function create()
    {
        return view('admin/admin.parts.create',[
            'roles' => Role::all()
        ]);
    }

    public function store($request)
    {
        $inputs = $request->all();
        if ($request->has('image')) {
            $inputs['image'] = $this->saveImage($request->image, 'uploads/admins');
        }else{
            $inputs['image'] = 'uploads/admins/default.png';
        }

        $inputs['password'] = Hash::make($request->password);
        $obj = Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $inputs['password'],
            'image' => $inputs['image'],
        ]);

//        dd($request->role_id);
        if ($obj){

            RoleUser::updateOrCreate([
                'role_id' => $request->role_id,
                'admin_id' => $obj->id
            ]);
            return response()->json(['status' => 200]);

        }
        else
            return response()->json(['status' => 405]);
    }

    public function edit($admin)
    {
        return view('admin/admin.parts.edit', compact('admin'));
    }

    public function update($request, $id)
    {
        $inputs = $request->except('id');

        $admin = Admin::findOrFail($id);

        if ($request->has('image')) {
            if (file_exists($admin->image)) {
                unlink($admin->image);
            }
            $inputs['image'] = $this->saveImage($request->image, 'uploads/admins');
        }
        if ($request->has('password') && $request->password != null)
            $inputs['password'] = Hash::make($request->password);
        else
            unset($inputs['password']);

        if ($admin->update($inputs))
            return response()->json(['status' => 200]);
        else
            return response()->json(['status' => 405]);
    }
}
