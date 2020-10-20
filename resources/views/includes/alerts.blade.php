@if ($errors->any())
    <div class="alert alert-danger mt-2 mb-2">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger mt-2 mb-2 text-center">
        {{session('error')}}
    </div>
@endif

@if (session('success'))
    <div class="alert alert-success mt-2 mb-2 text-center">
        {{session('success')}}
    </div>
@endif