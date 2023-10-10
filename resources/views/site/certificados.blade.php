@extends('site.layouts.site')

@section('content')

    <div class="row mb-5">

        <div class="col-md-12">

            <h2 class="mt-5">Meus Certificados</h2>

            <table class="table table-striped table-sm">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Treinamento</th>
                    <th scope="col">Criado</th>
                    <th scope="col">Gerar</th>
                </tr>
                </thead>
                <tbody>
                @foreach($certificados as $certificado)
                    <tr>
                        <td>{{ $certificado->id }}</td>
                        <td>{{ $certificado->treinamento->nome }}</td>
                        <td>{{ dateTimeUsParaDateTimeBr($certificado->created_at) }}</td>
                        <td>
                            <a href="{{ route('site.usuarios.certificados.gerar', ['id'=>$certificado->id]) }}" type="button" class="ri btn btn-outline-success btn-sm" target="_blank">
                                <svg class="bi"><use xlink:href="#icon_pdf"/></svg> ABRIR</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>

    </div>

@endsection
