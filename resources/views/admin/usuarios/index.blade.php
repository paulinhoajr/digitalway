@extends('admin.layouts.admin')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Lista de Usuários</h1>
        {{--<div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
                <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
            </div>
            <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle d-flex align-items-center gap-1">
                <svg class="bi"><use xlink:href="#icon_calendar3"/></svg>
                This week
            </button>
        </div>--}}
    </div>

    <div class="table-responsive small">

        @include('_partials.message')

        <a href="{{ route('admin.usuarios.create') }}" type="button" class="float-end ri btn btn-outline-secondary btn-sm">
            <svg class="bi"><use xlink:href="#icon_usuario"/></svg> NOVO USUÁRIO</a>

        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Email</th>
                    <th scope="col">CPF</th>
                    <th scope="col">Regra</th>
                    <th scope="col">Situação</th>
                    <th scope="col">Criado</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
            @foreach($usuarios as $usuario)
                <tr>
                    <td>{{ $usuario->id }}</td>
                    <td>{{ $usuario->nome }}</td>
                    <td>{{ $usuario->email }}</td>
                    <td>{{ mascara($usuario->cpf, "cpf") }}</td>
                    <td>{{ $usuario->role }}</td>
                    <td>
                        @if($usuario->situacao == 1)
                            <button class="btn btn-outline-success btn-sm disabled"><svg class="bi"><use xlink:href="#icon_checado"/></svg></button>
                        @else
                            <button class="btn btn-outline-danger btn-sm disabled"><svg class="bi"><use xlink:href="#icon_excluir"/></svg></button>
                        @endif
                    </td>
                    <td>{{ dateTimeUsParaDateTimeBr($usuario->created_at) }}</td>
                    <td>
                        <div class="btn-group float-end" role="group" aria-label="">
                            <a href="{{ route('admin.usuarios.login', ['id'=>$usuario->id]) }}" type="button" class="ri btn btn-outline-warning btn-sm"><svg class="bi"><use xlink:href="#icon_usuario"/></svg> LOGAR</a>
                            <a href="{{ route('admin.usuarios.show', ['id'=>$usuario->id]) }}" type="button" class="ri btn btn-outline-success btn-sm"><svg class="bi"><use xlink:href="#icon_mostrar"/></svg> MOSTRAR</a>
                            <a href="{{ route('admin.usuarios.edit', ['id'=>$usuario->id]) }}" type="button" class="ri btn btn-outline-primary btn-sm"><svg class="bi"><use xlink:href="#icon_editar"/></svg> EDITAR</a>
                            <a href="{{ route('admin.usuarios.delete', ['id'=>$usuario->id]) }}" type="button" class="btn btn-outline-danger btn-sm"><svg class="bi"><use xlink:href="#icon_excluir"/></svg> EXCLUIR</a>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $usuarios->onEachSide(1)->links('_partials.pagination') }}
    </div>
@endsection
