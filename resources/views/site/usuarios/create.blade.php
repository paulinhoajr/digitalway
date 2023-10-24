@extends('site.layouts.guest')

@section('content')

    <div class="row mb-5 mt-5">

        <div class="col-md-6 offset-md-3">

            <h2 class="mt-5">Cadastrar {{--em {{ $espera->escola->nome }}--}}</h2>

            @include('_partials.message')

            <form method="POST" action="{{ route('site.usuarios.store') }}" class="mt-3">
                @csrf
                <input type="hidden" name="id" value="{{ $espera->id }}">
                <div class="form-floating">
                    <input type="text" class="form-control" id="cpf" value="{{ $espera->cpf }}" disabled>
                    <input type="hidden" name="cpf" value="{{ $espera->cpf }}">
                    <label for="cpf">CPF</label>
                </div>
                <div class="form-floating mt-3">
                    <input name="nome" type="text" class="form-control" id="nome" placeholder="Fulano de tal" value="{{$espera->nome}}" required>
                    <label for="nome">Nome</label>
                </div>
                <div class="form-floating mt-3">
                    <input name="email" type="email" class="form-control" id="email" placeholder="nome@exemplo.com.br" value="{{$espera->email}}" required>
                    <label for="email">Email</label>
                </div>
                <div class="form-floating mt-3">
                    <input name="password" type="password" class="form-control" id="senha" placeholder="Senha" required autocomplete="new-password">
                    <label for="senha">Senha</label>
                </div>
                <div class="form-floating mt-3">
                    <input name="password_confirmation" type="password" class="form-control" id="password_confirmation" placeholder="Repita Senha">
                    <label for="password_confirmation">Repita Senha</label>
                </div>

                <button class="btn btn-primary w-100 py-2 mt-3" type="submit">Cadastrar</button>
            </form>

            @include('_partials.back', ['rota' => route('site.usuarios.avancar')])
        </div>

    </div>

@endsection

@section('scripts')

    <script>

        $("#cpf").mask("999.999.999-99");
        /*$("#nascimento").mask("99/99/9999");
        $("#assoc_data").mask("99/99/9999");
        $("#assoc_vencimento").mask("99/99/9999");
        $("#cr_vencimento").mask("99/99/9999");
        $('#telefone').mask('(99) 9999-9999');
        $('#whatsapp').mask('(99) 9 9999-9999');
        $('#cep').mask('99999-999');*/

    </script>

@endsection
