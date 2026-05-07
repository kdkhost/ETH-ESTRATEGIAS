

@extends('layouts.admin')

@section('content')

<!-- Begin Page Content -->
<div class="container-fluid mb-5">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800 fw-bold">{{clean( trans('niva-backend.create_user') )}}</h1>
        <a href="{{ route('users.index') }}" class="btn btn-outline-secondary rounded-pill shadow-sm btn-sm px-4">
            <i class="fas fa-arrow-left fa-sm me-1"></i> {{clean( trans('niva-backend.back_user') )}}
        </a>
    </div>

    <!-- DataTales Example -->
    <div class="card gourmet-card-light shadow-sm border-0 col-lg-8 mx-auto">
        <div class="card-header py-4 bg-white border-0 d-flex align-items-center">
            <div class="icon-shape bg-primary text-white me-3 shadow-sm" style="width: 45px; height: 45px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.2rem;">
                <i class="fas fa-user-plus"></i>
            </div>
            <h6 class="m-0 font-weight-bold text-dark fs-5">Informações do Novo Usuário</h6>
        </div>
        <div class="card-body p-4 pt-2">

            @if ($message = Session::get('user_success'))
                <div class="alert alert-success alert-dismissible fade show rounded-3 shadow-sm" role="alert">
                    <i class="fas fa-check-circle me-2"></i> <strong>{{ $message }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            
            @include('includes.form-errors')

            <form action="{{route('users.store')}}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="fw-semibold text-muted mb-2">{{clean( trans('niva-backend.name') )}}</label>
                            <input type="text" name="name" class="form-control form-control-lg rounded-3 bg-light border-0 shadow-none px-4" placeholder="Nome completo" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="fw-semibold text-muted mb-2">{{clean( trans('niva-backend.email') )}}</label>
                            <input type="email" name="email" class="form-control form-control-lg rounded-3 bg-light border-0 shadow-none px-4" placeholder="E-mail de acesso" required>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="fw-semibold text-muted mb-2">{{clean( trans('niva-backend.roles') )}}</label>
                            <select name="role_id" id="role_id" class="form-select form-select-lg rounded-3 bg-light border-0 shadow-none px-4" required>
                                <option value="">{{clean( trans('niva-backend.choose_role') )}}</option>
                                @foreach($roles as $role)
                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                @endforeach 
                            </select>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="fw-semibold text-muted mb-2">{{clean( trans('niva-backend.password') )}}</label>
                            <input type="password" name="password" class="form-control form-control-lg rounded-3 bg-light border-0 shadow-none px-4" placeholder="Senha segura" required>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="fw-semibold text-muted mb-2">{{clean( trans('niva-backend.address') )}}</label>
                            <input type="text" name="address" class="form-control form-control-lg rounded-3 bg-light border-0 shadow-none px-4" placeholder="Endereço">
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="fw-semibold text-muted mb-2">{{clean( trans('niva-backend.city') )}}</label>
                            <input type="text" name="city" class="form-control form-control-lg rounded-3 bg-light border-0 shadow-none px-4" placeholder="Cidade">
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="fw-semibold text-muted mb-2">{{clean( trans('niva-backend.phone') )}}</label>
                            <input type="text" name="phone" class="form-control form-control-lg rounded-3 bg-light border-0 shadow-none px-4" placeholder="Telefone">
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="fw-semibold text-muted mb-2">{{clean( trans('niva-backend.photo') )}}</label>
                            <div class="input-group">
                                <input type="file" name="photo_id" class="form-control form-control-lg bg-light border-0 shadow-none" id="photo_id">
                            </div>
                            <small class="text-muted mt-1 d-block">Resolução ideal: 200x200px</small>
                        </div>
                    </div>

                    <div class="col-12 text-end mt-5 border-top pt-4">
                        <button type="submit" class="btn btn-primary btn-lg rounded-pill px-5 shadow-sm">
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