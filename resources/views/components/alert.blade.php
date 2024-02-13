@if ($message = Session::get('error'))
    <div class="alert alert-danger alert-dissmisble fade show" role="alert">
        <strong> {{ $message }} </strong>
            <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close">
                
            </button>
    </div>
@endif