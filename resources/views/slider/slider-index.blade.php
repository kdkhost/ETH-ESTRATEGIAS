@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{clean( trans('niva-backend.all_sliders') )}}</h1>
        <div class="d-flex gap-2">
            <a href="{{route('home-setting.edit') . '?language=' . request()->input('language')}}" class="btn btn-light shadow-sm btn-sm">
                <i class="fas fa-home fa-sm me-1"></i> {{clean( trans('niva-backend.back_homepage') )}}
            </a>
            <a href="{{route('slider.create') . '?language=' . request()->input('language')}}" class="btn btn-primary shadow-sm btn-sm">
                <i class="fas fa-plus fa-sm me-1"></i> {{clean( trans('niva-backend.create_slider') )}}
            </a>
        </div>
    </div>

    <div class="card shadow mb-4 border-0">
        <div class="card-header py-3 bg-white border-0 d-flex align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">{{clean( trans('niva-backend.all_sliders') )}}</h6>
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
            <form action="{{route('delete.slider')}}" method="POST" id="delete-sliders-form">
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
                                <th class="border-0">{{clean( trans('niva-backend.heading_1') )}}</th>
                                <th class="border-0">{{clean( trans('niva-backend.heading_2') )}}</th>
                                <th class="border-0">{{clean( trans('niva-backend.button_text') )}}</th>
                                <th class="border-0 text-end">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($sliders)
                                @foreach($sliders as $slider)
                                    <tr>
                                        <td><input class="checkboxes form-check-input" form="delete-sliders-form" type="checkbox" name="checkbox_array[]" value="{{$slider->id}}"></td>
                                        <td>
                                            <img width="80" class="rounded shadow-sm" src="{{$slider->photo ? asset('images/media/' . $slider->photo->file) : asset('img/200x200.png')}}" alt="">
                                        </td>
                                        <td class="fw-medium">{!!$slider->heading1!!}</td>
                                        <td>{{$slider->heading2}}</td>
                                        <td>
                                            <span class="badge bg-light text-dark border">{{$slider->button_text}}</span>
                                        </td>
                                        <td class="text-end">
                                            <div class="d-flex justify-content-end gap-1">
                                                <a href="{{ route('slider.edit', $slider->id) . '?language=' . request()->input('language')}}" class="btn btn-sm btn-outline-primary border-0 shadow-none">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('slider.destroy', $slider->id) }}" method="POST" class="d-inline single-delete-form">
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

        $('#delete-sliders-form').on('submit', function(e) {
            if ($('.checkboxes:checked').length === 0) {
                e.preventDefault();
                showToasty('Selecione pelo menos um slider para excluir.', 'error');
                return;
            }

            e.preventDefault();
            Swal.fire({
                title: 'Tem certeza?',
                text: "Os sliders selecionados serão excluídos permanentemente!",
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


