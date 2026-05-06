<?php
$tiny_mce_key = env('TINYMCE_KEY');
?>

<script src="https://cdn.tiny.cloud/1/{{ $tiny_mce_key }}/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script src="{{ asset('public/js/langs/pt_BR.js') }}"></script>

<script>
    var editor_config = {
        path_absolute : "/",
        selector: "textarea",
        plugins: [
            "advlist autolink lists link charmap print preview hr anchor pagebreak",
            "searchreplace wordcount visualblocks visualchars code fullscreen",
            "insertdatetime nonbreaking save table contextmenu directionality",
            "emoticons template paste textcolor colorpicker textpattern"
        ],
        toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
        relative_urls: false,
        language: 'pt_BR',
        language_url: "{{ asset('public/js/langs/pt_BR.js') }}"
    };

    tinymce.init(editor_config);
</script>
