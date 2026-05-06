@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{clean( trans('niva-backend.section_projects') )}}</h1>
        <div class="d-flex gap-2">
            <a href="{{route('portfolio-setting.edit') . '?language=' . request()->input('language')}}" class="btn btn-light shadow-sm btn-sm">
                <i class="fas fa-cog fa-sm me-1"></i> Configurar Portfolio
            </a>
            <a href="{{route('project.create') . '?language=' . request()->input('language')}}" class="btn btn-primary shadow-sm btn-sm">
                <i class="fas fa-plus fa-sm me-1"></i> Novo Projeto
            </a>
        </div>
    </div>

    <div class="card shadow mb-4 border-0">
        <div class="card-header py-3 bg-white border-0 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Projetos & Portfólio</h6>
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
            <form action="{{route('delete.project')}}" method="POST" id="delete-projects-form">
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
                                <th class="border-0">{{clean( trans('niva-backend.photo') )}}</th>
                                <th class="border-0">Autor</th>
                                <th class="border-0">{{clean( trans('niva-backend.title') )}}</th>
                                <th class="border-0">Categoria</th>
                                <th class="border-0 text-end">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($projects)
                                @foreach($projects as $project)
                                    <tr>
                                        <td><input class="checkboxes form-check-input" type="checkbox" name="checkbox_array[]" value="{{$project->id}}"></td>
                                        <td>
                                            <img width="80" class="rounded shadow-sm" src="{{$project->photo ? asset('images/media/' . $project->photo->file) : asset('img/200x200.png')}}" alt="">
                                        </td>
                                        <td>
                                            <div class="fw-bold small">{{$project->user->name}}</div>
                                        </td>
                                        <td>
                                            <div class="fw-bold">{{$project->title}}</div>
                                            <small class="text-muted d-block text-truncate" style="max-width: 250px;">{{Str::limit(strip_tags($project->body), 50)}}</small>
                                        </td>
                                        <td>
                                            <span class="badge bg-secondary-subtle text-secondary border px-3">
                                                {{$project->project_category ? $project->project_category->name : 'Sem Categoria'}}
                                            </span>
                                        </td>
                                        <td class="text-end">
                                            <div class="d-flex justify-content-end gap-1">
                                                <a href="{{ route('project.edit', $project->id) . '?language=' . request()->input('language')}}" class="btn btn-sm btn-outline-primary border-0 shadow-none">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('project.destroy', $project->id) }}" method="POST" class="d-inline single-delete-form">
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
            <div class="mt-4">
                {!! $projects->appends(request()->input())->render() !!}
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

        $('#delete-projects-form').on('submit', function(e) {
            if ($('.checkboxes:checked').length === 0) {
                e.preventDefault();
                showToasty('Selecione pelo menos um projeto para excluir.', 'error');
                return;
            }

            e.preventDefault();
            Swal.fire({
                title: 'Tem certeza?',
                text: "Os projetos selecionados serão excluídos permanentemente!",
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
