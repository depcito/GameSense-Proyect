@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('auth/verify.verifica_tu_correo_electronico') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('auth/verify.se_envio_un_link') }}
                        </div>
                    @endif

                    {{ __('auth/verify.antes_de_continuar_por') }}
                    {{ __('auth/verify.si_no_recibiste_el') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('auth/verify.haz_click_aqui_para') }}</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
