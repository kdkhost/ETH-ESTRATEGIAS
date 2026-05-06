@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{clean( trans('niva-backend.all_users') )}}</h1>
        <a href="{{route('users.create')}}" class="btn btn-primary shadow-sm btn-sm">
            <i class="fas fa-user-plus fa-sm me-1"></i> {{clean( trans('niva-backend.create_user') )}}
        </a>
    </div>

    <div class="card shadow mb-4 border-0">
        <div class="card-header py-3 bg-white border-0">
            <h6 class="m-0 font-weight-bold text-primary">{{clean( trans('niva-backend.all_users') )}}</h6>
        </div>
        <div class="card-body">
            <form action="{{route('delete.users')}}" method="POST" id="delete-users-form">
                @csrf
                @method('DELETE')
                
                <input type="hidden" name="current_user" value="{{ auth()->user()->id }}">

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
                                <th class="border-0">{{clean( trans('niva-backend.name') )}}</th>
                                <th class="border-0">{{clean( trans('niva-backend.email') )}}</th>
                                <th class="border-0">{{clean( trans('niva-backend.role') )}}</th>
                                <th class="border-0 text-end">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($users)
                                @foreach($users as $user)
                                    <tr>
                                        <td>
                                            @if($user->id != auth()->user()->id)
                                                <input class="checkboxes form-check-input" type="checkbox" name="checkbox_array[]" value="{{$user->id}}">
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img width="40" height="40" class="rounded-circle shadow-sm me-3" src="{{$user->photo ? asset('images/media/' . $user->photo->file) : asset('img/200x200.png')}}" alt="">
                                                <div>
                                                    <div class="fw-bold">{{$user->name}}</div>
                                                    <small class="text-muted">ID: #{{$user->id}}</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{$user->email}}</td>
                                        <td>
                                            <span class="badge bg-primary-subtle text-primary border border-primary px-3">
                                                {{$user->role ? $user->role->name : 'Nenhum'}}
                                            </span>
                                        </td>
                                        <td class="text-end">
                                            <div class="d-flex justify-content-end gap-1">
                                                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-outline-primary border-0 shadow-none">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                @if($user->id != auth()->id())
                                                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline single-delete-form">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-outline-danger border-0 shadow-none">
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
            </form>
            <div class="mt-4">
                {!! $users->render() !!}
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

        $('#delete-users-form').on('submit', function(e) {
            if ($('.checkboxes:checked').length === 0) {
                e.preventDefault();
                showToasty('Selecione pelo menos um usuário para excluir.', 'error');
                return;
            }

            e.preventDefault();
            Swal.fire({
                title: 'Tem certeza?',
                text: "Os usuários selecionados serão excluídos permanentemente!",
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
