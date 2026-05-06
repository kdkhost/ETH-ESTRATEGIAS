@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{clean( trans('niva-backend.all_media') )}}</h1>
        <div class="small text-muted">Gerencie suas imagens e arquivos de forma premium</div>
    </div>

    <!-- Quick Upload Section -->
    <div class="card shadow border-0 mb-4 overflow-hidden">
        <div class="card-header py-3 bg-white border-0 d-flex align-items-center">
            <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-cloud-upload-alt me-2"></i> Upload Rápido Premium</h6>
            <button class="btn btn-sm btn-outline-primary rounded-pill px-3 ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#uploadCollapse">
                <i class="fas fa-chevron-down"></i>
            </button>
        </div>
        <div class="collapse show" id="uploadCollapse">
            <div class="card-body bg-light">
                <input type="file" class="filepond" name="file" multiple 
                       data-allow-reorder="true" 
                       data-max-file-size="10MB">
                <div class="text-center mt-2 small text-muted">
                    {{clean( trans('niva-backend.accepted_files') )}}
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow border-0">
        <div class="card-body p-4">
            <form action="{{route('delete.media')}}" method="post" id="delete-media-form">
                @csrf
                @method('DELETE')

                <div class="d-flex justify-content-between align-items-center mb-4 pb-3 border-bottom">
                    <div class="d-flex align-items-center gap-2">
                        <select name="action" class="form-select form-select-sm shadow-sm" style="width: 160px;">
                            <option value="">Ações em Lote</option>
                            <option value="delete">{{clean( trans('niva-backend.delete') )}}</option>
                        </select>
                        <button type="submit" name="delete_all" class="btn btn-danger btn-sm px-4 shadow-sm rounded-pill">
                            <i class="fas fa-check-double me-1"></i> Aplicar
                        </button>
                    </div>
                    <div class="d-flex align-items-center gap-3">
                        <div class="badge bg-primary-subtle text-primary px-3 py-2 rounded-pill">
                            <i class="fas fa-images me-1"></i> {{ $photos->total() }} Itens
                        </div>
                    </div>
                </div>

                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 g-4" id="media-grid">
                    @foreach($photos as $photo)
                    <div class="col">
                        <div class="card h-100 border-0 shadow-sm media-card rounded-4 overflow-hidden position-relative">
                            <div class="media-thumb-container position-relative">
                                <img loading="lazy" src="{{asset('images/media/' . $photo->file)}}" class="card-img-top" style="height: 160px; object-fit: cover;" alt="{{$photo->file}}">
                                <div class="media-overlay">
                                    <div class="form-check position-absolute top-0 start-0 m-2">
                                        <input class="form-check-input checkboxes shadow" type="checkbox" name="checkbox_array[]" value="{{$photo->id}}">
                                    </div>
                                    <div class="action-buttons position-absolute bottom-0 start-0 w-100 p-2 d-flex justify-content-center gap-2 translate-y-100 transition-all">
                                        <button type="button" class="btn btn-light btn-sm rounded-circle shadow" onclick="copyToClipboard('copy-clip{{$photo->id}}')" title="Copiar Link">
                                            <i class="fas fa-link"></i>
                                        </button>
                                        <a href="{{asset('images/media/' . $photo->file)}}" target="_blank" class="btn btn-light btn-sm rounded-circle shadow" title="Ver Fullsize">
                                            <i class="fas fa-expand"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body p-2 bg-white">
                                <div class="input-group input-group-sm mb-1 opacity-0 position-absolute" style="z-index: -1;">
                                    <input type="text" id="copy-clip{{$photo->id}}" value="{{asset('images/media/' . $photo->file)}}" readonly>
                                </div>
                                <div class="d-flex flex-column">
                                    <span class="text-truncate small fw-bold text-dark" title="{{$photo->file}}">{{$photo->file}}</span>
                                    <small class="text-muted" style="font-size: 10px;">{{$photo->created_at ? $photo->created_at->format('d/m/Y H:i') : '-'}}</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <div class="mt-5 d-flex justify-content-center">
                    {!! $photos->appends(request()->input())->links('pagination::bootstrap-5') !!}
                </div>
            </form>
        </div>
    </div>
</div>
@stop

@section('styles')
<style>
    .media-card { transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); }
    .media-card:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important; }
    .media-thumb-container { overflow: hidden; background: #f8f9fa; }
    .media-overlay { 
        position: absolute; top: 0; left: 0; width: 100%; height: 100%; 
        background: rgba(0,0,0,0.2); opacity: 0; transition: all 0.3s;
        display: flex; align-items: center; justify-content: center;
    }
    .media-card:hover .media-overlay { opacity: 1; }
    .media-card:hover .action-buttons { transform: translateY(0); }
    .action-buttons { transition: all 0.3s; }
    .checkboxes { width: 1.2rem; height: 1.2rem; cursor: pointer; border-color: #fff; }
    
    [data-bs-theme="dark"] .media-card { background: #1e293b; }
    [data-bs-theme="dark"] .bg-white { background: #1e293b !important; }
</style>
@stop

@section('footer')
<script>
    // FilePond Premium Initialization
    const pond = FilePond.create(document.querySelector('.filepond'), {
        server: {
            process: {
                url: '{{route('media.store')}}',
                method: 'POST',
                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                onload: (response) => {
                    showToasty('Arquivo enviado!', 'success');
                    // Recarregar galeria após 1.5s
                    setTimeout(() => { location.reload(); }, 1500);
                    return response;
                },
                onerror: (response) => {
                    showToasty('Erro no envio', 'error');
                    return response;
                }
            }
        },
        allowMultiple: true,
        maxParallelUploads: 3,
        itemInsertLocation: 'after',
    });

    function copyToClipboard(elementId) {
        var copyText = document.getElementById(elementId);
        copyText.select();
        navigator.clipboard.writeText(copyText.value).then(() => {
            showToasty('URL copiada!', 'success');
        });
    }

    $(document).ready(function() {
        $('#delete-media-form').on('submit', function(e) {
            if ($('.checkboxes:checked').length === 0) {
                e.preventDefault();
                Swal.fire({ icon: 'warning', title: 'Atenção', text: 'Selecione imagens para excluir.' });
                return;
            }
            e.preventDefault();
            Swal.fire({
                title: 'Confirmar Exclusão?',
                text: "Esta ação removerá permanentemente os arquivos selecionados.",
                icon: 'error',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                confirmButtonText: 'Sim, Excluir!',
                cancelButtonText: 'Cancelar'
            }).then((result) => { 
                if (result.isConfirmed) { 
                    let form = $(this);
                    let formData = form.serialize() + '&delete_all=1';
                    
                    $.ajax({
                        url: form.attr('action'),
                        type: 'POST',
                        data: formData,
                        headers: { 'X-Requested-With': 'XMLHttpRequest' },
                        success: function(response) {
                            if(response.success) {
                                showToasty(response.message, 'success');
                                $('.checkboxes:checked').closest('.col').fadeOut(400, function() { 
                                    $(this).remove(); 
                                });
                            }
                        },
                        error: function() {
                            showToasty('Erro ao excluir as imagens.', 'error');
                        }
                    });
                } 
            });
        });
    });
</script>
@stop

