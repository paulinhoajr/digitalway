@extends('admin.layouts.admin')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Novo Vídeo</h1>
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

        <form action="{{ route('admin.videos.store') }}" method="post">
            @csrf
            <div class="row g-3">
                <div class="col-sm-9">
                    <label for="nome" class="form-label">Nome</label>
                    <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome do vídeo" value="{{old('nome')}}" required>
                </div>
                <div class="col-sm-3">
                    <label for="situacao" class="form-label">Situação</label>
                    <select class="form-select" id="situacao" name="situacao">
                        <option {{ old('situacao' ? (old('situacao') == 1 ? "selected" : "") : "") }} value="1">Ativo</option>
                        <option {{ old('situacao' ? (old('situacao') == 0 ? "selected" : "") : "") }} value="0">Inativo</option>
                    </select>
                </div>
                <div class="col-sm-4">
                    <label class="form-label" for="cidade">Buscar cidade - Selecione na lista</label>
                    <input type="text" class="form-control"  id="cidade" name="cidade"  value="{{old('cidade')}}"  placeholder="Cidade - UF" required>
                    <input type="hidden" name="cidade_id" id="cidade_id" value="{{old('cidade_id')}}">
                </div>
                <div class="col-sm-4">
                    <label class="form-label" for="escola">Buscar escola - Selecione na lista</label>
                    <input type="text" class="form-control"  id="escola" name="escola"  value="{{old('escola')}}"  placeholder="Escola">
                    <input type="hidden" name="escola_id" id="escola_id" value="{{old('escola_id')}}">
                </div>
                <div class="col-sm-4">
                    <label for="url" class="form-label">Url (https://www.youtube.com/embed/VIDEO_ID_AQUI)</label>
                    <input type="text" class="form-control" id="url" name="url" placeholder="https://www.youtube.com/embed/VIDEO_ID_AQUI" value="{{old('url')}}" required>
                </div>

                <div class="col-sm-12">
                    <label class="form-label" for="descricao">Descrição</label>
                    <textarea name="descricao" class="form-control">{{ old('descricao') }}</textarea>
                </div>


            </div>

            <hr class="my-4">

            <button class="float-end btn btn-primary" type="submit">Inserir Video</button>
        </form>
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
