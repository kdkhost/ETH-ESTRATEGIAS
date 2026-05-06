@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{clean( trans('niva-backend.pricing_settings') )}}</h1>
        <div class="d-flex gap-2">
            <a href="{{route('home-setting.edit') . '?language=' . request()->input('language')}}" class="btn btn-light shadow-sm btn-sm">
                <i class="fas fa-home fa-sm me-1"></i> Voltar Home
            </a>
            <a href="{{route('pricing.create') . '?language=' . request()->input('language')}}" class="btn btn-primary shadow-sm btn-sm">
                <i class="fas fa-plus fa-sm me-1"></i> Nova Tabela
            </a>
        </div>
    </div>

    <div class="card shadow mb-4 border-0">
        <div class="card-header py-3 bg-white border-0 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Tabelas de Preços</h6>
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
            <form action="{{route('delete.pricing')}}" method="POST" id="delete-pricing-form">
                @csrf
                @method('DELETE')

                <div class="d-flex align-items-center mb-4">
                    <select name="checkbox_array" class="form-select form-select-sm me-2" style="width: 150px;">
                        <option value="">{{clean( trans('niva-backend.delete') )}}</option>
                    </select>
                    <button type="submit" name="delete_all" class="btn btn-danger btn-sm shadow-sm">
                        <i class="fas fa-trash-alt me-1"></i> Aplicar
                    </button>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover align-middle border-0" id="dataTable" width="100%" cellspacing="0">
                        <thead class="bg-light">
                            <tr>
                                <th class="border-0"><input type="checkbox" id="options" class="form-check-input"></th>
                                <th class="border-0">Título do Plano</th>
                                <th class="border-0">Preço</th>
                                <th class="border-0">Recorrência</th>
                                <th class="border-0 text-end">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($pricings)
                                @foreach($pricings as $pricing)
                                    <tr>
                                        <td><input class="checkboxes form-check-input" type="checkbox" name="checkbox_array[]" value="{{$pricing->id}}"></td>
                                        <td class="fw-bold">{{$pricing->title}}</td>
                                        <td>
                                            <span class="text-primary fw-bold">{{$pricing->price}}</span>
                                        </td>
                                        <td>
                                            <span class="badge bg-info-subtle text-info border border-info">{{$pricing->currency}}</span>
                                        </td>
                                        <td class="text-end">
                                            <a href="{{ route('pricing.edit', $pricing->id) . '?language=' . request()->input('language')}}" class="btn btn-sm btn-outline-primary border-0 shadow-none">
                                                <i class="fas fa-edit"></i>
                                            </a>
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

        $('#delete-pricing-form').on('submit', function(e) {
            if ($('.checkboxes:checked').length === 0) {
                e.preventDefault();
                showToasty('Selecione pelo menos uma tabela para excluir.', 'error');
                return;
            }

            e.preventDefault();
            Swal.fire({
                title: 'Tem certeza?',
                text: "As tabelas de preços selecionadas serão excluídas permanentemente!",
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
