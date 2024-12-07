<?php

namespace App\Services;

use App\Models\Permission;
use App\Models\Role;
use App\Models\RoleHasPermission;
use App\Services\Api\ResponseApi;
use Exception;
use Illuminate\Validation\ValidationException;
use Yajra\DataTables\DataTables;
use Yoeunes\Toastr\Facades\Toastr;

class RoleService  extends ResponseApi
{

    public function index($request)
    {
        if ($request->ajax()) {
            $obj = Role::get();
            return DataTables::of($obj)

                ->addColumn('action', function ($obj) {
                    $buttons = '';

                        $buttons .= '
                            <button type="button" data-id="' . $obj->id . '" class="btn btn-pill btn-info-light editBtn">
                            <i class="fa fa-edit"></i>
                            </button>
                       ';


                        $buttons .= '<button class="btn btn-pill btn-danger-light" data-toggle="modal"
                        data-target="#delete_modal" data-id="' . $obj->id . '" data-title="' . $obj->name . '">
                        <i class="fas fa-trash"></i>
                        </button>';

                    return $buttons;
                })


                ->escapeColumns([])

                ->make(true);
        } else {
            return view('admin/roles/index');
        }
    }//end of index


    public function create()
    {
        return view('admin.roles.parts.create');
    } //end of create

    public function store( $request)
    {
        try {

            $role=  Role::create([
                'name' => $request['name'],
            ]);

            $permissions = Permission::query()
                ->whereIn('name', $request['permissions'])
                ->get();



//            $role->syncPermissions($permissions);

            // create permissions and role in table roles_permissions
            foreach ($permissions as $permission) {

                RoleHasPermission::create([
                    'role_id' => $role->id,
                    'permission_id' => $permission->id
                ]);

            }

            Toastr::success('تم الاضافة بنجاح');
            return redirect()->route('roles.index');



        } catch (ValidationException $e) {

            return response()->json(['status' => 405, 'errors' => $e->errors()]);

        }
    } //end of store


    public function edit($id)
    {
        $category = Category::find($id);
        return view('admin.categories.parts.edit', compact('category'));

    } //end of edit

    public function update($request, $id)
    {
        try {
            $request->validate([
                'name' => 'required',
                'status' => 'required',
                'image' => 'required',
            ], [
                'name.required' => 'يرجي ادخال الاسم',
                'image.required' => 'يرجي ادخال الصورة',
                'status.required' => 'يرجي ادخال الحالة',
            ]);


            $inputs = $request->all();
            $category = Category::find($request->id);
            if ($request->has('image')) {


                if (file_exists($category->image)) {
                    unlink($category->image);
                }

                $inputs['image'] = $this->uploadImage($request->image, 'uploads/categories');
            }

            if ($category->update($inputs)) {
                Toastr::success('تم التعديل بنجاح');
                return redirect()->route('categories.index');
            } else {
                Toastr::error('هناك خطأ في البيانات');
                return redirect()->back()->withInput();
            }
        } catch (ValidationException $e) {
            return response()->json(['status' => 405, 'errors' => $e->errors()]);
        } catch (Exception $e) {
            return response()->json(['status' => 500, 'message' => $e->getMessage()]);
        }
    } //end of update


    public function destroy($request)
    {
        $obj = Role::find($request->id);

        $obj->delete();

        Toastr::success('تم الحذف بنجاح');
        return response(['message' => 'تم الحذف بنجاح', 'status' => 200], 200);
    }



}
