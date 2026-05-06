@extends('layouts.admin')

@section('content')

<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{clean( trans('niva-backend.edit_user') )}}</h1>
        <div class="d-flex gap-2 ms-auto">
            @if(Auth::user()->role->name == 'administrator')
                <a href="{{ route('users.index') }}" class="btn btn-light shadow-sm btn-sm">
                    <i class="fas fa-arrow-left fa-sm me-1"></i> {{clean( trans('niva-backend.back_user') )}}
                </a>
            @endif
        </div>
    </div>

    @if ($message = Session::get('user_success'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
            <i class="fas fa-check-circle me-2"></i> <strong>{{ $message }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    
    @if ($message = Session::get('user_fail'))
        <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
            <i class="fas fa-exclamation-triangle me-2"></i> <strong>{{ $message }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card gourmet-card-light shadow-sm border-0 mb-4">
        <div class="card-header py-3 bg-white border-0 d-flex align-items-center">
            <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-user-edit me-2"></i> Perfil do Usuário Gourmet</h6>
        </div>
        <div class="card-body p-4">
            @include('includes.form-errors')

            <div class="row g-5">
                <!-- Coluna Lateral: Foto e Resumo -->
                <div class="col-lg-3 text-center">
                    <div class="position-relative d-inline-block mb-3">
                        <img loading="lazy" class="img-fluid rounded-circle shadow border-4 border-white p-1" width="180" height="180" style="object-fit: cover; aspect-ratio: 1/1;" src="{{$user->photo ? asset('images/media/' . $user->photo->file) : asset('img/200x200.png')}}" alt="{{$user->name}}">
                        <span class="position-absolute bottom-0 end-0 badge rounded-pill bg-success p-2 border border-light" title="Usuário Ativo" style="width: 15px; height: 15px;">
                            <span class="visually-hidden">Ativo</span>
                        </span>
                    </div>
                    <h5 class="fw-bold mb-1 text-dark">{{$user->name}}</h5>
                    <p class="badge bg-primary-subtle text-primary rounded-pill px-3 mb-3">{{$user->role->name}}</p>
                    <hr class="opacity-10">
                    <div class="text-start">
                        <div class="mb-3">
                            <small class="text-muted d-block mb-1 uppercase fw-bold" style="font-size: 10px;">{{clean( trans('niva-backend.email') )}}</small>
                            <p class="small text-dark fw-medium mb-0">{{$user->email}}</p>
                        </div>
                        
                        <div>
                            <small class="text-muted d-block mb-1 uppercase fw-bold" style="font-size: 10px;">{{clean( trans('niva-backend.phone') )}}</small>
                            <p class="small text-dark fw-medium mb-0">{{$user->phone ?? 'Não informado'}}</p>
                        </div>
                    </div>
                </div>

                <!-- Coluna Principal: Formulário -->
                <div class="col-lg-9">
                    <form action="{{route('users.update', $user->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row g-4">
                            <div class="col-md-6">
                                <label class="form-label fw-bold small text-muted uppercase">Nome Completo</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-0"><i class="fas fa-user text-primary opacity-50"></i></span>
                                    <input type="text" name="name" value="{{$user->name}}" class="form-control form-control-lg bg-light border-0" placeholder="Nome Completo">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold small text-muted uppercase">E-mail Corporativo</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-0"><i class="fas fa-envelope text-primary opacity-50"></i></span>
                                    <input type="email" name="email" value="{{$user->email}}" class="form-control form-control-lg bg-light border-0" placeholder="email@exemplo.com">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-bold small text-muted uppercase">Nível de Acesso (Função)</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-0"><i class="fas fa-shield-alt text-primary opacity-50"></i></span>
                                    @if($user->id == Auth::user()->id) 
                                        <input type="text" class="form-control form-control-lg bg-light border-0 ps-3" value="{{$user->role->name}}" readonly disabled>
                                        <input type="hidden" name="role_id" value="{{$user->role_id}}">
                                    @else
                                        <select name="role_id" id="role_id" class="form-select form-select-lg bg-light border-0 ps-3">
                                            @foreach($roles as $role)
                                                <option @if($user->role_id == $role->id) selected @endif value="{{ $role->id }}">{{ $role->name }}</option>
                                            @endforeach 
                                        </select>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold small text-muted uppercase">Foto de Perfil</label>
                                <input type="file" name="photo_id" class="form-control form-control-lg bg-light border-0">
                            </div>

                            <div class="col-md-12 mt-5">
                                <h6 class="fw-bold text-dark mb-4 border-start border-4 border-primary ps-3 uppercase">Localização e Contato</h6>
                            </div>

                            <div class="col-md-8">
                                <label class="form-label fw-bold small text-muted uppercase">Endereço Completo</label>
                                <input type="text" name="address" value="{{$user->address}}" class="form-control form-control-lg bg-light border-0" placeholder="Rua, Número, Bairro">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-bold small text-muted uppercase">Cidade/Estado</label>
                                <input type="text" name="city" value="{{$user->city}}" class="form-control form-control-lg bg-light border-0" placeholder="Cidade / Estado">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold small text-muted uppercase">Telefone de Contato</label>
                                <input type="text" name="phone" value="{{$user->phone}}" class="form-control form-control-lg bg-light border-0" placeholder="(00) 00000-0000">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-bold small text-muted uppercase">Alterar Senha (Segurança)</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-0"><i class="fas fa-key text-danger opacity-50"></i></span>
                                    <input type="password" name="password" class="form-control form-control-lg bg-light border-0" placeholder="Deixe em branco para manter">
                                </div>
                                <small class="text-muted mt-2 d-block">Use pelo menos 8 caracteres com letras e números.</small>
                            </div>

                            <div class="col-12 text-center mt-5">
                                <button type="submit" class="btn btn-primary btn-lg shadow px-5 py-3 rounded-pill fw-bold">
                                    <i class="fas fa-save me-2"></i> ATUALIZAR PERFIL GOURMET
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>

@stop

@section('styles')
<style>
    .rounded-4 { border-radius: 1rem !important; }
    .uppercase { text-transform: uppercase; letter-spacing: 1px; }
    .form-control, .form-select, .input-group-text { border-color: #dee2e6; }
    .form-control:focus, .form-select:focus { border-color: #0d6efd; box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.05); }
    [data-bs-theme="dark"] .bg-white { background-color: transparent !important; }
    [data-bs-theme="dark"] .bg-light { background-color: rgba(255,255,255,0.05) !important; }
</style>
@stop
