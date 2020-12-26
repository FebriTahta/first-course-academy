@extends('layouts.client_layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center mt-150">
        <div class="col-md-8">
            <div class="block block-shadow block-rounded">
                <div class="block-header block-header-default">{{ __('Verify Your Email Address') }}</div>

                <div class="block-content">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{-- {{ __('A fresh verification link has been sent to your email address.') }} --}}
                            {{ __('Email verifikasi telah dikirim ke email anda. Segera lakukan verifikasi!.') }}
                        </div>
                    @endif

                    {{-- {{ __('Before proceeding, please check your email for a verification link.') }} --}}
                    {{ __('Oooops. Satu langkah lagi untuk bergabung dan berpartisipasi bersama kami.') }}
                    {{ __('Kami akan memastikan bahwa email yang anda gunakan "BENAR"') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('klik disini untuk verifikasi') }}</button>.
                    </form>
                </div>
                <div class="block-content">                    
                    <a href="{{ 'logout' }}">{{ __('Logout ?') }}</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
