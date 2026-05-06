@if(count($errors) > 0)
    <div class="alert alert-danger border-0 shadow-sm rounded-4 mb-4 d-flex align-items-center">
        <div class="me-3 fs-3">
            <i class="fas fa-exclamation-triangle"></i>
        </div>
        <div>
            <ul class="mb-0 ps-3">
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endif