@extends('admin.layouts.admin')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Lista de Espera</h1>
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

    <div class="table-responsive small">

        @include('_partials.message')

        <a href="{{ route('admin.esperas.importar') }}" type="button" class="float-end ri btn btn-outline-success btn-sm">
            <svg class="bi"><use xlink:href="#icon_csv"/></svg> IMPORTAR CSV</a>

        <form action="{{ route('admin.esperas.limpar') }}" id="form" name="form" method="POST" {{--onsubmit="return false;"--}}>
            @csrf
            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th><input type="checkbox" id="parent" class="form-check-input"></th>
                        <th scope="col">#</th>
                        <th scope="col">Nome</th>
                        <th scope="col">CPF</th>
                        <th scope="col">Escola</th>
                        <th scope="col">Criado</th>
                        {{--<th scope="col"></th>--}}
                    </tr>
                </thead>

                <tbody>
                @foreach($esperas as $espera)
                    <tr>
                        <td>
                            <input name="esperas[]" type="checkbox" class="child form-check-input" value="{{$espera->id}}">
                        </td>
                        <td>{{ $espera->id }}</td>
                        <td>{{ $espera->nome }}</td>
                        <td>{{ mascara($espera->cpf, "cpf") }}</td>
                        <td>{{ $espera->escola->nome }}</td>
                        <td>{{ dateTimeUsParaDateTimeBr($espera->created_at) }}</td>
                        {{--<td class="">
                            <div class="btn-group float-end" role="group" aria-label="">
                                <a href="" type="button" class="ri btn btn-outline-primary btn-sm"><svg class="bi"><use xlink:href="#editar"/></svg> EDITAR</a>
                                <a href="" type="button" class="btn btn-outline-danger btn-sm"><svg class="bi"><use xlink:href="#excluir"/></svg> EXCLUIR</a>
                            </div>
                        </td>--}}
                    </tr>
                @endforeach
                    <tr class="mt-3">
                        <td colspan="6">
                            <button id="submit" class="btn btn-outline-danger  submit">Remover</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>
        {{ $esperas->onEachSide(1)->links('_partials.pagination') }}
    </div>
@endsection



@section('scripts')

    <script>
        $(function () {

            $("#parent").click(function() {
                $(".child").prop("checked", this.checked);

                /*if ($('.child:checked').length == $('.child').length) {
                    //$('#formas').removeClass("d-none");
                    $('#submit').prop('disabled', false);
                    $('#modo').prop('disabled', false);
                } else {
                    //$('#formas').addClass("d-none");
                    $('#submit').prop('disabled', true);
                    $('#modo').prop('disabled', true);
                }*/
            });

        });
    </script>
@endsection

