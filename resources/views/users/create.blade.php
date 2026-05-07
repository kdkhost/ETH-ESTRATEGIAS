

@extends('layouts.admin')

@section('content')

<!-- Begin Page Content -->
<div class="container-fluid mb-5">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{clean( trans('niva-backend.create_user') )}}</h1>
        <div class="d-flex gap-2 ms-auto">
            <a href="{{ route('users.index') }}" class="btn btn-light shadow-sm btn-sm">
                <i class="fas fa-arrow-left fa-sm me-1"></i> {{clean( trans('niva-backend.back_user') )}}
            </a>
        </div>
    </div>

    <!-- DataTales Example -->
    <div class="card gourmet-card-light shadow-sm border-0 mb-4 col-lg-9 mx-auto">
        <div class="card-header py-3 bg-white border-0 d-flex align-items-center">
            <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-user-plus me-2"></i> Adicionar Novo Usuário</h6>
        </div>
        <div class="card-body p-4">

            @if ($message = Session::get('user_success'))
                <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
                    <i class="fas fa-check-circle me-2"></i> <strong>{{ $message }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            
            @include('includes.form-errors')

            <form action="{{route('users.store')}}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row g-4">
                    <div class="col-md-6">
                        <label class="form-label fw-bold small text-muted uppercase">{{clean( trans('niva-backend.name') )}}</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-0"><i class="fas fa-user text-primary opacity-50"></i></span>
                            <input type="text" name="name" class="form-control form-control-lg bg-light border-0" placeholder="Nome completo" required>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <label class="form-label fw-bold small text-muted uppercase">{{clean( trans('niva-backend.email') )}}</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-0"><i class="fas fa-envelope text-primary opacity-50"></i></span>
                            <input type="email" name="email" class="form-control form-control-lg bg-light border-0" placeholder="E-mail de acesso" required>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <label class="form-label fw-bold small text-muted uppercase">{{clean( trans('niva-backend.roles') )}}</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-0"><i class="fas fa-shield-alt text-primary opacity-50"></i></span>
                            <select name="role_id" id="role_id" class="form-select form-select-lg bg-light border-0 ps-3" required>
                                <option value="">{{clean( trans('niva-backend.choose_role') )}}</option>
                                @foreach($roles as $role)
                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                @endforeach 
                            </select>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <label class="form-label fw-bold small text-muted uppercase">{{clean( trans('niva-backend.password') )}}</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-0"><i class="fas fa-lock text-primary opacity-50"></i></span>
                            <input type="password" name="password" class="form-control form-control-lg bg-light border-0" placeholder="Senha de acesso" required>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-bold small text-muted uppercase">{{clean( trans('niva-backend.address') )}}</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-0"><i class="fas fa-map-marker-alt text-primary opacity-50"></i></span>
                            <input type="text" name="address" class="form-control form-control-lg bg-light border-0" placeholder="Endereço">
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <label class="form-label fw-bold small text-muted uppercase">{{clean( trans('niva-backend.city') )}}</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-0"><i class="fas fa-building text-primary opacity-50"></i></span>
                            <input type="text" name="city" class="form-control form-control-lg bg-light border-0" placeholder="Cidade">
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <label class="form-label fw-bold small text-muted uppercase">{{clean( trans('niva-backend.phone') )}}</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-0"><i class="fas fa-phone text-primary opacity-50"></i></span>
                            <input type="text" name="phone" class="form-control form-control-lg bg-light border-0" placeholder="Telefone">
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <label class="form-label fw-bold small text-muted uppercase">{{clean( trans('niva-backend.photo') )}}</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-0"><i class="fas fa-image text-primary opacity-50"></i></span>
                            <input type="file" name="photo_id" class="form-control form-control-lg bg-light border-0" id="photo_id" style="padding-top: 10px;">
                        </div>
                        <small class="text-muted mt-1 d-block ms-1">Resolução ideal: 200x200px</small>
                    </div>

                    <div class="col-12 text-end mt-4 pt-3 border-top">
                        <button type="submit" class="btn btn-primary shadow-sm px-5">
                            <i class="fas fa-save me-2"></i> {{clean( trans('niva-backend.create_user') )}}
                        </button>
                    </div>
                </div>

            </form>
        </div>
    </div>

</div>
<!-- /.container-fluid -->




@endsection