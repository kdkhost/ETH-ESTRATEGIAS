@extends('layouts.admin')

@section('content')

<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{clean( trans('niva-backend.section_4_services') )}}</h1>
        <a href="{{route('service.index') . '?language=' . request()->input('language')}}" class="btn btn-light btn-sm shadow-sm ms-auto">
            <i class="fas fa-arrow-left fa-sm me-1"></i> {{clean( trans('niva-backend.back_services') )}}
        </a>
    </div>

    @include('includes.form-errors')

    <form action="{{route('service.update', $service->id)}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row g-4">
            
            <div class="col-lg-8">
                <div class="card shadow border-0 mb-4">
                    <div class="card-header py-3 bg-white border-0">
                        <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-info-circle me-2"></i> Detalhes do Serviço</h6>
                    </div>
                    <div class="card-body p-4">
                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label class="form-label fw-bold">{{clean( trans('niva-backend.title') )}}</label>
                                <input type="text" name="title" class="form-control border-0 bg-light rounded-3" value="{{$service->title}}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Ícone (FontAwesome)</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-0"><i class="{{$service->icon}}"></i></span>
                                    <input type="text" name="icon" class="form-control border-0 bg-light" value="{{$service->icon}}">
                                </div>
                                <small class="text-muted">Ex: fab fa-chrome. Veja ícones em <a href="https://fontawesome.com/icons" target="_blank">fontawesome.com</a></small>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold">{{clean( trans('niva-backend.description') )}}</label>
                            <textarea name="description" class="form-control border-0 bg-light rounded-3" rows="4">{{$service->description}}</textarea>
                        </div>

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-bold">{{clean( trans('niva-backend.button_text') )}}</label>
                                <input type="text" name="button_text" class="form-control border-0 bg-light rounded-3" value="{{$service->button_text}}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">{{clean( trans('niva-backend.button_link') )}}</label>
                                <input type="text" name="button_link" class="form-control border-0 bg-light rounded-3" value="{{$service->button_link}}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card shadow border-0 mb-4 text-center">
                    <div class="card-header py-3 bg-white border-0">
                        <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-image me-2"></i> Capa do Serviço</h6>
                    </div>
                    <div class="card-body">
                        <div class="mb-4">
                            @if($service->photo)
                                <img class="img-fluid rounded-4 shadow-sm border mb-3" style="max-height: 150px;" src="{{asset('images/media/' . $service->photo->file)}}">
                            @else
                                <img class="img-fluid rounded-4 shadow-sm border mb-3" style="max-height: 150px;" src="{{asset('img/200x200.png')}}">
                            @endif
                        </div>
                        <div class="text-start">
                            <input type="file" name="photo_id" class="filepond">
                        </div>
                    </div>
                </div>

                <div class="card shadow border-0 sticky-top" style="top: 20px;">
                    <div class="card-body d-grid gap-2">
                        <button type="submit" class="btn btn-primary btn-lg shadow rounded-pill py-3">
                            <i class="fas fa-save me-2"></i> Salvar Alterações
                        </button>
                        <a href="{{route('service.index')}}" class="btn btn-light border-0 py-2 small">Cancelar</a>
                    </div>
                </div>
            </div>

        </div>
    </form>
</div>

@stop

@section('footer')
<script>
    $(document).ready(function() {
        const inputElement = document.querySelector('input[name="photo_id"]');
        FilePond.create(inputElement, {
            storeAsFile: true,
            labelIdle: 'Arraste a imagem ou <span class="filepond--label-action">Procure</span>'
        });
    });
</script>
@stop