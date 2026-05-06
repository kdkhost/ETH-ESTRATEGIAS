

@extends('layouts.admin')

@section('content')

@include('includes.tinyeditor')

<!-- Begin Page Content -->
<div class="container-fluid">


    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{clean( trans('niva-backend.edit_testimonial') )}}</h1>
        <a href="{{route('testimonial.index') . '?language=' . request()->input('language')}}" class="btn btn-light shadow-sm btn-sm ms-auto">
            <i class="fas fa-arrow-left fa-sm me-1"></i> {{clean( trans('niva-backend.back_testimonial') )}}
        </a>
    </div>

    <div class="card gourmet-card-light shadow-sm border-0 mb-4">
        <div class="card-header py-3 bg-white border-0 d-flex align-items-center">
            <h6 class="m-0 font-weight-bold text-primary uppercase"><i class="fas fa-quote-left me-2"></i> Editar Depoimento Gourmet</h6>
        </div>
        <div class="card-body p-4">
            @include('includes.form-errors')

            <form action="{{route('testimonial.update', $testimonial->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row g-4">
                    <div class="col-md-6">
                        <label class="form-label fw-bold small text-muted uppercase">Nome do Cliente</label>
                        <div class="input-group input-group-lg bg-light rounded-4 overflow-hidden border-0">
                            <span class="input-group-text bg-transparent border-0 ps-4"><i class="fas fa-user text-primary opacity-50"></i></span>
                            <input type="text" name="name" class="form-control bg-transparent border-0 shadow-none ps-2" value="{{$testimonial->name}}" placeholder="Ex: João Silva">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold small text-muted uppercase">Cargo / Empresa</label>
                        <div class="input-group input-group-lg bg-light rounded-4 overflow-hidden border-0">
                            <span class="input-group-text bg-transparent border-0 ps-4"><i class="fas fa-briefcase text-primary opacity-50"></i></span>
                            <input type="text" name="position" class="form-control bg-transparent border-0 shadow-none ps-2" value="{{$testimonial->position}}" placeholder="Ex: CEO da TechCorp">
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="card bg-light border-0 rounded-4 p-4 shadow-none">
                            <label class="form-label fw-bold small text-muted uppercase d-block mb-3"><i class="fas fa-camera me-2"></i>Foto de Perfil (URL)</label>
                            <div class="d-flex align-items-center gap-4">
                                @if($testimonial->profile_pic)
                                    <img loading="lazy" class="rounded-circle shadow border-4 border-white" width="80" height="80" style="object-fit: cover;" src="{{$testimonial->profile_pic}}" alt="Profile">
                                @else
                                    <img loading="lazy" class="rounded-circle shadow border-4 border-white" width="80" height="80" style="object-fit: cover;" src="{{asset('img/200x200.png')}}" alt="Default">
                                @endif
                                <div class="flex-grow-1">
                                    <input type="text" name="profile_pic" class="form-control form-control-lg border-0 bg-white shadow-sm rounded-4" value="{{$testimonial->profile_pic}}" placeholder="Cole a URL da imagem aqui...">
                                    <small class="text-muted mt-2 d-block" style="font-size: 0.75rem;">Você pode enviar imagens no <a href="{{route('media.index')}}" target="_blank" class="fw-bold text-decoration-none">Media Center</a> e copiar o link aqui.</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 mt-4">
                        <label class="form-label fw-bold small text-muted uppercase mb-3">Relato / Depoimento do Cliente</label>
                        <div class="position-relative">
                            <i class="fas fa-quote-right position-absolute bottom-0 end-0 m-4 text-primary opacity-10 fa-4x"></i>
                            <textarea name="description" class="form-control border-0 bg-light rounded-4 p-4 shadow-none" rows="6" placeholder="Escreva o que o cliente disse sobre seu trabalho...">{{$testimonial->description}}</textarea>
                        </div>
                    </div>

                    <div class="col-12 text-center mt-5 mb-3">
                        <button type="submit" class="btn btn-primary btn-lg px-5 py-3 shadow-lg rounded-pill fw-bold">
                            <i class="fas fa-save me-2"></i> ATUALIZAR DEPOIMENTO
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>


</div>
<!-- /.container-fluid -->




@endsection

