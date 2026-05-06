@extends('layouts.admin')

@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">


    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{clean( trans('niva-backend.edit_member') )}}</h1>
        <a href="{{route('member.index')}}" class="btn btn-light shadow-sm btn-sm ms-auto">
            <i class="fas fa-arrow-left fa-sm me-1"></i> {{clean( trans('niva-backend.back_members') )}}
        </a>
    </div>

    <div class="card gourmet-card-light shadow-sm border-0 mb-4">
        <div class="card-header py-3 bg-white border-0 d-flex align-items-center">
            <h6 class="m-0 font-weight-bold text-primary uppercase"><i class="fas fa-user-tie me-2"></i> Perfil do Membro Gourmet</h6>
        </div>
        <div class="card-body p-4">
            @include('includes.form-errors')

            <form action="{{route('member.update', $member->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row g-4">
                    <div class="col-md-6">
                        <label class="form-label fw-bold small text-muted uppercase">Nome Completo</label>
                        <div class="input-group input-group-lg bg-light rounded-4 overflow-hidden border-0">
                            <span class="input-group-text bg-transparent border-0 ps-4"><i class="fas fa-user text-primary opacity-50"></i></span>
                            <input type="text" name="name" class="form-control bg-transparent border-0 shadow-none ps-2" value="{{$member->name}}" placeholder="Nome do Membro">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold small text-muted uppercase">Cargo / Especialidade</label>
                        <div class="input-group input-group-lg bg-light rounded-4 overflow-hidden border-0">
                            <span class="input-group-text bg-transparent border-0 ps-4"><i class="fas fa-id-badge text-primary opacity-50"></i></span>
                            <input type="text" name="position" class="form-control bg-transparent border-0 shadow-none ps-2" value="{{$member->position}}" placeholder="Ex: Desenvolvedor Senior">
                        </div>
                    </div>

                    <div class="col-md-12 mt-4">
                        <h6 class="fw-bold text-dark mb-4 border-start border-4 border-primary ps-3 uppercase">Conexões Sociais</h6>
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label class="form-label fw-bold small text-muted uppercase">Facebook</label>
                                <div class="input-group bg-light rounded-3 overflow-hidden border-0">
                                    <span class="input-group-text bg-transparent border-0 ps-3"><i class="fab fa-facebook-f text-primary opacity-50"></i></span>
                                    <input type="text" name="facebook" class="form-control bg-transparent border-0 shadow-none" value="{{$member->facebook}}" placeholder="Link do perfil">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-bold small text-muted uppercase">Twitter / X</label>
                                <div class="input-group bg-light rounded-3 overflow-hidden border-0">
                                    <span class="input-group-text bg-transparent border-0 ps-3"><i class="fab fa-twitter text-info opacity-50"></i></span>
                                    <input type="text" name="twitter" class="form-control bg-transparent border-0 shadow-none" value="{{$member->twitter}}" placeholder="Link do perfil">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-bold small text-muted uppercase">LinkedIn</label>
                                <div class="input-group bg-light rounded-3 overflow-hidden border-0">
                                    <span class="input-group-text bg-transparent border-0 ps-3"><i class="fab fa-linkedin-in text-primary opacity-50"></i></span>
                                    <input type="text" name="linkedin" class="form-control bg-transparent border-0 shadow-none" value="{{$member->linkedin}}" placeholder="Link do perfil">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 mt-5">
                        <div class="card bg-white border shadow-sm rounded-4 p-4 h-100">
                            <label class="form-label fw-bold d-block mb-3 small text-muted uppercase"><i class="fas fa-camera me-2"></i>Foto Profissional</label>
                            <div class="d-flex align-items-center gap-4">
                                <img loading="lazy" class="rounded-circle shadow border-4 border-white" width="100" height="100" style="object-fit: cover;" src="{{$member->photo ? asset('images/media/' . $member->photo->file) : asset('img/200x200.png')}}">
                                <div class="flex-grow-1">
                                    <input type="file" name="photo_id" class="form-control form-control-lg border-0 bg-light rounded-4 shadow-none">
                                    <small class="text-muted mt-2 d-block" style="font-size: 0.75rem;">Recomendado: 400x400px (Fundo neutro)</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 text-center mt-5 mb-3">
                        <button type="submit" class="btn btn-primary btn-lg px-5 py-3 shadow-lg rounded-pill fw-bold">
                            <i class="fas fa-save me-2"></i> ATUALIZAR MEMBRO DA EQUIPE
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>


</div>
<!-- /.container-fluid -->



@endsection


