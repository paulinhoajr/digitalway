@extends('site.layouts.guest')

@section('content')

    <div class="row mb-5 mt-5">

        <div class="col-md-6 offset-md-3">

            @include('_partials.message')

            <h2 class="mt-5">Entrar</h2>

            <form method="POST" action="{{ route('login') }}" class="mt-3">
                @csrf
                <div class="form-floating">
                    <input name="email" type="email" class="form-control" id="email" placeholder="nome@exemplo.com.br">
                    <label for="email">Email</label>
                </div>
                <div class="form-floating mt-3">
                    <input name="password" type="password" class="form-control" id="senha" placeholder="Senha">
                    <label for="senha">Senha</label>
                </div>

                <div class="form-check text-start my-3">
                    <input class="form-check-input" type="checkbox" name="remember" value="remember-me" id="remember">
                    <label class="form-check-label" for="remember">
                        Lembrar-me
                    </label>
                </div>
                <button class="btn btn-primary w-100 py-2" type="submit">Entrar</button>
                <a href="{{ route('site.usuarios.avancar') }}" class="btn btn-danger w-100 py-2 mt-5" >Ainda não tenho cadastro</a>
            </form>

        </div>

    </div>

@endsection
