@extends('admin.layouts.admin')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Lista de Cidades</h1>
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

        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nome</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
            @foreach($escolas as $escola)
                <tr>
                    <td>{{ $escola->cidade->id }}</td>
                    <td>{{ $escola->cidade->nome }}</td>
                    <td>
                        <div class="btn-group float-end" role="group" aria-label="">
                            <a href="{{ route('admin.escolas.index', ['id'=>$escola->cidade->id]) }}" type="button" class="ri btn btn-outline-success btn-sm"><svg class="bi"><use xlink:href="#icon_escola"/></svg> ESCOLAS</a>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
       {{-- {{ $escolas->onEachSide(1)->links('_partials.pagination') }}--}}
    </div>
@endsection



