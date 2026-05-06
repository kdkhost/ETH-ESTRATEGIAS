

@extends('layouts.admin')

@section('content')

@include('includes.tinyeditor')

<!-- Begin Page Content -->
<div class="container-fluid">


    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{clean( trans('niva-backend.edit_pricing') )}}</h1>
        <a href="{{route('pricing.index') . '?language=' . request()->input('language')}}" class="btn btn-light shadow-sm btn-sm ms-auto">
            <i class="fas fa-arrow-left fa-sm me-1"></i> {{clean( trans('niva-backend.back_pricingpage') )}}
        </a>
    </div>

    <div class="card gourmet-card-light shadow-sm border-0 mb-4">
        <div class="card-header py-3 bg-white border-0 d-flex align-items-center">
            <h6 class="m-0 font-weight-bold text-primary uppercase"><i class="fas fa-tags me-2"></i> Editar Plano Gourmet</h6>
        </div>
        <div class="card-body p-4">
            @include('includes.form-errors')

            <form action="{{route('pricing.update', $pricing->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row g-4">
                    <div class="col-md-6">
                        <label class="form-label fw-bold small text-muted uppercase">Nome do Plano</label>
                        <div class="input-group input-group-lg bg-light rounded-4 overflow-hidden border-0">
                            <span class="input-group-text bg-transparent border-0 ps-4"><i class="fas fa-shopping-cart text-primary opacity-50"></i></span>
                            <input type="text" name="title" class="form-control bg-transparent border-0 shadow-none ps-2" value="{{$pricing->title}}" placeholder="Ex: Plano Enterprise">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold small text-muted uppercase">Selo de Destaque (Badge)</label>
                        <div class="input-group input-group-lg bg-light rounded-4 overflow-hidden border-0">
                            <span class="input-group-text bg-transparent border-0 ps-4"><i class="fas fa-award text-warning opacity-50"></i></span>
                            <input type="text" name="popular_text" class="form-control bg-transparent border-0 shadow-none ps-2" value="{{$pricing->popular_text}}" placeholder="Ex: Mais Popular">
                        </div>
                    </div>

                    <div class="col-md-12 mt-4">
                        <label class="form-label fw-bold small text-muted uppercase mb-3">Benefícios e Descrição (Editor Rico)</label>
                        <div class="rounded-4 overflow-hidden border shadow-sm">
                            <textarea name="description" class="form-control summernote" id="description" rows="10">{{$pricing->description}}</textarea>
                        </div>
                    </div>

                    <div class="col-md-6 mt-4">
                        <label class="form-label fw-bold small text-muted uppercase">Texto do Botão de Compra</label>
                        <input type="text" name="button_text" class="form-control form-control-lg border-0 bg-light rounded-4 px-4 shadow-none" value="{{$pricing->button_text}}" placeholder="Ex: Assinar Agora">
                    </div>
                    <div class="col-md-6 mt-4">
                        <label class="form-label fw-bold small text-muted uppercase">Link de Checkout / Contato</label>
                        <input type="text" name="button_link" class="form-control form-control-lg border-0 bg-light rounded-4 px-4 shadow-none" value="{{$pricing->button_link}}" placeholder="Ex: https://checkout.com/plano-1">
                    </div>

                    <div class="col-md-12 mt-5">
                        <div class="card bg-light border-0 rounded-4 p-4 shadow-none">
                            <div class="row align-items-center">
                                <div class="col-md-8">
                                    <h6 class="fw-bold text-dark uppercase mb-1">Destacar este Plano?</h6>
                                    <p class="text-muted small mb-0">Planos destacados ganham bordas coloridas e maior visibilidade no site.</p>
                                </div>
                                <div class="col-md-4 text-md-end mt-3 mt-md-0">
                                    <div class="d-flex gap-3 justify-content-md-end">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="pricing_switch" id="pricing_switch1" value="1" @if($pricing->pricing_switch == 1) checked @endif>
                                            <label class="form-check-label fw-bold" for="pricing_switch1">SIM</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="pricing_switch" id="pricing_switch0" value="0" @if($pricing->pricing_switch == 0) checked @endif>
                                            <label class="form-check-label fw-bold" for="pricing_switch0">NÃO</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 text-center mt-5 mb-3">
                        <button type="submit" class="btn btn-primary btn-lg px-5 py-3 shadow-lg rounded-pill fw-bold">
                            <i class="fas fa-save me-2"></i> ATUALIZAR PLANO DE PREÇO
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>


</div>
<!-- /.container-fluid -->
@endsection