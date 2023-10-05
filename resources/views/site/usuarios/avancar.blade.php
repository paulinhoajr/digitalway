@extends('site.layouts.site')

@section('content')

    <div class="row mb-5">

        <div class="col-md-6 offset-md-3">

            @include('_partials.message')

            <h2 class="mt-5">Insitra o CPF</h2>

            <form method="POST" action="{{ route('site.usuarios.avancar.post') }}" class="mt-3">
                @csrf
                <div class="form-floating">
                    <input name="cpf" type="text" class="form-control" id="cpf" placeholder="000.000.000-00">
                    <label for="cpf">CPF</label>
                </div>

                <button class="btn btn-primary w-100 py-2 mt-3" type="submit">Avançar</button>
            </form>

        </div>

    </div>

@endsection
