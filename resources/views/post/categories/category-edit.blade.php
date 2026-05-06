@extends('layouts.admin')

@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">


    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{clean( trans('niva-backend.categories') )}}</h1>
        <a href="{{route('category.index')  . '?language=' . request()->input('language')}}" class="btn btn-light shadow-sm btn-sm ms-auto">
            <i class="fas fa-arrow-left fa-sm me-1"></i> {{clean( trans('niva-backend.back_categories') )}}
        </a>
    </div>

    <div class="card gourmet-card-light shadow-sm border-0 mb-4">
        <div class="card-header py-3 bg-white border-0 d-flex align-items-center">
            <h6 class="m-0 font-weight-bold text-primary uppercase"><i class="fas fa-folder-open me-2"></i> Editar Categoria Gourmet</h6>
        </div>
        <div class="card-body p-4">
            @include('includes.form-errors')

            <form action="{{route('category.update', $category->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row g-4 justify-content-center">
                    <div class="col-md-8">
                        <div class="card bg-light border-0 rounded-4 p-4 shadow-none mb-4">
                            <label class="form-label fw-bold small text-muted uppercase">Nome da Categoria</label>
                            <div class="input-group input-group-lg bg-white rounded-4 overflow-hidden border shadow-sm">
                                <span class="input-group-text bg-transparent border-0 ps-4"><i class="fas fa-tag text-primary opacity-50"></i></span>
                                <input type="text" name="name" class="form-control bg-transparent border-0 shadow-none ps-2" value="{{$category->name}}" placeholder="Ex: Tecnologia">
                            </div>
                            <small class="text-muted mt-3 d-block" style="font-size: 0.75rem;">
                                <i class="fas fa-info-circle me-1"></i> Use nomes claros e objetivos para facilitar a navegação do usuário no blog.
                            </small>
                        </div>

                        <div class="text-center mt-5">
                            <button type="submit" class="btn btn-primary btn-lg px-5 py-3 shadow-lg rounded-pill fw-bold">
                                <i class="fas fa-save me-2"></i> ATUALIZAR CATEGORIA
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>


</div>
<!-- /.container-fluid -->



@endsection
