@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{clean( trans('niva-backend.section_clients') )}}</h1>
        <div class="d-flex gap-2">
            <a href="{{route('home-setting.edit') . '?language=' . request()->input('language')}}" class="btn btn-light shadow-sm btn-sm">
                <i class="fas fa-home fa-sm me-1"></i> Voltar Home
            </a>
            <a href="{{route('client.create') . '?language=' . request()->input('language')}}" class="btn btn-primary shadow-sm btn-sm">
                <i class="fas fa-plus fa-sm me-1"></i> Novo Cliente
            </a>
        </div>
    </div>

    <div class="card shadow mb-4 border-0">
        <div class="card-header py-3 bg-white border-0 d-flex align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">{{clean( trans('niva-backend.section_clients') )}}</h6>
            @if (!empty($langs))
                <select name="language" class="form-select form-select-sm language-control ms-auto" style="width: 150px;" onchange="window.location='{{url()->current() . '?language='}}'+this.value">
                    <option value="" selected disabled>{{clean( trans('niva-backend.select_language') )}}</option>
                    @foreach ($langs as $lang)
                        <option value="{{$lang->code}}" {{$lang->code == request()->input('language') ? 'selected' : ''}}>{{$lang->name}}</option>
                    @endforeach
                </select>
            @endif
        </div>
        <div class="card-body">
            <form action="{{route('delete.client')}}" method="POST" id="delete-clients-form">
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

                </form>
                <div class="table-responsive">
                    <table class="table table-hover align-middle border-0" id="dataTable" width="100%" cellspacing="0">
                        <thead class="bg-light">
                            <tr>
                                <th class="border-0"><input type="checkbox" id="options" class="form-check-input"></th>
                                <th class="border-0">{{clean( trans('niva-backend.photo') )}}</th>
                                <th class="border-0">Nome do Cliente</th>
                                <th class="border-0">Link / Site</th>
                                <th class="border-0 text-end">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($clients)
                                @foreach($clients as $client)
                                    <tr>
                                        <td><input class="checkboxes form-check-input" form="delete-clients-form" type="checkbox" name="checkbox_array[]" value="{{$client->id}}"></td>
                                        <td>
                                            <div class="bg-light p-2 rounded border d-inline-block shadow-sm">
                                                <img loading="lazy" width="100" style="object-fit: contain; height: 40px;" src="{{$client->photo ? asset('images/media/' . $client->photo->file) : asset('img/200x200.png')}}" alt="Logo">
                                            </div>
                                        </td>
                                        <td class="fw-bold">{{$client->company_name}}</td>
                                        <td>
                                            @if($client->company_link)
                                                <a href="{{$client->company_link}}" target="_blank" class="text-decoration-none small">
                                                    <i class="fas fa-external-link-alt me-1"></i> {{Str::limit($client->company_link, 30)}}
                                                </a>
                                            @else
                                                <span class="text-muted small">Nenhum link</span>
                                            @endif
                                        </td>
                                        <td class="text-end">
                                            <div class="d-flex justify-content-end gap-1">
                                                <a href="{{ route('client.edit', $client->id) . '?language=' . request()->input('language')}}" class="btn btn-sm btn-outline-primary border-0 shadow-none">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('client.destroy', $client->id) }}" method="POST" class="d-inline single-delete-form">
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

        // Exclusao em LOTE
        $('[id$="-form"]').not('.single-delete-form').on('submit', function(e) {
            if ($('.checkboxes:checked').length === 0) {
                e.preventDefault();
                showToasty('Selecione pelo menos um item para excluir.', 'error');
                return;
            }
            e.preventDefault();
            let form = this;
            Swal.fire({
                title: 'Tem certeza?',
                text: "Os itens selecionados serao excluidos permanentemente!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#0d6efd',
                confirmButtonText: 'Sim, excluir!',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    $('<input>').attr({type: 'hidden', name: 'delete_all', value: '1'}).appendTo($(form));
                    form.submit();
                }
            });
        });

        // Exclusao INDIVIDUAL com SweetAlert
        $(document).on('submit', '.single-delete-form', function(e) {
            e.preventDefault();
            let form = this;
            Swal.fire({
                title: 'Confirmar exclusao?',
                text: "Este item sera excluido permanentemente.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Sim, excluir!',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) { form.submit(); }
            });
        });
    });
</script>
@stop