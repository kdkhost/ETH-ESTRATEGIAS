<!-- TinyMCE substituído pelo Summernote (configurado globalmente no admin.blade.php) -->
<script>
    // Ativar Summernote em todos os textareas caso necessário aqui tbm
    $(document).ready(function() {
        if (typeof $.fn.summernote !== 'undefined') {
            $('textarea.article-ckeditor, textarea').not('.no-summernote').summernote({
                height: 300,
                tabsize: 2,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ]
            });
        }
    });
</script>
