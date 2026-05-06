@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Categorias de Projetos</h1>
        <div class="d-flex gap-2">
            <a href="{{route('project.index') . '?language=' . request()->input('language')}}" class="btn btn-light shadow-sm btn-sm">
                <i class="fas fa-arrow-left fa-sm me-1"></i> Voltar Projetos
            </a>
        </div>
    </div>

    <div class="card gourmet-card-light shadow-sm border-0">
        <div class="card-header py-3 bg-white border-0 d-flex align-items-center">
            <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-folder-open me-2"></i>Gerenciar Categorias de Portfólio</h6>
            @if (!empty($langs))
                <select name="language" class="form-select form-select-sm language-control ms-auto rounded-pill px-3" style="width: 160px;" onchange="window.location='{{url()->current() . '?language='}}'+this.value">
                    <option value="" selected disabled>{{clean( trans('niva-backend.select_language') )}}</option>
                    @foreach ($langs as $lang)
                        <option value="{{$lang->code}}" {{$lang->code == request()->input('language') ? 'selected' : ''}}>{{$lang->name}}</option>
                    @endforeach
                </select>
            @endif
        </div>
        <div class="card-body p-4">
            <div class="row g-4">
                {{-- Listagem --}}
                <div class="col-md-7">
                    <form action="{{route('delete.project-category')}}" method="POST" id="delete-categories-form">
                        @csrf
                        @method('DELETE')

                        <div class="d-flex align-items-center mb-4 pb-3 border-bottom">
                            <select name="bulk_action" class="form-select form-select-sm me-2 rounded-pill px-3" style="width: 180px;">
                                <option value="delete">{{clean( trans('niva-backend.delete') )}}</option>
                            </select>
                            <button type="submit" name="delete_all" class="btn btn-danger btn-sm shadow-sm rounded-pill px-4">
                                <i class="fas fa-check-double me-1"></i> Aplicar
                            </button>
                        </div>
                    </form>

                    <div class="table-responsive">
                        <table class="table table-hover align-middle border-0" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr class="text-secondary small text-uppercase">
                                    <th class="border-0 px-3" width="40"><input type="checkbox" id="options" class="form-check-input"></th>
                                    <th class="border-0" width="80">ID</th>
                                    <th class="border-0">{{clean( trans('niva-backend.name') )}}</th>
                                    <th class="border-0 text-end px-3">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($categories)
                                    @foreach($categories as $category)
                                        <tr class="border-bottom-0">
                                            <td class="px-3"><input class="checkboxes form-check-input" form="delete-categories-form" type="checkbox" name="checkbox_array[]" value="{{$category->id}}"></td>
                                            <td><span class="badge bg-light text-secondary rounded-pill">#{{$category->id}}</span></td>
                                            <td class="fw-bold text-dark">{{$category->name}}</td>
                                            <td class="text-end px-3">
                                                <div class="d-flex justify-content-end gap-2">
                                                    <a href="{{ route('project-category.edit', $category->id) . '?language=' . request()->input('language')}}" class="btn btn-sm btn-outline-primary border-0 rounded-circle p-2" title="Editar">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <form action="{{ route('project-category.destroy', $category->id) }}" method="POST" class="d-inline single-delete-form">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-outline-danger border-0 rounded-circle p-2" title="Excluir">
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
                    <div class="mt-4 d-flex justify-content-center">
                        {!! $categories->appends(request()->input())->render() !!}
                    </div>
                </div>

                {{-- Criação --}}
                <div class="col-md-5">
                    <div class="card bg-light border-0 rounded-4 shadow-sm h-100">
                        <div class="card-body p-4">
                            <h5 class="card-title mb-4 fw-bold text-dark"><i class="fas fa-plus-circle me-2 text-primary"></i>Nova Categoria</h5>
                            @include('includes.form-errors')
                            <form action="{{route('project-category.store')}}" method="POST">
                                @csrf
                                <div class="mb-4">
                                    <label class="form-label fw-bold small text-muted text-uppercase">Nome da Categoria</label>
                                    <input type="text" name="name" class="form-control form-control-lg shadow-sm" placeholder="Ex: Web Design" required>
                                    <input type="hidden" name="language_id" value="{{$lang_id}}">
                                </div>
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary btn-lg shadow rounded-pill fw-bold">
                                        <i class="fas fa-plus me-1"></i> Criar Categoria
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
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

        $('#delete-categories-form').on('submit', function(e) {
            if ($('.checkboxes:checked').length === 0) {
                e.preventDefault();
                showToasty('Selecione pelo menos uma categoria para excluir.', 'error');
                return;
            }

            e.preventDefault();
            Swal.fire({
                title: 'Tem certeza?',
                text: "As categorias selecionadas serão excluídas permanentemente!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#0d6efd',
                confirmButtonText: 'Sim, excluir!',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    $('<input>').attr({type: 'hidden', name: 'delete_all', value: '1'}).appendTo(this);
                    this.submit();
                }
            });
        });
    });
</script>
@stop


