

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
    <div class="card shadow mb-4 border-0 rounded-4 overflow-hidden">
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
                        <label class="form-label fw-bold">{{clean( trans('niva-backend.name') )}}</label>
                        <input type="text" name="name" class="form-control" placeholder="Nome completo" required>
                    </div>
                    
                    <div class="col-md-6">
                        <label class="form-label fw-bold">{{clean( trans('niva-backend.email') )}}</label>
                        <input type="email" name="email" class="form-control" placeholder="E-mail de acesso" required>
                    </div>
                    
                    <div class="col-md-6">
                        <label class="form-label fw-bold">{{clean( trans('niva-backend.roles') )}}</label>
                        <select name="role_id" id="role_id" class="form-select" required>
                            <option value="">{{clean( trans('niva-backend.choose_role') )}}</option>
                            @foreach($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach 
                        </select>
                    </div>
                    
                    <div class="col-md-6">
                        <label class="form-label fw-bold">{{clean( trans('niva-backend.password') )}}</label>
                        <input type="password" name="password" class="form-control" placeholder="Senha de acesso" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-bold">{{clean( trans('niva-backend.address') )}}</label>
                        <input type="text" name="address" class="form-control" placeholder="Endereço">
                    </div>
                    
                    <div class="col-md-6">
                        <label class="form-label fw-bold">{{clean( trans('niva-backend.city') )}}</label>
                        <input type="text" name="city" class="form-control" placeholder="Cidade">
                    </div>
                    
                    <div class="col-md-6">
                        <label class="form-label fw-bold">{{clean( trans('niva-backend.phone') )}}</label>
                        <input type="text" name="phone" class="form-control" placeholder="Telefone">
                    </div>
                    
                    <div class="col-md-6">
                        <div class="card bg-light border-0 rounded-4 p-3 m-0 shadow-none h-100">
                            <label class="form-label fw-bold d-block mb-3">{{clean( trans('niva-backend.photo') )}}</label>
                            <input type="file" name="photo_id" class="form-control" id="photo_id">
                            <small class="text-muted d-block mt-2">Resolução ideal: 200x200px</small>
                        </div>
                    </div>

                    <div class="col-12 text-center mt-5">
                        <button type="submit" class="btn btn-primary btn-lg px-5 shadow rounded-pill">
                            <i class="fas fa-save me-2"></i> {{clean( trans('niva-backend.create_user') )}}
                        </button>
                    </div>
                </div>

            </form>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

@stop

@section('styles')
<style>
    .rounded-4 { border-radius: 1rem !important; }
    .form-label { font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 0.5rem; color: #6c757d; }
    .form-control, .form-select { border-radius: 0.5rem; padding: 0.6rem 1rem; border-color: #dee2e6; }
    .form-control:focus, .form-select:focus { border-color: #0d6efd; box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.05); }
    .card-header { background-color: #f8f9fa; }
    [data-bs-theme="dark"] .card-header { background-color: rgba(255,255,255,0.05); }
</style>
@endsection




@endsection