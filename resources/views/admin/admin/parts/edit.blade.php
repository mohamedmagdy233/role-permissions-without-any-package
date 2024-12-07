<div class="modal-body">
    <form id="updateForm" method="POST" enctype="multipart/form-data" action="{{route('admins.update',$admin->id)}}" >
    @csrf
        @method('PUT')
        <input type="hidden" value="{{$admin->id}}" name="id">
        <div class="form-group">
            <label for="name" class="form-control-label">الصورة</label>
            <input type="file" id="testDrop" class="dropify" name="image" data-default-file="{{get_user_file($admin->image)}}"/>
        </div>
        <div class="form-group">
            <label for="name" class="form-control-label">الاسم</label>
            <input type="text" class="form-control" name="name" id="name" value="{{$admin->name}}">
        </div>
        <div class="form-group">
            <label for="email" class="form-control-label">الايميل</label>
            <input type="text" class="form-control" name="email" id="email" value="{{$admin->email}}">
        </div>
        <div class="form-group">
            <label for="password" class="form-control-label">كلمة المرور</label>
            <input type="password" class="form-control" name="password" id="password" placeholder="********">
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
            <button type="submit" class="btn btn-success" id="updateButton">تحديث</button>
        </div>
    </form>
</div>
<script>
    $('.dropify').dropify()
</script>
