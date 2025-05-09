@extends('admin.layouts.admin')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Novo Usuário</h1>
        {{--<div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
                <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
            </div>
            <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle d-flex align-items-center gap-1">
                <svg class="bi"><use xlink:href="#calendar3"/></svg>
                This week
            </button>
        </div>--}}
    </div>
    <div class="">

        @include('_partials.message')

        <form action="{{ route('admin.usuarios.store') }}" method="post">
            @csrf
            <div class="row g-3">
                <div class="col-sm-4">
                    <label for="nome" class="form-label">Nome</label>
                    <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome" required>
                </div>
                <div class="col-sm-4">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="mail@mail.com" required>
                </div>
                <div class="col-sm-4">
                    <label for="cpf" class="form-label">CPF</label>
                    <input type="cpf" class="form-control" id="cpf" name="cpf" placeholder="000.000.000-00" required>
                </div>

                <div class="col-sm-3">
                    <label for="password" class="form-label">Senha</label>
                    <input type="password" autocomplete="new-password" class="form-control" id="password" name="password" required>
                </div>
                <div class="col-sm-3">
                    <label for="password_confirmation" class="form-label">Repita Senha</label>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                </div>
                <div class="col-sm-2">
                    <label for="role" class="form-label">Regra</label>
                    <select class="form-select" id="role" name="role">
                        <option value="ROLE_USUARIO">USUARIO</option>
                        <option value="ROLE_ADMIN">ADMIN</option>
                    </select>
                </div>
                <div class="col-sm-2">
                    <label for="instrutor" class="form-label">Instrutor</label>
                    <select class="form-select" id="instrutor" name="instrutor">
                        <option {{ old('instrutor' ? (old('instrutor') == 0 ? "selected" : "") : "") }} value="0">Não</option>
                        <option {{ old('situacao' ? (old('situacao') == 1 ? "selected" : "") : "") }} value="1">Sim</option>
                    </select>
                </div>
                <div class="col-sm-2">
                    <label for="situacao" class="form-label">Situação</label>
                    <select class="form-select" id="situacao" name="situacao">
                        <option {{ old('situacao' ? (old('situacao') == 1 ? "selected" : "") : "") }} value="1">Ativo</option>
                        <option {{ old('situacao' ? (old('situacao') == 0 ? "selected" : "") : "") }} value="0">Inativo</option>
                    </select>
                </div>

            </div>

            <hr class="my-4">

            <button class="float-end btn btn-primary" type="submit">Inserir Usuário</button>
        </form>
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
