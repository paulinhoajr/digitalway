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
                <svg class="bi"><use xlink:href="#calendar3"/></svg>
                This week
            </button>
        </div>--}}
    </div>

    <div class="table-responsive small">
        <table class="table table-striped table-sm">
            <thead>
                <tr>
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
                    <td>{{ $escola->id }}</td>
                    <td>{{ $escola->nome }}</td>
                    <td>{{ $escola->cidade->nome }}</td>
                    <td>{{ $escola->tipo == 1 ? "Pública" : "Particular" }}</td>
                    <td>{{ dateTimeUsParaDateTimeBr($escola->created_at) }}</td>
                    <td>
                        <div class="btn-group float-end" role="group" aria-label="">
                            <a href="" type="button" class="ri btn btn-outline-primary btn-sm"><svg class="bi"><use xlink:href="#editar"/></svg> EDITAR</a>
                            <a href="" type="button" class="btn btn-outline-danger btn-sm"><svg class="bi"><use xlink:href="#excluir"/></svg> EXCLUIR</a>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $escolas->onEachSide(1)->links('admin._partials.pagination') }}
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
                    $('#cep').val(ui.item.cep).mask('99999-999');
                    $('#cidade_id').val(ui.item.id);
                    $('#estado_id').val(ui.item.estado_id);
                    return false;
                },
                focus: function(event, ui){
                    //console.log("focus: "+ui.item.value);
                    $("#cidade" ).val(ui.item.value);
                    $("#cep" ).val(ui.item.cep).mask('99999-999');
                    $('#cidade_id').val(ui.item.id);
                    $('#estado_id').val(ui.item.estado_id);
                    return false;
                },
            });
        });

        $("#cpf").mask("999.999.999-99");
        $("#nascimento").mask("99/99/9999");
        $("#assoc_data").mask("99/99/9999");
        $("#assoc_vencimento").mask("99/99/9999");
        $("#cr_vencimento").mask("99/99/9999");
        $('#telefone').mask('(99) 9999-9999');
        $('#whatsapp').mask('(99) 9 9999-9999');
        $('#cep').mask('99999-999');

        /*setTimeout(
            function() {
                $('#password').val('');
            },
            500
        );*/
    </script>

@endsection
