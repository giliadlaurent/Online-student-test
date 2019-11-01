@extends("layouts.error")

@section('content')
        <div class="container">
            <div class="content">
                <div class="btn btn-info btn-block">404 - Not Found</div>
                <img src="{{ asset('images/404.png') }}" class="img-thumbnail" style="width: 300px" alt="">
                <br>
                 <div> <a href="/admin" class="btn btn-danger btn-block"> Back home</a></div>
            </div>

        </div>
@endsection
