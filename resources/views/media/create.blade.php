@extends('layouts.admin')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">{{clean( trans('niva-backend.upload_image') , array('Attr.EnableID' => true))}}</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">{{clean( trans('niva-backend.upload_image') , array('Attr.EnableID' => true))}}</h6>
        </div>
        <div class="card-body">

            <a href="{{ route('media.index') }}" class="btn btn-primary btn-back mb-3">{{clean( trans('niva-backend.back_media') , array('Attr.EnableID' => true))}}</a>

            <div class="table-responsive">
                <input type="file" class="filepond" name="file" multiple data-allow-reorder="true" data-max-file-size="10MB">
            </div>

            <p class="mb-4 mt-4">{{clean( trans('niva-backend.accepted_files') , array('Attr.EnableID' => true))}}</p>  

        </div>
    </div>

</div>
@stop

@section('footer')
    <script type="text/javascript">
        // Register FilePond plugins
        FilePond.registerPlugin(
            FilePondPluginImagePreview,
            FilePondPluginFileValidateType
        );

        // Turn all file input elements into ponds
        const pond = FilePond.create(document.querySelector('.filepond'), {
            acceptedFileTypes: ['image/jpeg', 'image/png', 'image/gif', 'image/webp', 'image/svg+xml'],
            server: {
                process: {
                    url: '{{route('media.store')}}',
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    onload: (response) => {
                        showToasty('Arquivo enviado com sucesso!', 'success');
                        return response;
                    },
                    onerror: (response) => {
                        showToasty('Erro no envio do arquivo', 'error');
                        return response;
                    }
                }
            }
        });
    </script>
@stop