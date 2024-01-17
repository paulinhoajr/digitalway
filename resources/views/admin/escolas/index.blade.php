@extends('admin.layouts.admin')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Lista de Escolas</h1>
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

    <div class="table-responsive small mb-4">

        @include('_partials.message')

        <a href="{{ route('admin.escolas.csv') }}" type="button" class="ri btn btn-outline-primary btn-sm">
            <svg class="bi"><use xlink:href="#icon_csv"/></svg> NOVO CSV<br><small>(criar escolas)</small></a>

        <a href="{{ route('admin.escolas.create') }}" type="button" class="float-end ri btn btn-outline-secondary btn-sm">
            <svg class="bi"><use xlink:href="#icon_escola"/></svg> NOVA ESCOLA</a>

        <form class="mt-3" action="{{ route('admin.escolas.cidade.gerar') }}" method="post">
            @csrf

            <input type="hidden" name="id" value="{{ $id }}">

            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        @if($id!=null)
                            <th scope="col">
                                <input type="checkbox" id="parent" class="form-check-input" style="background-color: orange;">
                            </th>
                        @endif
                        <th scope="col">#</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Cidade</th>
                        <th scope="col">Tipo</th>
                        <th scope="col">Criado</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                @foreach($escolas as $escola)
                    <tr>
                        @if($id!=null)
                            <td>
                                <input id="check_{{ $escola->id }}" type="checkbox" class="child form-check-input" style="background-color: orange;" name="escolas[{{$escola->id}}]" value="{{$escola->id}}">
                            </td>
                        @endif
                        <td>{{ $escola->id }}</td>
                        <td>{{ $escola->nome }}</td>
                        <td>{{ $escola->cidade->nome }} - {{ $escola->cidade->uf }}</td>
                        <td>{{ $escola->tipo == 0 ? "Pública" : "Particular" }}</td>
                        <td>{{ dateTimeUsParaDateTimeBr($escola->created_at) }}</td>
                        <td>
                            <div class="btn-group float-end" role="group" aria-label="">
                                <a href="{{ route('admin.escolas.usuarios.csv', ['id'=>$escola->id]) }}" type="button" class="ri btn btn-outline-success btn-sm"><svg class="bi"><use xlink:href="#icon_csv"/></svg> GERAR CSV<br><small>(criar professores)</small></a>
                                <a href="{{ route('admin.escolas.edit', ['id'=>$escola->id]) }}" type="button" class="ri btn btn-outline-primary btn-sm"><svg class="bi"><use xlink:href="#icon_editar"/></svg> EDITAR</a>
                                <a href="{{ route('admin.escolas.delete', ['id'=>$escola->id]) }}" type="button" class="btn btn-outline-danger btn-sm"><svg class="bi"><use xlink:href="#icon_excluir"/></svg> EXCLUIR</a>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <button class="ri btn btn-outline-warning btn-sm"><svg class="bi"><use xlink:href="#icon_csv"/></svg> GERAR CSV <br><small>(criar professores para varias escolas)</small></button>

        </form>

        {{ $escolas->onEachSide(1)->links('_partials.pagination') }}
    </div>
@endsection

@section('scripts')

    <script>
        $(function () {

            $("#parent").click(function() {
                $(".child").prop("checked", this.checked);

            });

        });
    </script>
@endsection
