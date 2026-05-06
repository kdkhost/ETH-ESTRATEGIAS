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
                <div class="card gourmet-card-light shadow-sm border-0 mb-4">
                    <div class="card-header py-3 bg-white border-0 d-flex align-items-center">
                        <h6 class="m-0 font-weight-bold text-primary uppercase"><i class="fas fa-info-circle me-2"></i> Configurações do Serviço Gourmet</h6>
                    </div>
                    <div class="card-body p-4">
                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label class="form-label fw-bold small text-muted uppercase">Título do Serviço</label>
                                <input type="text" name="title" class="form-control form-control-lg border-0 bg-light rounded-4 px-4 shadow-none" value="{{$service->title}}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold small text-muted uppercase">Ícone Visual (FontAwesome)</label>
                                <div class="input-group input-group-lg bg-light rounded-4 overflow-hidden border-0">
                                    <span class="input-group-text bg-transparent border-0 ps-4"><i class="{{$service->icon}} text-primary opacity-50"></i></span>
                                    <input type="text" name="icon" class="form-control bg-transparent border-0 shadow-none ps-2" value="{{$service->icon}}">
                                </div>
                                <small class="text-muted mt-2 d-block ms-1" style="font-size: 0.7rem;">Ex: <code class="bg-white px-1">fas fa-rocket</code>. Explore em <a href="https://fontawesome.com/icons" target="_blank" class="text-decoration-none">fontawesome.com</a></small>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold small text-muted uppercase mb-2">Descrição Detalhada do Serviço</label>
                            <textarea name="description" class="form-control border-0 bg-light rounded-4 p-4 shadow-none" rows="5" placeholder="Descreva os benefícios e entregas deste serviço...">{{$service->description}}</textarea>
                        </div>

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-bold small text-muted uppercase">Texto do Botão (CTA)</label>
                                <input type="text" name="button_text" class="form-control form-control-lg border-0 bg-light rounded-4 px-4 shadow-none" value="{{$service->button_text}}" placeholder="Ex: Solicitar Orçamento">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold small text-muted uppercase">Link de Destino</label>
                                <input type="text" name="button_link" class="form-control form-control-lg border-0 bg-light rounded-4 px-4 shadow-none" value="{{$service->button_link}}" placeholder="Ex: https://meusite.com/contato">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- SEO Card -->
                <div class="card text-bg-dark border-0 rounded-4 shadow-lg overflow-hidden">
                    <div class="card-header py-3 border-bottom border-white border-opacity-10 bg-transparent">
                        <h6 class="m-0 font-weight-bold text-white uppercase"><i class="fas fa-search me-2"></i> Otimização de SEO para Serviços</h6>
                    </div>
                    <div class="card-body p-4">
                        <div class="mb-4">
                            <label class="form-label fw-bold text-white opacity-75 small uppercase">Meta Título (SEO)</label>
                            <input type="text" name="meta_title" class="form-control form-control-lg bg-white bg-opacity-10 text-white border-0 shadow-none" value="{{$service->meta_title}}" placeholder="Título estratégico para buscas">
                        </div>
                        <div class="mb-0">
                            <label class="form-label fw-bold text-white opacity-75 small uppercase">Meta Descrição (SEO)</label>
                            <textarea name="meta_description" class="form-control form-control-lg bg-white bg-opacity-10 text-white border-0 shadow-none" rows="3" placeholder="Resumo persuasivo para os resultados de pesquisa">{{$service->meta_description}}</textarea>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card gourmet-card-light shadow-sm border-0 mb-4 text-center">
                    <div class="card-header py-3 bg-white border-0">
                        <h6 class="m-0 font-weight-bold text-primary uppercase"><i class="fas fa-image me-2"></i> Imagem de Capa</h6>
                    </div>
                    <div class="card-body p-4">
                        <div class="mb-4">
                            @if($service->photo)
                                <img loading="lazy" class="img-fluid rounded-4 shadow border-4 border-white mb-3" style="max-height: 200px; width: 100%; object-fit: cover;" src="{{asset('images/media/' . $service->photo->file)}}">
                            @else
                                <img loading="lazy" class="img-fluid rounded-4 shadow border-4 border-white mb-3" style="max-height: 200px; width: 100%; object-fit: cover;" src="{{asset('img/200x200.png')}}">
                            @endif
                        </div>
                        <div class="text-start">
                            <label class="form-label small fw-bold text-muted uppercase mb-3">Substituir Imagem</label>
                            <input type="file" name="photo_id" class="filepond">
                        </div>
                    </div>
                </div>

                <div class="card gourmet-card-light shadow-lg border-0 sticky-top" style="top: 100px;">
                    <div class="card-body p-4 d-grid gap-3">
                        <button type="submit" class="btn btn-primary btn-lg shadow-lg rounded-pill py-3 fw-bold">
                            <i class="fas fa-save me-2"></i> SALVAR SERVIÇO
                        </button>
                        <a href="{{route('service.index')}}" class="btn btn-light border-0 py-2 small text-muted rounded-pill">
                            <i class="fas fa-times me-1"></i> Descartar Alterações
                        </a>
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
