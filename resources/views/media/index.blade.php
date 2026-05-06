@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{clean( trans('niva-backend.all_media') )}}</h1>
        <a href="{{route('media.create')}}" class="btn btn-primary shadow-sm">
            <i class="fas fa-upload fa-sm text-white-50 me-1"></i> {{clean( trans('niva-backend.upload_image') )}}
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{route('delete.media')}}" method="post" id="delete-media-form">
                @csrf
                @method('DELETE')

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div class="d-flex align-items-center">
                        <select name="action" class="form-select form-select-sm me-2" style="width: 150px;">
                            <option value="">{{clean( trans('niva-backend.delete') )}}</option>
                        </select>
                        <button type="submit" name="delete_all" class="btn btn-danger btn-sm px-3 shadow-sm">
                            <i class="fas fa-trash-alt me-1"></i> Aplicar
                        </button>
                    </div>
                    <div>
                        <span class="text-muted small">Total: {{ $photos->total() }} imagens</span>
                    </div>
                </div>

                <div class="row row-cols-1 row-cols-md-3 row-cols-lg-4 g-4" id="media-grid">
                    @foreach($photos as $photo)
                    <div class="col">
                        <div class="card h-100 border-0 shadow-sm media-card overflow-hidden">
                            <div class="position-relative">
                                <img src="{{asset('images/media/' . $photo->file)}}" class="card-img-top" style="height: 180px; object-fit: cover;" alt="{{$photo->file}}">
                                <div class="position-absolute top-0 start-0 m-2">
                                    <input class="form-check-input checkboxes shadow-sm" type="checkbox" name="checkBoxArray[]" value="{{$photo->id}}">
                                </div>
                            </div>
                            <div class="card-body p-2">
                                <div class="input-group input-group-sm mb-2">
                                    <input type="text" class="form-control bg-light border-0" id="copy-clip{{$photo->id}}" value="{{asset('images/media/' . $photo->file)}}" readonly>
                                    <button class="btn btn-outline-primary border-0" type="button" onclick="copyToClipboard('copy-clip{{$photo->id}}')">
                                        <i class="fas fa-copy"></i>
                                    </button>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <small class="text-muted">{{$photo->created_at ? $photo->created_at->diffForHumans() : ''}}</small>
                                    <span class="badge bg-light text-dark border small">ID: {{$photo->id}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <div class="mt-5 d-flex justify-content-center">
                    {!! $photos->links('pagination::bootstrap-5') !!}
                </div>
            </form>
        </div>
    </div>
</div>
@stop

@section('styles')
<style>
    .media-card {
        transition: transform 0.2s;
        background: #fff;
    }
    .media-card:hover {
        transform: scale(1.02);
    }
    .media-card img {
        border-bottom: 1px solid #f1f1f1;
    }
    .checkboxes {
        width: 20px;
        height: 20px;
        cursor: pointer;
    }
    [data-bs-theme="dark"] .media-card {
        background: #2b3035;
    }
    [data-bs-theme="dark"] .media-card img {
        border-bottom: 1px solid #3c4146;
    }
</style>
@stop

@section('footer')
<script>
    function copyToClipboard(elementId) {
        var copyText = document.getElementById(elementId);
        copyText.select();
        copyText.setSelectionRange(0, 99999);
        document.execCommand("copy");
        showToasty('URL copiada para a área de transferência!', 'success');
    }

    $(document).ready(function() {
        $('#delete-media-form').on('submit', function(e) {
            if ($('.checkboxes:checked').length === 0) {
                e.preventDefault();
                Swal.fire({
                    icon: 'warning',
                    title: 'Atenção',
                    text: 'Selecione pelo menos uma imagem para excluir.',
                    confirmButtonColor: '#0d6efd'
                });
                return;
            }

            e.preventDefault();
            Swal.fire({
                title: 'Tem certeza?',
                text: "Esta ação não poderá ser revertida!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#0d6efd',
                confirmButtonText: 'Sim, excluir!',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.submit();
                }
            });
        });
    });
</script>
@stop
