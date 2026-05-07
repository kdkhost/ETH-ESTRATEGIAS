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

    <div class="card gourmet-card-light shadow-sm border-0">
        <div class="card-header py-3 bg-white border-0 d-flex align-items-center">
            <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-tags me-2"></i>{{clean( trans('niva-backend.pricing_settings') )}}</h6>
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
            <form action="{{route('delete.pricing')}}" method="POST" id="delete-pricing-form">
                @csrf
                @method('DELETE')

                <div class="d-flex align-items-center mb-4 pb-3 border-bottom">
                    <select name="checkbox_array" class="form-select form-select-sm me-2 rounded-pill px-3" style="width: 180px;">
                        <option value="">Ações em Lote</option>
                        <option value="delete">{{clean( trans('niva-backend.delete') )}}</option>
                    </select>
                    <button type="submit" name="delete_all" class="btn btn-danger btn-sm shadow-sm rounded-pill px-4">
                        <i class="fas fa-check-double me-1"></i> Aplicar
                    </button>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover align-middle border-0" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr class="text-secondary small text-uppercase">
                                <th class="border-0 px-3"><input type="checkbox" id="options" class="form-check-input"></th>
                                <th class="border-0">Título do Plano</th>
                                <th class="border-0">Preço</th>
                                <th class="border-0">Recorrência</th>
                                <th class="border-0 text-end px-3">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($pricings)
                                @foreach($pricings as $pricing)
                                    <tr class="border-bottom-0">
                                        <td class="px-3"><input class="checkboxes form-check-input" form="delete-pricing-form" type="checkbox" name="checkbox_array[]" value="{{$pricing->id}}"></td>
                                        <td class="text-dark py-3">
                                            <div class="pricing-title-box">
                                                {!! clean(html_entity_decode($pricing->title)) !!}
                                            </div>
                                            <small class="text-muted d-block mt-1">ID: #{{$pricing->id}} - GOURMET v1.1</small>
                                        </td>
                                        <td>
                                            @if($pricing->price)
                                                <span class="badge bg-success-subtle text-success border border-success-subtle px-3 rounded-pill fw-bold">{{$pricing->price}}</span>
                                            @else
                                                <span class="text-muted small">N/A</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($pricing->currency)
                                                <span class="badge bg-primary-subtle text-primary border border-primary-subtle px-3 rounded-pill small fw-semibold">{{$pricing->currency}}</span>
                                            @else
                                                <span class="text-muted small">N/A</span>
                                            @endif
                                        </td>
                                        <td class="text-end px-3">
                                            <div class="d-flex justify-content-end gap-2">
                                                <a href="{{ route('pricing.edit', $pricing->id) . '?language=' . request()->input('language')}}" class="btn btn-sm btn-outline-primary border-0 rounded-circle p-2 shadow-none" title="Editar">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('pricing.destroy', $pricing->id) }}" method="POST" class="d-inline single-delete-form">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger border-0 rounded-circle p-2 shadow-none" title="Excluir">
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
        // Selecionar todos os checkboxes
        $('#options').click(function() {
            $('.checkboxes').prop('checked', this.checked);
        });

        // Exclusão em LOTE Padronizada
        $('#delete-pricing-form').on('submit', function(e) {
            e.preventDefault();
            if ($('.checkboxes:checked').length === 0) {
                showToasty('Selecione pelo menos um item para excluir.', 'error');
                return;
            }
            let form = this;
            Swal.fire({
                title: 'Confirmar exclusão em lote?',
                text: "Os itens selecionados serão excluídos permanentemente!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Sim, excluir!',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    $('<input>').attr({type: 'hidden', name: 'delete_all', value: '1'}).appendTo($(form));
                    form.submit();
                }
            });
        });
    });
</script>
@stop