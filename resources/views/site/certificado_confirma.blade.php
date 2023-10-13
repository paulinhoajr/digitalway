@extends('site.layouts.site')

@section('content')

    <div class="row mb-5">

        <div class="col-md-12">

            <h2 class="mt-5">Confirmação de autenticidade de assinatura em certificado.</h2>

            <table class="table table-striped table-sm">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Treinamento</th>
                    <th scope="col">Data</th>
                </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $certificado->id }}</td>
                        <td>{{ $certificado->treinamento->nome }}</td>
                        <td>{{ dateTimeUsParaDateTimeBr($certificado->created_at) }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

@endsection
