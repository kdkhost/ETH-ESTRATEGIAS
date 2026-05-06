@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{clean( trans('niva-backend.all_users') )}}</h1>
        <a href="{{route('users.create')}}" class="btn btn-primary shadow-sm btn-sm">
            <i class="fas fa-user-plus fa-sm me-1"></i> {{clean( trans('niva-backend.create_user') )}}
        </a>
    </div>

    <div class="card gourmet-card-light shadow-sm border-0">
        <div class="card-header py-3 bg-white border-0">
            <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-users me-2"></i>{{clean( trans('niva-backend.all_users') )}}</h6>
        </div>
        <div class="card-body p-4">

            {{-- Formulário de exclusão em LOTE --}}
            <form action="{{route('delete.users')}}" method="POST" id="delete-users-form">
                @csrf
                @method('DELETE')
                <input type="hidden" name="current_user" value="{{ auth()->user()->id }}">
                <div class="d-flex align-items-center mb-4 pb-3 border-bottom">
                    <select name="action" class="form-select form-select-sm me-2 rounded-pill px-3" style="width: 180px;">
                        <option value="delete">{{clean( trans('niva-backend.delete') )}}</option>
                    </select>
                    <button type="submit" class="btn btn-danger btn-sm shadow-sm rounded-pill px-4">
                        <i class="fas fa-trash-alt me-1"></i> Aplicar
                    </button>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-hover align-middle border-0" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr class="text-secondary small text-uppercase">
                            <th class="border-0 px-3"><input type="checkbox" id="options" form="delete-users-form" class="form-check-input"></th>
                            <th class="border-0">{{clean( trans('niva-backend.name') )}}</th>
                            <th class="border-0">{{clean( trans('niva-backend.email') )}}</th>
                            <th class="border-0">{{clean( trans('niva-backend.role') )}}</th>
                            <th class="border-0 text-end px-3">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($users)
                            @foreach($users as $user)
                                <tr class="border-bottom-0">
                                    <td class="px-3">
                                        @if($user->id != auth()->user()->id)
                                            <input class="checkboxes form-check-input" type="checkbox"
                                                   name="checkbox_array[]" value="{{$user->id}}"
                                                   form="delete-users-form">
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img loading="lazy" width="45" height="45" class="rounded-circle shadow-sm me-3 border border-2 border-white"
                                                 src="{{$user->photo ? asset('images/media/' . $user->photo->file) : asset('img/200x200.png')}}" alt="">
                                            <div>
                                                <div class="fw-bold text-dark">{{$user->name}}</div>
                                                <small class="text-muted">ID: #{{$user->id}}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td><span class="text-muted">{{$user->email}}</span></td>
                                    <td>
                                        <span class="badge bg-primary-subtle text-primary border border-primary px-3 rounded-pill">
                                            {{$user->role ? $user->role->name : 'Nenhum'}}
                                        </span>
                                    </td>
                                    <td class="text-end px-3">
                                        <div class="d-flex justify-content-end gap-2">
                                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-outline-primary border-0 rounded-circle p-2" title="Editar">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            @if($user->id != auth()->id())
                                                <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline single-delete-form">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger border-0 rounded-circle p-2" title="Excluir">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                             @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
            <div class="mt-4 d-flex justify-content-center">
                {!! $users->render() !!}
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

        // Exclusão em LOTE Padronizada
        $('#delete-users-form').on('submit', function(e) {
            e.preventDefault();
            if ($('.checkboxes:checked').length === 0) {
                showToasty('Selecione pelo menos um usuário para excluir.', 'error');
                return;
            }
            let form = this;
            Swal.fire({
                title: 'Confirmar exclusão em lote?',
                text: "Os usuários selecionados serão removidos permanentemente!",
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

