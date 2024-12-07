<!-- DATATABLE CSS -->
<link href="{{asset('assets/admin')}}/assets/plugins/datatable/dataTables.bootstrap4.min.css" rel="stylesheet" />
<link href="{{asset('assets/admin')}}/assets/plugins/datatable/responsivebootstrap4.min.css" rel="stylesheet" />
<link href="{{asset('assets/admin')}}/assets/plugins/datatable/fileexport/buttons.bootstrap4.min.css" rel="stylesheet" />

<!-- JQUERY JS -->
<script src="{{asset('assets/admin')}}/assets/js/jquery-3.4.1.min.js"></script>

<!-- DATATABLE JS -->
<script src="{{asset('assets/admin')}}/assets/plugins/datatable/jquery.dataTables.min.js"></script>
<script src="{{asset('assets/admin')}}/assets/plugins/datatable/dataTables.bootstrap4.min.js"></script>
<script src="{{asset('assets/admin')}}/assets/plugins/datatable/datatable.js"></script>
<script src="{{asset('assets/admin')}}/assets/plugins/datatable/dataTables.responsive.min.js"></script>
<script src="{{asset('assets/admin')}}/assets/plugins/datatable/fileexport/dataTables.buttons.min.js"></script>
<script src="{{asset('assets/admin')}}/assets/plugins/datatable/fileexport/buttons.bootstrap4.min.js"></script>
<script src="{{asset('assets/admin')}}/assets/plugins/datatable/fileexport/jszip.min.js"></script>
<script src="{{asset('assets/admin')}}/assets/plugins/datatable/fileexport/pdfmake.min.js"></script>
<script src="{{asset('assets/admin')}}/assets/plugins/datatable/fileexport/vfs_fonts.js"></script>
<script src="{{asset('assets/admin')}}/assets/plugins/datatable/fileexport/buttons.html5.min.js"></script>
<script src="{{asset('assets/admin')}}/assets/plugins/datatable/fileexport/buttons.print.min.js"></script>
<script src="{{asset('assets/admin')}}/assets/plugins/datatable/fileexport/buttons.colVis.min.js"></script>


<!-- BOOTSTRAP JS -->
<script src="{{asset('assets/admin')}}/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="{{asset('assets/admin')}}/assets/plugins/bootstrap/js/popper.min.js"></script>

<!-- SPARKLINE JS-->
<script src="{{asset('assets/admin')}}/assets/js/jquery.sparkline.min.js"></script>

<!-- CHART-CIRCLE JS-->
<script src="{{asset('assets/admin')}}/assets/js/circle-progress.min.js"></script>

<!-- RATING STARJS -->
<script src="{{asset('assets/admin')}}/assets/plugins/rating/jquery.rating-stars.js"></script>

<!-- EVA-ICONS JS -->
<script src="{{asset('assets/admin')}}/assets/iconfonts/eva.min.js"></script>

<!-- INPUT MASK JS-->
<script src="{{asset('assets/admin')}}/assets/plugins/input-mask/jquery.mask.min.js"></script>

<!-- SIDE-MENU JS-->
<script src="{{asset('assets/admin')}}/assets/plugins/sidemenu/sidemenu.js"></script>

{{--<!-- PERFECT SCROLL BAR js-->--}}
<script src="{{asset('assets/admin')}}/assets/plugins/p-scroll/perfect-scrollbar.min.js"></script>
<script src="{{asset('assets/admin')}}/assets/plugins/sidemenu/sidemenu-scroll-rtl.js"></script>

<!-- CUSTOM SCROLLBAR JS-->
<script src="{{asset('assets/admin')}}/assets/plugins/scroll-bar/jquery.mCustomScrollbar.concat.min.js"></script>

<!-- SIDEBAR JS -->
<script src="{{asset('assets/admin')}}/assets/plugins/sidebar/sidebar-rtl.js"></script>

<!-- CUSTOM JS -->
<script src="{{asset('assets/admin')}}/assets/js/custom.js"></script>

<!-- Switcher JS -->
<script src="{{asset('assets/admin')}}/assets/switcher/js/switcher-rtl.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>

<script src="{{ asset('assets/admin/assets/js/select2.js') }}"></script>

<script>
    $(document).ready(function () {
        $('.dropify').dropify();
    });
    $(document).ready(function () {
        $('select').select2();
    });
</script>

<script>
    window.addEventListener('online', () =>{
        // window.location.reload();
        toastr.success('تم استعادة الاتصال بالانترنت');
    });
    window.addEventListener('offline', () =>{
        toastr.error('انقطع الاتصال , يرجي التحقق من جودة الانترنت لديك');
    });
</script>

{{-- <script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script> --}}
<script type="importmap">
    {
        "imports": {
            "ckeditor5": "https://cdn.ckeditor.com/ckeditor5/42.0.1/ckeditor5.js",
            "ckeditor5/": "https://cdn.ckeditor.com/ckeditor5/42.0.1/"
        }
    }
</script>
<script type="module">
    import {
        ClassicEditor,
        Essentials,
        Paragraph,
        Bold,
        Italic,
        Font
    } from 'ckeditor5';

    document.querySelectorAll('.editor').forEach(editorElement => {
    ClassicEditor
        .create(editorElement, {
            plugins: [ Essentials, Paragraph, Bold, Italic, Font ],
            toolbar: [
                'undo', 'redo', '|', 'bold', 'italic', '|',
                'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor'
            ],
            
        })
        .then(editor => {
            window.editor = editor; // You might need to store editors differently if there are multiple editors
        })
        .catch(error => {
            console.error('There was a problem initializing the editor: ', error);
        });
});

</script>


@yield('js')
