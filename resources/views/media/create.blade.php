@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{clean( trans('niva-backend.upload_image') )}}</h1>
        <a href="{{ route('media.index') }}" class="btn btn-light btn-sm shadow-sm">
            <i class="fas fa-arrow-left fa-sm me-1"></i> {{clean( trans('niva-backend.back_media') )}}
        </a>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow border-0 rounded-4 overflow-hidden">
                <div class="card-header py-4 bg-primary text-white border-0 text-center">
                    <i class="fas fa-cloud-upload-alt fa-3x mb-3 opacity-75"></i>
                    <h5 class="m-0 fw-bold">Upload de Arquivos Premium</h5>
                    <p class="small mb-0 opacity-75">Arraste e solte seus arquivos para começar o envio imediato</p>
                </div>
                <div class="card-body p-5">
                    
                    <!-- FilePond Zone -->
                    <div class="upload-zone mb-4">
                        <input type="file" class="filepond" name="file" multiple 
                               data-allow-reorder="true" 
                               data-max-file-size="20MB">
                    </div>

                    <div class="info-panel bg-light p-4 rounded-4 border">
                        <div class="d-flex align-items-center mb-3 text-primary">
                            <i class="fas fa-info-circle me-2"></i>
                            <span class="fw-bold">Especificações de Upload</span>
                        </div>
                        <ul class="list-unstyled mb-0 small text-muted">
                            <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i> {{clean( trans('niva-backend.accepted_files') )}}</li>
                            <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i> Tamanho máximo por arquivo: 20MB</li>
                            <li><i class="fas fa-check-circle text-success me-2"></i> Suporte a múltiplos envios simultâneos</li>
                        </ul>
                    </div>

                </div>
                <div class="card-footer bg-white py-3 text-center border-top">
                    <a href="{{ route('media.index') }}" class="btn btn-primary px-5 rounded-pill shadow">
                        Ir para a Galeria <i class="fas fa-chevron-right ms-2"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

</div>
@stop

@section('footer')
<script>
    // FilePond Premium Initialization for Dedicated Upload Page
    const pond = FilePond.create(document.querySelector('.filepond'), {
        server: {
            process: {
                url: '{{route('media.store')}}',
                method: 'POST',
                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                onload: (response) => {
                    showToasty('Arquivo processado!', 'success');
                    return response;
                },
                onerror: (response) => {
                    showToasty('Falha no upload', 'error');
                    return response;
                }
            }
        },
        allowMultiple: true,
        maxParallelUploads: 5,
        imagePreviewHeight: 170,
        imageCropAspectRatio: '1:1',
        imageResizeTargetWidth: 1200,
        imageResizeTargetHeight: 1200,
    });
</script>
@stop