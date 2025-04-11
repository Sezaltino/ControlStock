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

        .login-container {
            min-height: calc(100vh - 140px);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem 1rem;
        }

        .login-card {
            background: #fff;
            border-radius: var(--card-border-radius);
            box-shadow: var(--box-shadow-soft);
            overflow: hidden;
            width: 100%;
            max-width: 450px;
            transition: var(--transition-smooth);
            border: 1px solid rgba(229, 231, 235, 0.5);
            position: relative;
        }

        .login-header {
            background: var(--primary-gradient);
            padding: 2rem;
            text-align: center;
            color: white;
            position: relative;
        }

        .login-title {
            font-size: 1.75rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .login-subtitle {
            font-size: 0.95rem;
            opacity: 0.9;
        }

        .login-body {
            padding: 2.5rem 2rem;
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

        .input-icon {
            position: absolute;
            top: 2.5rem;
            right: 1rem;
            color: #9ca3af;
        }

        .form-check {
            display: flex;
            align-items: center;
        }

        .form-check-input {
            width: 18px;
            height: 18px;
            margin-right: 0.5rem;
            border: 1px solid #d1d5db;
            border-radius: 0.25rem;
            transition: var(--transition-smooth);
        }

        .form-check-input:checked {
            background-color: #6366f1;
            border-color: #6366f1;
        }

        .form-check-label {
            font-size: 0.9rem;
            color: #6b7280;
        }

        .btn-login {
            display: inline-block;
            padding: 0.75rem 1.25rem;
            border-radius: 0.5rem;
            font-weight: 500;
            font-size: 0.95rem;
            text-align: center;
            border: none;
            transition: var(--transition-smooth);
            cursor: pointer;
        }

        .btn-primary {
            background: var(--primary-gradient);
            color: white;
            width: 100%;
            padding: 0.85rem;
        }

        .btn-primary:hover {
            opacity: 0.95;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(79, 70, 229, 0.25);
        }

        .login-footer {
            text-align: center;
            padding: 1rem 2rem 2rem;
        }

        .btn-link {
            font-size: 0.9rem;
            color: #6366f1;
            text-decoration: none;
            transition: var(--transition-smooth);
        }

        .btn-link:hover {
            color: #4f46e5;
            text-decoration: underline;
        }

        .login-divider {
            display: flex;
            align-items: center;
            margin: 1.5rem 0;
        }

        .login-divider::before,
        .login-divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background-color: #e5e7eb;
        }

        .login-divider-text {
            padding: 0 1rem;
            color: #9ca3af;
            font-size: 0.85rem;
        }

        .invalid-feedback {
            display: block;
            width: 100%;
            margin-top: 0.25rem;
            font-size: 0.85rem;
            color: #ef4444;
        }

        /* Decorative elements */
        .login-decoration {
            position: absolute;
            width: 80px;
            height: 80px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
        }

        .decoration-1 {
            top: -40px;
            right: -20px;
        }

        .decoration-2 {
            bottom: -30px;
            left: -30px;
            width: 60px;
            height: 60px;
        }

        /* Dark mode styles */
        body.dark-mode .login-card {
            background-color: #1e1e1e;
            border-color: rgba(75, 85, 99, 0.5);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
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

        body.dark-mode .input-icon {
            color: #9ca3af;
        }

        body.dark-mode .form-check-label {
            color: #9ca3af;
        }

        body.dark-mode .form-check-input {
            border-color: #4b5563;
            background-color: #2d3238;
        }

        body.dark-mode .login-divider::before,
        body.dark-mode .login-divider::after {
            background-color: rgba(75, 85, 99, 0.5);
        }

        body.dark-mode .login-divider-text {
            color: #9ca3af;
        }

    </style>

    <div class="login-container">
        <div class="login-card animate-fade-up">
            <div class="login-header">
                <div class="login-decoration decoration-1"></div>
                <div class="login-decoration decoration-2"></div>
                <h1 class="login-title">{{ __('Bem-vindo') }}</h1>
                <p class="login-subtitle">{{ __('Acesse sua conta para continuar') }}</p>
            </div>

            <div class="login-body">
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="form-group">
                        <label for="email">{{ __('E-mail') }}</label>
                        <div class="input-with-icon">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                                placeholder="seu@email.com">
                            <span class="input-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z">
                                    </path>
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
                            <input id="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" name="password" required
                                autocomplete="current-password" placeholder="••••••••">
                            <span class="input-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2">
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
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="remember">
                                {{ __('Lembrar meus dados') }}
                            </label>
                        </div>
                    </div>

                    <div class="form-group mb-0">
                        <button type="submit" class="btn-login btn-primary">
                            {{ __('Entrar') }}
                        </button>
                    </div>

                    @if (Route::has('password.request'))
                        <div class="login-divider">
                            <span class="login-divider-text">ou</span>
                        </div>
                        <div class="text-center">
                            <a class="btn-link" href="{{ route('password.request') }}">
                                {{ __('Esqueceu sua senha?') }}
                            </a>
                        </div>
                    @endif
                </form>
            </div>
        </div>
    </div>
@endsection