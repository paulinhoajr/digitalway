@extends('site.layouts.site')

@section('content')

    <div class="row mb-5">

        <div class="col-md-12">

            <h2 class="mt-5">Minhas Escolas</h2>

            <div class="row">

                @foreach($escolas as $escola)
                    <div class="col-md-12">
                        <h4 class="mt-5 mb-2">#{{ $escola->id }} {{ $escola->nome }}</h4>

                        <span>{{ $escola->cidade->nome }} - {{ $escola->cidade->uf }}</span>
                        <span>{{ $escola->tipo == 1 ? "Pública" : "Particular" }}</span>

                        @if(count($escola->videos) > 0)
                            <div class="row">
                                <h5 class="mt-3">Vídeos</h5>

                                @foreach($escola->videos as $video)
                                    <div class="col-md-3 mt-3">
                                        <iframe width="100%"
                                                src="{{ $video->url }}">
                                        </iframe>
                                        {{ $video->descricao }}
                                    </div>
                                @endforeach
                            </div>
                        @endif

                        @if(count($escola->documentos) > 0)
                        <div class="row">
                            <h5 class="mt-3">Documentos</h5>

                            @foreach($escola->documentos as $documento)
                                <div class="col-md-3 mt-3">
                                    <a class="btn btn-outline-success btn-lg w-100" href="{{ $documento->pdf }}">{{ $documento->nome }}</a>
                                    <br>
                                    {{ $documento->descricao }}
                                </div>
                            @endforeach
                        </div>
                        @endif
                        <hr class="my-4">
                    </div>

                @endforeach

            </div>

        </div>

    </div>

@endsection
