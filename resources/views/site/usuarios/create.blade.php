@extends('site.layouts.site')

@section('content')

    <div class="row">

        <div class="col-md-6 offset-md-3">

            <h2 class="mt-5">Novo</h2>

            @include('_partials.message')

            <form method="POST" action="" class="mt-3">
                @csrf
                <div class="form-floating">
                    <input name="email" type="email" class="form-control" id="email" placeholder="nome@exemplo.com.br">
                    <label for="email">Email</label>
                </div>
                <div class="form-floating mt-3">
                    <input name="password" type="password" class="form-control" id="senha" placeholder="Senha">
                    <label for="senha">Senha</label>
                </div>

                <button class="btn btn-primary w-100 py-2" type="submit">Cadastrar</button>
            </form>

        </div>

    </div>

@endsection
