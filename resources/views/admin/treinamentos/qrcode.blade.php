@extends('site.layouts.guest')

@section('content')

    <div class="container text-center">
        <h1 class="h2 mb-5">{{ $nome }}</h1>
        <br>
        <img class="mt-1 mb-1" src="data:image/png;base64, {!! base64_encode(QrCode::size(260)->generate($link)) !!} ">
        <br>
        <h3 class="mt-5">{{ $link }}</h3>

    </div>
@endsection

@section('scripts')

    <script>

        /*$("#cpf").mask("999.999.999-99");*/

    </script>

@endsection
