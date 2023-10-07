@extends('site.layouts.guest')

@section('content')

    <div class="row mb-5 mt-5">

        <div class="col-md-6 offset-md-3">

            @include('_partials.message')

            <h2 class="mt-5">Insira o CPF</h2>

            <form method="POST" action="{{ route('site.usuarios.qrcode.post') }}" class="mt-3">
                @csrf
                <input type="hidden" name="treinamento_id" value="{{ $treinamento->id }}">
                <div class="form-floating">
                    <input name="cpf" type="text" class="form-control" id="cpf" placeholder="000.000.000-00">
                    <label for="cpf">CPF</label>
                </div>

                <button class="btn btn-primary w-100 py-2 mt-3" type="submit">Registrar</button>
            </form>

            @include('_partials.back', ['rota' => route('login')])
        </div>

    </div>

@endsection

@section('scripts')

    <script>
        $(function() {

            $("#cpf").mask("999.999.999-99");

        });
    </script>

@endsection
