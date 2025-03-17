@extends('site.layouts.site')

@section('content')
<div class="container">
    <div class="row mb-5">

        <div class="col-md-12">

            <h2 class="mt-5">Minhas Escolas</h2>

            <div class="row">

                @foreach($escolas as $escola)
                    <div class="col-md-12">
                        <h4 class="escolas_titulos">#{{ $escola->id }} - {{ $escola->nome }}</h4>

                        <p><b>Local:</b> <span>{{ $escola->cidade->nome }} - {{ $escola->cidade->uf }}</span></p>
                        <p><b>Tipo:</b> <span>{{ $escola->tipo == 0 ? "Pública" : "Particular" }}</span></p>


                        @if(count($escola->videos) > 0 or count($todos_videos) > 0)
                            <div class="row">
                                <h5 class="escolas_subtitulos">Vídeos</h5>

                                @foreach($escola->videos as $video)
                                    <div class="col-md-4 mt-3">
                                        <iframe width="100%" height="400px"
                                                src="{{ $video->url }}" allowfullscreen="allowfullscreen">
                                        </iframe>
                                        <span class="video_desc">{{ $video->descricao }}</span>
                                    </div>
                                @endforeach
                                @foreach($todos_videos as $video)
                                    <div class="col-md-4 mt-3">
                                        <iframe width="100%" height="400px"
                                                src="{{ $video->url }}" allowfullscreen="allowfullscreen">
                                        </iframe>
                                        <span class="video_desc">{{ $video->descricao }}</span>
                                    </div>
                                @endforeach


                            </div>
                        @endif

                        @if(count($escola->documentos) > 0 OR count($documentos) > 0)
                            <div class="row">
                                <h5 class="escolas_subtitulos">Material de Apoio</h5>

                                <table class="table table-striped table-sm">
                                    <thead>
                                    <tr>
                                        <th scope="col">Nome</th>
                                        <th scope="col">Descrição</th>
                                        <th scope="col">Download</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    @foreach($escola->documentos as $documento)
                                        <tr>
                                            <td>{{ $documento->nome }}</td>
                                            <td>{{ $documento->descricao }}</td>
                                            <td>

                                                <a href="{{ asset('storage/documentos/'.$documento->pdf) }}" type="button" class="ri btn btn-outline-success btn-sm" target="_blank">
                                                    <svg class="bi"><use xlink:href="#icon_pdf"/></svg> BAIXAR</a>

                                            </td>
                                        </tr>
                                    @endforeach

                                    @foreach($documentos as $documento)
                                        <tr>
                                            <td>{{ $documento->nome }}</td>
                                            <td>{{ $documento->descricao }}</td>
                                            <td>

                                                <a href="{{ asset('storage/documentos/'.$documento->pdf) }}" type="button" class="ri btn btn-outline-success btn-sm" target="_blank">
                                                    <svg class="bi"><use xlink:href="#icon_pdf"/></svg> BAIXAR</a>

                                            </td>
                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>

                @endforeach

            </div>

        </div>

    </div>
</div>
@endsection
