<?php

namespace App\Services\Api;

use App\Http\Resources\CategoryResource;
use App\Http\Resources\UserResource;
use App\Mail\restPasswordMail;
use App\Models\Category;
use App\Models\User;
use App\Traits\PhotoTrait;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use mysql_xdevapi\Collection;


class UserService extends ResponseApi
{
    use PhotoTrait;


    public function signIn( $request)
    {
        try {


        // Create a validator instance
        $validator = Validator::make(
            $request->all(),
            [
                'phone' => 'required_if:email,null|exists:users',
                'password' => 'required',
                'device_token'=>'required',
                'device_type'=>'required|in:android,ios',
                'email' => 'required_if:phone,null|exists:users'

            ],
            [
                'phone.exists' => 'هذا الرقم غير مسجل معنا',
                'phone.required' => 'يرجي ادخال الرقم المحمول',
                'password.required' => 'يرجي ادخال كلمة المرور',
                'email.exists' => 'هذا البريد غير مسجل معنا',
                'email.required' => 'يرجي ادخال البريد الالكتروني',
                'device_token.required' => 'يرجي ادخال الرقم المحمول',
                'device_type.required' => 'يرجي ادخال نوع الجهاز',
                'device_type.in' => 'يرجي ادخال نوع الجهاز',

            ]
        );

        // Check if validation fails
        if ($validator->fails()) {
            $error = $validator->errors()->first();
            return self::returnDataFail(null, $error, 422);
        }

        if ($request->phone != null) {
            $user = User::where('phone', $request->phone)->first();

            $credentials = [
                'phone' => $request->phone,
                'password' => $request->password
            ];
        } else {
            $user = User::where('email', $request->email)->first();

            $credentials = [
                'email' => $request->email,
                'password' => $request->password
            ];
        }
        if ($user){

            $token=Auth::guard('user-api')->attempt($credentials);
            if ($token)
            {
                $user->device_token = $request->device_token;
                $user->device_type = $request->device_type;
                $user->save();

                $user->token = $token;
                return self::returnDataSuccess( new UserResource($user),'تم تسجيل الدخول بنجاح', 200);
            }
            else
            {
                return self::returnDataFail(null, 'كلمة المرور غير صحيحة', 422);
            }

        }

        } catch (\Exception $ex) {
            return self::returnDataFail(null, $ex->getMessage(), 500);
        }



    }



    public function signup($request): JsonResponse
    {

        try {


        // Create a validator instance
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required',
                'email' => 'required|unique:users',
                'phone' => 'required|unique:users',
                'password' => 'required|confirmed',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
                'location'=>'required',
                'device_token'=>'required',
                'device_type'=>'required|in:android,ios'
            ],
            [
                'phone.unique' => 'هذا الرقم مسجل مسبقا',
                'email.unique' => 'هذا البريد مسجل مسبقا',
                'name.required' => 'يرجي ادخال الاسم',
                'email.required' => 'يرجي ادخال البريد الالكتروني',
                'phone.required' => 'يرجي ادخال الرقم المحمول',
                'password.required' => 'يرجي ادخال كلمة المرور',
                'password.confirmed' => 'كلمة المرور غير متطابقة',
                'image.image' => 'صورة غير صالحة',
                'image.mimes' => 'صورة غير صالحة',
                'image.max' => 'صورة غير صالحة',
                'location.required' => 'يرجي ادخال الموقع',
                'status.required_in' => 'يرجي ادخال الحالة',
                'device_token.required' => 'يرجي ادخال توكين الجهاز',

            ]
        );

        // Check if validation fails
        if ($validator->fails()) {
            $error = $validator->errors()->first();
            return self::returnDataFail(null, $error, 422);
        }
        $inputs = $request->except('password_confirmation'); // Exclude password_confirmation

            if ($request->has('image')) {
                $inputs['image'] = self::uploadImage($request->image, 'users');
            }

             $inputs['password'] = Hash::make($request->password);


