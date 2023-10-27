@extends('site.layouts.guest')

@section('content')

    <div class="row mb-5 mt-5">

        <div class="col-md-6 offset-md-3">

            @include('_partials.message')

            <h2 class="mt-5">Preecha a nova senha</h2>

            <form method="POST" action="{{ route('password.store') }}" class="mt-3">
                @csrf
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <div class="col-sm-12">
                    <label for="email" class="form-label">Email</label>
                    <input name="email" type="email" class="form-control" id="email" placeholder="nome@exemplo.com.br" value="{{ old('email', $request->email) }}" required autofocus autocomplete="username">
                </div>

                <div class="col-sm-12 mt-3">
                    <label for="password" class="form-label">Senha</label>
                    <input type="password" autocomplete="new-password" class="form-control" id="password" name="password" required>
                </div>

                <div class="col-sm-12 mt-3">
                    <label for="password_confirmation" class="form-label">Repita Senha</label>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                </div>

                <button class="btn btn-primary w-100 py-2 mt-3" type="submit">Resetar senha</button>

            </form>

            {{--@include('site._partials.back', ['rota'=> route('login')])--}}

        </div>


    </div>

@endsection
