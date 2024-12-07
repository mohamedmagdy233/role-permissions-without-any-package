<div class="modal-body">


    <form id="addForm" class="addForm" method="POST" enctype="multipart/form-data" action="{{route('admins.store')}}" >
    @csrf
    <div class="form-group">
        <label for="name" class="form-control-label">الصورة</label>
        <input type="file" class="dropify" name="image" data-default-file="{{asset('assets/uploads/avatar.png')}}" accept="image/png,image/webp , image/gif, image/jpeg,image/jpg"/>
        <span class="form-text text-danger text-center">مسموح فقط بالصيغ التالية : png, gif, jpeg, jpg,webp</span>
    </div>
    <div class="form-group">
        <label for="name" class="form-control-label">الاسم</label>
        <input type="text" class="form-control" name="name" id="name">
    </div>
    <div class="form-group">
        <label for="email" class="form-control-label">الايميل</label>
        <input type="text" class="form-control" name="email" id="email">
    </div>

        <div class="form-group">
        <label for="email" class="form-control-label">الصلاحيات</label>
        <select class="form-control" name="role_id" id="role">
            <option value="" disabled selected>اختر الحاله</option>
            @foreach($roles as $role)
                <option value="{{$role->id}}">{{$role->name}}</option>
            @endforeach
        </select>

        </div>
    <div class="form-group">
        <label for="password" class="form-control-label">كلمة المرور</label>
        <input type="password" class="form-control" name="password" id="password">
    </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
            <button type="submit" class="btn btn-primary" id="addButton">اضافة</button>
        </div>
    </form>
</div>

<script>
    $('.dropify').dropify()
</script>
