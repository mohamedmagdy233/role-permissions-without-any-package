@extends('admin/layouts/master')
@section('title')
    {{($setting->title_ar) ?? 'الصفحة الرئيسية'}} | لوحة التحكم
@endsection
@section('page_name')
    الرئـيسية
@endsection
@section('content')
    <div class="row">
        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
            <div class="card bg-primary-gradient img-card box-success-shadow">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="text-white"><h2 class="mb-0 number-font">{{ \App\Models\Admin::count() }}</h2>
                            <p class="text-white mb-0"> المشرفين</p></div>
                        <div class="mr-auto">
                            <i class="fe fe-user-check text-white fs-30 ml-2 mt-2"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
            <div class="card bg-primary-gradient img-card box-success-shadow">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="text-white"><h2 class="mb-0 number-font"></h2>
                            <p class="text-white mb-0"> الخدمات</p></div>
                        <div class="mr-auto">
                            <i class="fe fe-box text-white fs-30 ml-2 mt-2"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
            <div class="card bg-primary-gradient img-card box-success-shadow">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="text-white"><h2 class="mb-0 number-font"></h2>
                            <p class="text-white mb-0"> سابقة الاعمال</p></div>
                        <div class="mr-auto">
                            <i class="fe fe-map text-white fs-30 ml-2 mt-2"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
            <div class="card bg-primary-gradient img-card box-success-shadow">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="text-white"><h2 class="mb-0 number-font"></h2>
                            <p class="text-white mb-0"> الرسائل</p></div>
                        <div class="mr-auto">
                            <i class="fe fe-inbox text-white fs-30 ml-2 mt-2"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('js')

@endsection

