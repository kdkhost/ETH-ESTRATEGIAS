@extends('layouts.admin')

@section('content')

@include('includes.tinyeditor')

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{clean( trans('niva-backend.edit_slider') )}}</h1>
        <a href="{{route('slider.index') . '?language=' . request()->input('language')}}" class="btn btn-sm btn-outline-primary rounded-pill px-3">
            <i class="fas fa-arrow-left me-1"></i> {{clean( trans('niva-backend.back_slider') )}}
        </a>
    </div>

    @include('includes.form-errors')

    <div class="card gourmet-card-light shadow-sm border-0 rounded-4">
        <div class="card-header bg-white py-3 border-0">
            <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-edit me-2"></i>{{clean( trans('niva-backend.edit_slider') )}}</h6>
        </div>
        <div class="card-body p-4">
            <form action="{{route('slider.update', $slider->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">{{clean( trans('niva-backend.heading_1') )}}</label>
                                <input type="text" name="heading1" class="form-control rounded-3" value="{{$slider->heading1}}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">{{clean( trans('niva-backend.heading_2') )}}</label>
                                <input type="text" name="heading2" class="form-control rounded-3" value="{{$slider->heading2}}">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">{{clean( trans('niva-backend.typed_text') )}}</label>
                            <input type="text" name="typed_text" class="form-control rounded-3" value="{{$slider->typed_text}}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">{{clean( trans('niva-backend.body') )}}</label>
                            <textarea name="bodyslider" class="form-control" id="bodyslider" rows="10">{{$slider->bodyslider}}</textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">{{clean( trans('niva-backend.button_text') )}}</label>
                                <input type="text" name="button_text" class="form-control rounded-3" value="{{$slider->button_text}}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">{{clean( trans('niva-backend.button_link') )}}</label>
                                <input type="text" name="button_link" class="form-control rounded-3" value="{{$slider->button_link}}">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">{{clean( trans('niva-backend.button_text') )}} 2</label>
                                <input type="text" name="button_text2" class="form-control rounded-3" value="{{$slider->button_text2}}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">{{clean( trans('niva-backend.button_link') )}} 2</label>
                                <input type="text" name="button_link2" class="form-control rounded-3" value="{{$slider->button_link2}}">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card bg-light border-0 rounded-4 p-3 text-center">
                            <label class="form-label fw-bold mb-3 d-block">{{clean( trans('niva-backend.photo') )}}</label>
                            <img loading="lazy" class="img-fluid rounded-4 shadow-sm mb-3 mx-auto d-block" style="max-height: 200px; object-fit: cover;" src="{{$slider->photo ? asset('images/media/' . $slider->photo->file) : asset('img/200x200.png')}}">
                            <input type="file" name="photo_id" class="form-control form-control-sm" id="photo_id">
                            <small class="text-muted mt-2 d-block">Resolução recomendada: 1920x1080px</small>
                        </div>

                        <div class="mt-4 d-grid">
                            <button type="submit" class="btn btn-primary btn-lg rounded-pill shadow">
                                <i class="fas fa-save me-2"></i> {{clean( trans('niva-backend.update') )}}
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
