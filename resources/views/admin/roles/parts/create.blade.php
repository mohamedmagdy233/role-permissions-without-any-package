<div class="modal-body">
    <form id="addForm" class="addForm" method="POST" enctype="multipart/form-data" action="{{route('roles.store')}}" >
    @csrf

    <div class="form-group">
        <label for="name" class="form-control-label">الاسم</label>
        <input type="text" class="form-control" name="name" id="name">
    </div>



        <div class="col-12">
            <div class="form-group">
                <!-- Add Select All -->
                <label for="select_all" class="form-control-label">
                    <input type="checkbox" id="select_all" value="select all permissions">
                </label>
            </div>
        </div>

        @foreach(\App\Enums\permissionEnum::cases() as $module)
            <div class="col-12">
                <div class="form-group">
                    <label for="name" class="form-control-label">{{ $module->value }}</label>
                    <div class="row">
                        @foreach($module->permissions() as $permission)
                            <div class="col-6">
                                <label for="{{$permission}}" class="form-control permission-label badge">
                                    <input type="checkbox" id="{{$permission}}" name="permissions[]"
                                           value="{{$permission}}"
                                           class="permission-checkbox"> {{$permission}}
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endforeach

        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">close</button>
            <button type="submit" class="btn btn-primary" id="addButton">save</button>
        </div>
</form>
</div>

<!-- jQuery for Select All functionality -->
<script>
    $('#select_all').click(function () {
        var checked = this.checked;
        $('.permission-checkbox').each(function () {
            this.checked = checked;
        });
    });
</script>

<!-- Dropify script -->
<script>
    $('.dropify').dropify();
</script>

<!-- Custom CSS for checkbox styling data -->
<style>
    .permission-label {
        display: inline-block;
        margin-right: 15px;
    }

    .permission-checkbox {
        margin-right: 8px;
        transform: scale(1.2); /* Increase size */
    }

    /* Optional: Add more styles to improve the look */
</style>
