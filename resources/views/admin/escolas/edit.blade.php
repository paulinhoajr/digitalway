@extends('admin.layouts.admin')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Alterar {{ $escola->nome }}</h1>
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

        <form action="{{ route('admin.escolas.update') }}" method="post">
            @csrf
            <input type="hidden" name="id" value="{{ $escola->id }}">
            <div class="row g-3">
                <div class="col-sm-6">
                    <label for="nome" class="form-label">Nome</label>
                    <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome da escola" value="{{ $escola->nome }}" required>
                </div>
                <div class="col-sm-6">
                    <label class="form-label" for="cidade">Buscar cidade - Selecione na lista</label>
                    <input required type="text" class="form-control"  id="cidade" name="cidade"  value="{{ $escola->cidade->nome }} - {{ $escola->cidade->uf }}"  placeholder="Cidade - UF">
                    <input type="hidden" name="cidade_id" id="cidade_id" value="{{ $escola->cidade->id }}">
                </div>
                <div class="col-sm-6">
                    <label for="tipo" class="form-label">Tipo</label>
                    <select class="form-select" id="tipo" name="tipo">
                        <option {{ $escola->tipo == 0 ? "selected" : "" }} value="0">Pública</option>
                        <option {{ $escola->tipo == 1 ? "selected" : "" }} value="1">Particular</option>
                    </select>
                </div>

            </div>

            <hr class="my-4">

            <button class="float-end btn btn-primary" type="submit">Alterar Escola</button>
        </form>
    </div>
@endsection

@section('scripts')

    <script>
        $(function() {
            $( "#cidade" ).autocomplete({
                minLength: 2,
                source: function( request, response ) {
                    $.ajax({
                        url: '{{route('cidades.autocomplete')}}',
                        dataType: "json",
                        data: {
                            busca: $('#cidade').val()
                        },
                        success: function(data) {
                            response(data);
                        }
                    });
                },
                select: function (event, ui) {
                    //console.log("select: "+ui.item.value);
                    $('#cidade').val(ui.item.value);
                    $('#cidade_id').val(ui.item.id);
                    return false;
                },
                focus: function(event, ui){
                    //console.log("focus: "+ui.item.value);
                    $("#cidade" ).val(ui.item.value);
                    $('#cidade_id').val(ui.item.id);
                    return false;
                },
            });
        });

        /*$("#cpf").mask("999.999.999-99");*/

    </script>

@endsection
