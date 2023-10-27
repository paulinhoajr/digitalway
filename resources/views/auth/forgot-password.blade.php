@extends('site.layouts.guest')

@section('content')

    <div class="row mb-5 mt-5">

        <div class="col-md-6 offset-md-3">

            @include('_partials.message')

            <h2 class="mt-5">Resetar senha</h2>

            <form method="POST" action="{{ route('password.email') }}" class="mt-3">
                @csrf
                <div class="form-floating">
                    <input name="email" type="email" class="form-control" id="email" placeholder="nome@exemplo.com.br">
                    <label for="email">Email</label>
                </div>

                <button class="btn btn-primary w-100 py-2 mt-3" type="submit">Receber link por email</button>

            </form>

        </div>

    </div>

@endsection
