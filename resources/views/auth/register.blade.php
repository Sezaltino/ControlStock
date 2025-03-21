@extends('layouts.app')

@section('content')
<style>
    /* Variáveis de estilo compartilhadas */
    :root {
        --primary-gradient: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%);
        --card-border-radius: 16px;
        --transition-smooth: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        --box-shadow-soft: 0 10px 25px -5px rgba(0, 0, 0, 0.05), 0 8px 10px -6px rgba(0, 0, 0, 0.02);
        --box-shadow-hover: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    }

    .register-container {
        min-height: calc(100vh - 140px);
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 2rem 1rem;
    }

    .register-card {
        background: #fff;
        border-radius: var(--card-border-radius);
        box-shadow: var(--box-shadow-soft);
        overflow: hidden;
        width: 100%;
        max-width: 700px;
        transition: var(--transition-smooth);
        border: 1px solid rgba(229, 231, 235, 0.5);
        position: relative;
    }

    .register-card:hover {
        box-shadow: var(--box-shadow-hover);
    }

    .register-header {
        background: var(--primary-gradient);
        padding: 2rem;
        text-align: center;
        color: white;
        position: relative;
    }

    .register-title {
        font-size: 1.75rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
    }

    .register-subtitle {
        font-size: 0.95rem;
        opacity: 0.9;
    }

    .register-body {
        padding: 2.5rem 2rem;
    }

    .form-grid {
        display: grid;
        grid-template-columns: repeat(1, 1fr);
        gap: 1.5rem;
    }

    .form-group {
        margin-bottom: 1.5rem;
        position: relative;
    }

    .form-group label {
        display: block;
        margin-bottom: 0.5rem;
        font-weight: 500;
        font-size: 0.9rem;
        color: #4b5563;
    }

    .form-control {
        display: block;
        width: 100%;
        padding: 0.75rem 1rem;
        font-size: 0.95rem;
        line-height: 1.5;
        color: #374151;
        background-color: #fff;
        background-clip: padding-box;
        border: 1px solid #e5e7eb;
        border-radius: 0.5rem;
        transition: var(--transition-smooth);
    }

    .form-control:focus {
        border-color: #6366f1;
        outline: 0;
        box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.2);
    }

    .input-with-icon {
        position: relative;
    }

    .input-icon {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        right: 1rem;
        color: #9ca3af;
    }

    .btn-register {
        display: inline-block;
        padding: 0.75rem 1.5rem;
        border-radius: 0.5rem;
        font-weight: 500;
        font-size: 0.95rem;
        text-align: center;
        border: none;
        transition: var(--transition-smooth);
        cursor: pointer;
        background: var(--primary-gradient);
        color: white;
        width: 100%;
    }

    .btn-register:hover {
        opacity: 0.95;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(79, 70, 229, 0.25);
    }

    .invalid-feedback {
        display: block;
        width: 100%;
        margin-top: 0.25rem;
        font-size: 0.85rem;
        color: #ef4444;
    }

    .register-footer {
        text-align: center;
        padding: 0 2rem 2rem;
        color: #6b7280;
        font-size: 0.9rem;
    }

    .register-footer a {
        color: #6366f1;
        text-decoration: none;
        font-weight: 500;
        transition: var(--transition-smooth);
    }

    .register-footer a:hover {
        color: #4f46e5;
        text-decoration: underline;
    }

    /* Decorative elements */
    .register-decoration {
        position: absolute;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
    }

    .decoration-1 {
        width: 80px;
        height: 80px;
        top: -40px;
        right: -20px;
    }

    .decoration-2 {
        width: 60px;
        height: 60px;
        bottom: -30px;
        left: -30px;
    }

    .logo-container {
        margin-bottom: 1.5rem;
    }

    .register-logo {
        width: 80px;
        height: 80px;
        border-radius: 20px;
        object-fit: cover;
    }

    /* Dark mode styles */
    body.dark-mode .register-card {
        background-color: #1e1e1e;
        border-color: rgba(75, 85, 99, 0.5);
    }

    body.dark-mode .form-group label {
        color: #e5e7eb;
    }

    body.dark-mode .form-control {
        background-color: #2d3238;
        border-color: rgba(75, 85, 99, 0.5);
        color: #e5e7eb;
    }

    body.dark-mode .form-control:focus {
        border-color: #6366f1;
        box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.3);
    }

    body.dark-mode .register-footer {
        color: #9ca3af;
    }

    @media (min-width: 768px) {
        .form-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }
</style>

<div class="register-container">
    <div class="register-card animate-fade-up">
        <div class="register-header">
            <div class="register-decoration decoration-1"></div>
            <div class="register-decoration decoration-2"></div>
            <div class="logo-container">
                <img src="{{ asset('images/2b-logo.png') }}" alt="2B Logo" class="register-logo" onerror="this.style.display='none'">
            </div>
            <h1 class="register-title">{{ __('Crie sua conta') }}</h1>
            <p class="register-subtitle">{{ __('Preencha o formulário abaixo para se registrar') }}</p>
        </div>

        <div class="register-body">
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="form-grid">
                    <div class="form-group">
                        <label for="name">{{ __('Nome completo') }}</label>
                        <div class="input-with-icon">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Digite seu nome">
                            <span class="input-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="12" cy="7" r="4"></circle>
                                </svg>
                            </span>
                        </div>
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email">{{ __('E-mail') }}</label>
                        <div class="input-with-icon">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="seu@email.com">
                            <span class="input-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                                    <polyline points="22,6 12,13 2,6"></polyline>
                                </svg>
                            </span>
                        </div>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password">{{ __('Senha') }}</label>
                        <div class="input-with-icon">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="••••••••">
                            <span class="input-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                                    <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                                </svg>
                            </span>
                        </div>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password-confirm">{{ __('Confirme a senha') }}</label>
                        <div class="input-with-icon">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="••••••••">
                            <span class="input-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                                </svg>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="form-group mb-0 mt-4">
                    <button type="submit" class="btn-register">
                        {{ __('Registrar') }}
                    </button>
                </div>
            </form>
        </div>
        
        <div class="register-footer">
            {{ __('Já tem uma conta?') }} <a href="{{ route('login') }}">{{ __('Entre aqui') }}</a>
        </div>
    </div>
</div>
@endsection