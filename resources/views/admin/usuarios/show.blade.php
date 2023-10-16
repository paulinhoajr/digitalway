@extends('admin.layouts.admin')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Dados de {{ $usuario->nome }}</h1>
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
        <h5>Incluír escola para {{ $usuario->nome }}</h5>
        <div class="">

            @include('_partials.message')

            <form action="{{ route('admin.usuarios.escola') }}" method="post">
                @csrf
                <input type="hidden" name="usuario_id" value="{{ $usuario->id }}">
                <div class="row g-3">
                    <div class="col-sm-12">
                        <label class="form-label" for="escola">Buscar escola - Selecione na lista</label>
                        <input type="text" class="form-control"  id="escola" name="escola"  value="{{old('escola')}}"  placeholder="Escola">
                        <input type="hidden" name="escola_id" id="escola_id" value="{{old('escola_id')}}">
                    </div>
                    <button class="float-end btn btn-primary" type="submit">Incluír</button>
                </div>

            </form>
        </div>
        <hr class="my-4">
        <h5>Escolas</h5>
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Escola</th>
                    <th scope="col">Cidade</th>
                    <th scope="col">Criado</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
            @foreach($usuario->escolas as $usuarioEscola)
                <tr>
                    <td>{{ $usuarioEscola->id }}</td>
                    <td>{{ $usuarioEscola->nome }}</td>
                    <td>{{ $usuarioEscola->cidade->nome }}</td>
                    <td>{{ dateTimeUsParaDateTimeBr($usuario->created_at) }}</td>
                    <td>
                        <a href="{{ route('admin.usuarios.escola.delete', ['escola_id'=>$usuarioEscola->id, 'usuario_id'=>$usuario->id]) }}" type="button" class="btn btn-outline-danger btn-sm"><svg class="bi"><use xlink:href="#icon_excluir"/></svg> REMOVER</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <h5>Certificados</h5>
        <table class="table table-striped table-sm">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Treinamento</th>
                <th scope="col">Criado</th>
            </tr>
            </thead>
            <tbody>
            @foreach($certificados as $certificado)
                <tr>
                    <td>{{ $certificado->id }}</td>
                    <td>{{ $certificado->treinamento->nome }}</td>
                    <td>{{ dateTimeUsParaDateTimeBr($certificado->created_at) }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection

@section('scripts')

    <script>
        $(function() {
            $( "#escola" ).autocomplete({
                minLength: 2,
                source: function( request, response ) {
                    $.ajax({
                        url: '{{ route('escolas.autocomplete') }}',
                        dataType: "json",
                        data: {
                            busca: $('#escola').val()
                        },
                        success: function(data) {
                            response(data);
                        }
                    });
                },
                select: function (event, ui) {
                    //console.log("select: "+ui.item.value);
                    $('#escola').val(ui.item.value);
                    $('#escola_id').val(ui.item.id);
                    return false;
                },
                focus: function(event, ui){
                    //console.log("focus: "+ui.item.value);
                    $("#escola" ).val(ui.item.value);
                    $('#escola_id').val(ui.item.id);
                    return false;
                },
            });
        });

        /*$("#cpf").mask("999.999.999-99");*/

    </script>

@endsection
