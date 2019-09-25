@if (count($errors) > 0)
    <div class="alert alert-danger">
        <div class="alert-text">
            <strong>Error!</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endif

@if (session('success'))
    <div class="row">
        <div class="col-lg-12">
            <div class="alert alert-success">
                {!! session('success') !!}
            </div>
        </div>
    </div>
@endif

@if (session('error'))
    <div class="row">
        <div class="col-lg-12">
            <div class="alert alert-danger">
                {!! session('error') !!}
            </div>
        </div>
    </div>
@endif