<div class="modal-body">
    <form id="updateForm" method="POST" enctype="multipart/form-data" action="{{route('categories.update',$category->id)}}" >
    @csrf
        @method('PUT')
        <input type="hidden" value="{{$category->id}}" name="id">
        <div class="form-group">
            <label for="name" class="form-control-label">الصورة</label>
            <input type="file" id="testDrop" class="dropify" name="image" data-default-file="{{get_user_file('storage/'. $category->image)}}"/>
        </div>
        <div class="form-group">
            <label for="name" class="form-control-label">الاسم</label>
            <input type="text" class="form-control" name="name" id="name" value="{{$category->name}}">
        </div>
        <div class="form-group">
            <label for="email" class="form-control-label">الحاله</label>
            <select class="form-control" name="status" id="status">
                <option value="" disabled selected>اختر الحاله</option>
                <option value="1" @if($category->status == 1) selected @endif>مفعل</option>
                <option value="0" @if($category->status == 0) selected @endif>غير مفعل</option>
            </select>
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
