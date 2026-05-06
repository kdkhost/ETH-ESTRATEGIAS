@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{clean( trans('niva-backend.all_members') )}}</h1>
        <div class="d-flex gap-2">
            <a href="{{route('about-setting.edit')}}" class="btn btn-light shadow-sm btn-sm">
                <i class="fas fa-arrow-left fa-sm me-1"></i> Voltar Sobre
            </a>
            <a href="{{route('member.create')}}" class="btn btn-primary shadow-sm btn-sm">
                <i class="fas fa-user-plus fa-sm me-1"></i> {{clean( trans('niva-backend.create') )}}
            </a>
        </div>
    </div>

    <div class="card shadow mb-4 border-0">
        <div class="card-header py-3 bg-white border-0">
            <h6 class="m-0 font-weight-bold text-primary">Equipe & Membros</h6>
        </div>
        <div class="card-body">
            <form action="{{route('delete.member')}}" method="POST" id="delete-members-form">
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

                </form>
                <div class="table-responsive">
                    <table class="table table-hover align-middle border-0" id="dataTable" width="100%" cellspacing="0">
                        <thead class="bg-light">
                            <tr>
                                <th class="border-0"><input type="checkbox" id="options" class="form-check-input"></th>
                                <th class="border-0">{{clean( trans('niva-backend.photo') )}}</th>
                                <th class="border-0">{{clean( trans('niva-backend.name') )}}</th>
                                <th class="border-0">{{clean( trans('niva-backend.position') )}}</th>
                                <th class="border-0 text-end">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($members)
                                @foreach($members as $member)
                                    <tr>
                                        <td><input class="checkboxes form-check-input" form="delete-members-form" type="checkbox" name="checkbox_array[]" value="{{$member->id}}"></td>
                                        <td>
                                            <img loading="lazy" width="60" height="60" class="rounded-circle shadow-sm object-fit-cover" src="{{$member->photo ? asset('images/media/' . $member->photo->file) : asset('img/200x200.png')}}" alt="">
                                        </td>
                                        <td class="fw-bold">{{$member->name}}</td>
                                        <td><span class="badge bg-light text-dark border px-3">{{$member->position}}</span></td>
                                        <td class="text-end">
                                            <div class="d-flex justify-content-end gap-1">
                                                <a href="{{ route('member.edit', $member->id) }}" class="btn btn-sm btn-outline-primary border-0 shadow-none">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('member.destroy', $member->id) }}" method="POST" class="d-inline single-delete-form">
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
        $('#options').click(function() {
            $('.checkboxes').prop('checked', this.checked);
        });

        $('#delete-members-form').on('submit', function(e) {
            if ($('.checkboxes:checked').length === 0) {
                e.preventDefault();
                showToasty('Selecione pelo menos um membro para excluir.', 'error');
                return;
            }

            e.preventDefault();
            Swal.fire({
                title: 'Tem certeza?',
                text: "Os membros selecionados serão excluídos permanentemente!",
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



