@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{clean( trans('niva-backend.categories') )}} de Projetos</h1>
        <div class="d-flex gap-2">
            <a href="{{route('project.index') . '?language=' . request()->input('language')}}" class="btn btn-light shadow-sm btn-sm">
                <i class="fas fa-project-diagram fa-sm me-1"></i> Voltar aos Projetos
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-7">
            <div class="card shadow mb-4 border-0">
                <div class="card-header py-3 bg-white border-0 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Categorias Existentes</h6>
                    @if (!empty($langs))
                        <select name="language" class="form-select form-select-sm language-control" style="width: 150px;" onchange="window.location='{{url()->current() . '?language='}}'+this.value">
                            <option value="" selected disabled>{{clean( trans('niva-backend.select_language') )}}</option>
                            @foreach ($langs as $lang)
                                <option value="{{$lang->code}}" {{$lang->code == request()->input('language') ? 'selected' : ''}}>{{$lang->name}}</option>
                            @endforeach
                        </select>
                    @endif
                </div>
                <div class="card-body">
                    <form action="{{route('delete.project-category')}}" method="POST" id="delete-project-categories-form">
                        @csrf
                        @method('DELETE')

                        <div class="d-flex align-items-center mb-4">
                            <select name="bulk_action" class="form-select form-select-sm me-2" style="width: 150px;">
                                <option value="delete">{{clean( trans('niva-backend.delete') )}}</option>
                            </select>
                            <button type="submit" name="delete_all" class="btn btn-danger btn-sm px-4 shadow-sm rounded-pill">
                                <i class="fas fa-trash-alt me-1"></i> Aplicar
                            </button>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-hover align-middle border-0" id="dataTable" width="100%" cellspacing="0">
                                <thead class="bg-light">
                                    <tr>
                                        <th class="border-0"><input type="checkbox" id="options" class="form-check-input"></th>
                                        <th class="border-0">ID</th>
                                        <th class="border-0">Nome</th>
                                        <th class="border-0 text-end">Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($categories)
                                        @foreach($categories as $category)
                                            <tr>
                                                <td><input class="checkboxes form-check-input" type="checkbox" name="checkbox_array[]" value="{{$category->id}}"></td>
                                                <td><span class="badge bg-light text-dark border">#{{$category->id}}</span></td>
                                                <td class="fw-bold">{{$category->name}}</td>
                                                <td class="text-end">
                                                    <div class="d-flex justify-content-end gap-1">
                                                        <a href="{{ route('project-category.edit', $category->id) . '?language=' . request()->input('language')}}" class="btn btn-sm btn-outline-primary border-0 shadow-none">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <form action="{{ route('project-category.destroy', $category->id) }}" method="POST" class="d-inline single-delete-form">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-outline-danger border-0 shadow-none">
                                                                <i class="fas fa-trash-alt"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                         @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-5">
            <div class="card shadow mb-4 border-0">
                <div class="card-header py-3 bg-white border-0">
                    <h6 class="m-0 font-weight-bold text-primary">Criar Nova Categoria</h6>
                </div>
                <div class="card-body">
                    @include('includes.form-errors')

                    <form action="{{route('project-category.store')}}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label fw-bold">Nome da Categoria</label>
                            <input type="text" name="name" class="form-control" placeholder="Ex: Web Design, SEO..." required>
                            <input type="hidden" name="language_id" value="{{$lang_id}}">
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-primary px-4 shadow-sm rounded-pill">
                                <i class="fas fa-plus me-1"></i> Criar Categoria
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('footer')
<script>
    $(document).ready(function() {
        $('#options').click(function() {
            $('.checkboxes').prop('checked', this.checked);
        });

        $('#delete-project-categories-form').on('submit', function(e) {
            if ($('.checkboxes:checked').length === 0) {
                e.preventDefault();
                showToasty('Selecione pelo menos uma categoria para excluir.', 'error');
                return;
            }

            e.preventDefault();
            Swal.fire({
                title: 'Tem certeza?',
                text: "As categorias de projeto selecionadas serão excluídas permanentemente!",
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