                if (User::create($inputs)){
                    $credentials = $request->only('phone', 'password');
                    $token=Auth::guard('user-api')->attempt($credentials);
                    if ($token) {
                        $user = User::where('phone', $request->phone)->first();
                        $user->token=$token;

                        return self::returnDataSuccess(new UserResource($user), 'تم الاضافة بنجاح', 200);
                    }else{


                        return self::returnDataFail(null, 'حدث خطأ ما', 405);
                    }


                } else
        {
            return self::returnDataFail(null, 'حدث خطأ ما', 405);
        }


        } catch (\Exception $e) {
            return self::returnDataFail(null, $e->getMessage(), 500);
        }
    }//end fun


    public function logout()
    {
        try {
            $user = Auth::guard('user-api');
            $user->logout();

            return self::returnDataSuccess(null, 'تم تسجيل الخروج بنجاح', 200);
        } catch (\Exception $e) {
            return self::returnDataFail(null, 'حدث خطأ ما أثناء تسجيل الخروج: ' . $e->getMessage(), 500);
        }
    }

    public function restPassword($request): JsonResponse
    {
        try {


            $validator = Validator::make(
                $request->all(),
                [
                    'email' => 'required|exists:users',
                ],
                [


                    'email.exists' => 'هذا البريد غير مسجل معنا',
                    'email.required' => 'يرجي ادخال البريد الالكتروني',

                ]
            );

            if ($validator->fails()) {
                $error = $validator->errors()->first();
                return self::returnDataFail(null, $error, 422);

               }

            $user = User::where('email', $request->email)->first();
                if ($user) {
                    $code = rand(111111, 999999);
                    $user->code = $code;
                    $user->expire_at = Carbon::now()->addMinutes(10);
                    $user->save();
                    Mail::to($user->email)->send(new RestPasswordMail($code));

                    return self::returnDataSuccess(null, 'تم ارسال رمز التحقق بنجاح', 200);

                } else {
                    return self::returnDataFail(null, 'هذا البريد غير مسجل معنا', 405);
                }


        }catch (\Exception $e) {
            return self::returnDataFail(null, $e->getMessage(), 500);
        }


    }

    public function deleteMyAccount()
    {
        try {
            $user = Auth::guard('user-api')->user();
           if ($user->delete()){

               return self::returnDataSuccess(null, 'تم حذف حسابك بنجاح', 200);

           }else{
               return self::returnDataFail(null, 'حدث خطأ ما', 405);
           }
        } catch (\Exception $e) {
            return self::returnDataFail(null, $e->getMessage(), 500);
        }


    }

    public function loginWithGoogle( $request)
    {
        try {
            // تحقق من صحة البيانات المدخلة
            $validator = Validator::make(
                $request->all(),
                [
                    'email' => 'required',
                    'device_token' => 'required',
                    'device_type' => 'required|in:android,ios',
                ],
                [
                    'email.required' => 'يرجي ادخال البريد الالكتروني',
                ]
            );

            if ($validator->fails()) {
                $error = $validator->errors()->first();
                return self::returnDataFail(null, $error, 422);
            }

            // العثور على المستخدم
            $user = User::where('email', $request->email)->first();
            if ($user) {
                // المصادقة عبر Google لا تتطلب كلمة مرور محلية، لذا يمكن تخطي محاولة المصادقة عبر كلمة المرور
                $token = Auth::guard('user-api')->login($user);
                if ($token) {
                    // تحديث معلومات الجهاز
                    $user->device_token = $request->device_token;
                    $user->device_type = $request->device_type;
                    $user->save();

                    $user->token = $token;
                    return self::returnDataSuccess(new UserResource($user), 'تم تسجيل الدخول بنجاح', 200);
                } else {
                    return self::returnDataFail(null, 'خطأ في توليد الرمز المميز', 500);
                }
            } else {
               $newUser = new User();
               $newUser->email = $request->email;
               $newUser->name = $request->name ?? 'مستخدم جديد';
               $newUser->phone = $request->phone ?? null;
               $newUser->device_token = $request->device_token;
               $newUser->device_type = $request->device_type;
               $newUser->password =Hash::make('12345678');

               $newUser->save();
               $token = Auth::guard('user-api')->login($newUser);
               $newUser->token = $token;
               return self::returnDataSuccess(new UserResource($newUser), 'تم تسجيل الدخول بنجاح', 200);
            }
        } catch (\Exception $e) {
            return self::returnDataFail(null, 'حدث خطأ ما أثناء تسجيل الدخول: ' . $e->getMessage(), 500);
        }
    }


    public function getCategories()
    {
        try {

            $categories = Category::get();
            if ($categories->count() == 0){
                return self::returnDataFail(null, 'لا يوجد بيانات', 200);
            }
            return self::returnDataSuccess(CategoryResource::collection($categories), 'تمت العملية بنجاح', 200);

        }catch (\Exception $e) {
            return self::returnDataFail(null, $e->getMessage(), 500);
        }

    }






}
