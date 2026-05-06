@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{clean( trans('niva-backend.section_7_blog') )}}</h1>
        <div class="d-flex gap-2">
            @if(Auth::user()->role->name == 'administrator')
                <a href="{{route('home-setting.edit') . '?language=' . request()->input('language')}}" class="btn btn-light shadow-sm btn-sm">
                    <i class="fas fa-home fa-sm me-1"></i> {{clean( trans('niva-backend.back_homepage') )}}
                </a>
                <a href="{{route('blog-setting.edit') . '?language=' . request()->input('language')}}" class="btn btn-light shadow-sm btn-sm">
                    <i class="fas fa-cog fa-sm me-1"></i> {{clean( trans('niva-backend.back_blogpage') )}}
                </a>
            @endif
            <a href="{{route('post.create') . '?language=' . request()->input('language')}}" class="btn btn-primary shadow-sm btn-sm">
                <i class="fas fa-plus fa-sm me-1"></i> {{clean( trans('niva-backend.create_article') )}}
            </a>
        </div>
    </div>

    <div class="card gourmet-card-light shadow-sm border-0">
        <div class="card-header py-3 bg-white border-0 d-flex align-items-center">
            <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-newspaper me-2"></i>{{clean( trans('niva-backend.section_7_blog') )}}</h6>
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
            <form action="{{route('delete.post')}}" method="POST" id="delete-posts-form">
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
                                <th class="border-0">{{clean( trans('niva-backend.id') )}}</th>
                                <th class="border-0">{{clean( trans('niva-backend.photo') )}}</th>
                                <th class="border-0">{{clean( trans('niva-backend.owner') )}}</th>
                                <th class="border-0">{{clean( trans('niva-backend.title') )}}</th>
                                <th class="border-0">{{clean( trans('niva-backend.category') )}}</th>
                                <th class="border-0 text-end px-3">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($posts)
                                @foreach($posts as $post)
                                    <tr class="border-bottom-0">
                                        <td class="px-3"><input class="checkboxes form-check-input" form="delete-posts-form" type="checkbox" name="checkbox_array[]" value="{{$post->id}}"></td>
                                        <td><span class="badge bg-light text-secondary rounded-pill">#{{$post->id}}</span></td>
                                        <td>
                                            <img loading="lazy" width="80" class="rounded-3 shadow-sm" src="{{$post->photo ? asset('images/media/' . $post->photo->file) : asset('img/200x200.png')}}" alt="">
                                        </td>
                                        <td>
                                            <div class="fw-bold text-dark">{{$user->name ?? $post->user->name}}</div>
                                            <small class="text-muted">{{$user->email ?? $post->user->email}}</small>
                                        </td>
                                        <td>
                                            <div class="fw-bold text-dark">{{$post->title}}</div>
                                            <small class="text-muted d-block text-truncate" style="max-width: 250px;">{{strip_tags($post->meta_description)}}</small>
                                        </td>
                                        <td>
                                            <span class="badge bg-primary-subtle text-primary border border-primary px-3 rounded-pill">
                                                {{$post->category ? $post->category->name : 'Sem Categoria'}}
                                            </span>
                                        </td>
                                        <td class="text-end px-3">
                                            <div class="d-flex justify-content-end gap-2">
                                                <a href="{{ route('post.edit', $post->id) . '?language=' . request()->input('language')}}" class="btn btn-sm btn-outline-primary border-0 rounded-circle p-2" title="Editar">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('post.destroy', $post->id) }}" method="POST" class="d-inline single-delete-form">
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
            </form>
        </div>
    </div>

</div>
@stop

@section('styles')
<style>
    .bg-soft-primary { background-color: rgba(13, 110, 253, 0.1); }
    .table thead th { font-weight: 600; text-transform: uppercase; font-size: 0.75rem; letter-spacing: 0.5px; }
    [data-bs-theme="dark"] .bg-white { background-color: transparent !important; }
</style>
@stop
@section('footer')
<script>
    $(document).ready(function() {
        // Selecionar todos os checkboxes
        $('#options').click(function() {
            $('.checkboxes').prop('checked', this.checked);
        });

        // Exclusão em LOTE Padronizada
        $('#delete-posts-form').on('submit', function(e) {
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