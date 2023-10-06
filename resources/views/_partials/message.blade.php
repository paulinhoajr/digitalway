@if (Session::has('message'))
    <div class="alert alert-success alert-dismissible fade show mt-2 mb-5 " role="alert">
        {!! Session::get('message') !!}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if (Session::has('message_alert'))
    <div class="alert alert-warning alert-dismissible fade show mt-2 mb-5 " role="alert">
        {!! Session::get('message_alert') !!}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if (Session::has('message_fail'))
    <div class="alert alert-danger alert-dismissible fade show mt-2 mb-5 " role="alert">
        {!! Session::get('message_fail') !!}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if ($errors->any())
    @foreach ($errors->all() as $error)
        <div class="alert alert-warning alert-dismissible fade show mt-2 mb-2 " role="alert">
            {!! $error !!}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endforeach
@endif
