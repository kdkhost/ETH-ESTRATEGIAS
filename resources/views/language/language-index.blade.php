@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{clean( trans('niva-backend.all_languages') )}}</h1>
        <div class="d-flex gap-2">
            <a href="{{route('language.create')}}" class="btn btn-primary shadow-sm btn-sm">
                <i class="fas fa-plus fa-sm me-1"></i> Novo Idioma
            </a>
        </div>
    </div>

    <div class="card shadow mb-4 border-0">
        <div class="card-header py-3 bg-white border-0">
            <h6 class="m-0 font-weight-bold text-primary">Idiomas Instalados</h6>
        </div>
        <div class="card-body">
            <form action="{{route('delete.language')}}" method="POST" id="delete-languages-form">
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
                                <th class="border-0">Bandeira</th>
                                <th class="border-0">{{clean( trans('niva-backend.name') )}}</th>
                                <th class="border-0">Código</th>
                                <th class="border-0">Padrão</th>
                                <th class="border-0">Direção</th>
                                <th class="border-0 text-end">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($languages)
                                @foreach($languages->sortBy('id') as $language)
                                    <tr>
                                        <td><input class="checkboxes form-check-input" type="checkbox" name="checkbox_array[]" value="{{$language->id}}"></td>
                                        <td>
                                            <img height="30" class="rounded shadow-sm border" src="{{$language->photo ? asset('images/media/' . $language->photo->file) : asset('img/200x200.png')}}" alt="">
                                        </td>
                                        <td class="fw-bold">{{$language->name}}</td>
                                        <td><code class="text-primary">{{$language->code}}</code></td>
                                        <td>
                                            @if($language->is_default == 1)
                                                <span class="badge bg-success-subtle text-success border border-success">Sim</span>
                                            @else
                                                <span class="badge bg-light text-muted border">Não</span>
                                            @endif
                                        </td>
                                        <td>
                                            <span class="badge bg-info-subtle text-info border border-info">{{ $language->rtl == 1 ? 'RTL' : 'LTR'}}</span>
                                        </td>
                                        <td class="text-end">
                                            <div class="d-flex justify-content-end gap-1">
                                                <a href="{{ route('language.edit', $language->id)}}" class="btn btn-sm btn-outline-primary border-0 shadow-none">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('language.destroy', $language->id) }}" method="POST" class="d-inline single-delete-form">
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
@stop

@section('footer')
<script>
    $(document).ready(function() {
        $('#options').click(function() {
            $('.checkboxes').prop('checked', this.checked);
        });

        $('#delete-languages-form').on('submit', function(e) {
            if ($('.checkboxes:checked').length === 0) {
                e.preventDefault();
                showToasty('Selecione pelo menos um idioma para excluir.', 'error');
                return;
            }

            e.preventDefault();
            Swal.fire({
                title: 'Tem certeza?',
                text: "Os idiomas selecionados serão excluídos permanentemente!",
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
