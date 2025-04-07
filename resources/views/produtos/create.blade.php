@extends('layouts.app')

@section('content')
    <style>
        /* Variáveis de estilo compartilhadas com a página index */
        :root {
            --primary-gradient: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%);
            --card-border-radius: 16px;
            --transition-smooth: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            --box-shadow-soft: 0 10px 25px -5px rgba(0, 0, 0, 0.05), 0 8px 10px -6px rgba(0, 0, 0, 0.02);
            --box-shadow-hover: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);

            /* Light mode variables */
            --light-bg: #ffffff;
            --light-text: #374151;
            --light-text-secondary: #6b7280;
            --light-border: rgba(229, 231, 235, 0.5);
            --light-input-bg: #ffffff;
            --light-card-bg: #ffffff;

            /* Dark mode variables */
            --dark-bg: #121212;
            --dark-surface: #1e1e1e;
            --dark-surface-light: #2a2a2a;
            --dark-text: #e5e7eb;
            --dark-text-secondary: #9ca3af;
            --dark-border: rgba(75, 85, 99, 0.5);
            --dark-input-bg: #2d3238;
            --dark-card-bg: #1e1e1e;
        }

        /* Estilos para o formulário */
        .dashboard-container {
            padding: 2rem 0;
        }

        .dashboard-header {
            margin-bottom: 2.5rem;
            position: relative;
        }

        .dashboard-title {
            font-size: 2.25rem;
            font-weight: 800;
            margin: 0;
            background: var(--primary-gradient);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            display: inline-block;
        }

        .dashboard-subtitle {
            font-size: 1rem;
            color: #6b7280;
            margin-top: 0.5rem;
            max-width: 600px;
        }

        .form-card {
            background: #fff;
            border-radius: var(--card-border-radius);
            box-shadow: var(--box-shadow-soft);
            margin-bottom: 2rem;
            padding: 2rem;
            transition: var(--transition-smooth);
            border: 1px solid rgba(229, 231, 235, 0.5);
            max-width: 900px;
            margin-left: auto;
            margin-right: auto;
        }

        .form-section {
            margin-bottom: 1.5rem;
            padding-bottom: 1.5rem;
            border-bottom: 1px solid rgba(229, 231, 235, 0.8);
        }

        .form-section:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }

        .form-section-title {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
            color: #374151;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1.5rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group-full {
            grid-column: span 2;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            font-size: 0.875rem;
            color: #4b5563;
        }

        .form-control,
        .form-select {
            display: block;
            width: 100%;
            padding: 0.75rem 1rem;
            font-size: 0.95rem;
            font-weight: 400;
            line-height: 1.5;
            color: #374151;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #e5e7eb;
            border-radius: 0.5rem;
            transition: var(--transition-smooth);
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #6366f1;
            outline: 0;
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.2);
        }

        .form-control-required::after {
            content: "*";
            color: #ef4444;
            margin-left: 0.25rem;
        }

        .form-buttons {
            display: flex;
            justify-content: flex-end;
            gap: 1rem;
            margin-top: 2rem;
        }

        .btn-premium {
            padding: 0.75rem 1.5rem;
            border-radius: 0.5rem;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: var(--transition-smooth);
            border: none;
            cursor: pointer;
        }

        .btn-premium:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.4);
        }

        .btn-premium-primary {
            background: var(--primary-gradient);
            color: white;
        }

        .btn-premium-primary:hover {
            opacity: 0.9;
            transform: translateY(-2px);
        }

        .btn-premium-secondary {
            background: #f3f4f6;
            color: #4b5563;
        }

        .btn-premium-secondary:hover {
            background: #e5e7eb;
            transform: translateY(-2px);
        }

        .alert-premium {
            border-radius: 0.5rem;
            padding: 1rem;
            margin-bottom: 1.5rem;
            border-left: 4px solid;
        }

        .alert-premium-danger {
            background-color: #fef2f2;
            border-left-color: #ef4444;
            color: #b91c1c;
        }

        /* Dark mode styles */
        body.dark-mode .dashboard-title {
            background: linear-gradient(135deg, #818cf8 0%, #6366f1 100%);
            -webkit-background-clip: text;
            background-clip: text;
        }

        body.dark-mode .dashboard-subtitle {
            color: var(--dark-text-secondary);
        }

        body.dark-mode .form-card {
            background-color: var(--dark-surface);
            border-color: var(--dark-border);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        body.dark-mode .form-section {
            border-bottom-color: rgba(75, 85, 99, 0.2);
        }

        body.dark-mode .form-section-title {
            color: var(--dark-text);
        }

        body.dark-mode .form-group label {
            color: var(--dark-text-secondary);
        }

        body.dark-mode .form-control, 
        body.dark-mode .form-select {
            background-color: var(--dark-input-bg);
            border-color: var(--dark-border);
            color: var(--dark-text);
        }

        body.dark-mode .form-control:focus, 
        body.dark-mode .form-select:focus {
            border-color: #6366f1;
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.3);
        }

        body.dark-mode .form-control::placeholder {
            color: rgba(229, 231, 235, 0.5);
        }

        body.dark-mode .btn-premium-secondary {
            background-color: #374151;
            color: var(--dark-text);
        }

        body.dark-mode .btn-premium-secondary:hover {
            background-color: #4b5563;
        }

        body.dark-mode .alert-premium-danger {
            background-color: rgba(239, 68, 68, 0.1);
            border-left-color: #ef4444;
            color: #f87171;
        }

        /* Responsividade */
        @media (max-width: 768px) {
            .form-grid {
                grid-template-columns: 1fr;
            }

            .form-group-full {
                grid-column: span 1;
            }

            .form-card {
                padding: 1.5rem;
            }

            .dashboard-title {
                font-size: 1.75rem;
            }
        }
    </style>

    <div class="dashboard-container">
        <div class="container">
            <!-- Header section -->
            <div class="dashboard-header animate-fade-up">
                <h1 class="dashboard-title">Adicionar Produto</h1>
                <p class="dashboard-subtitle">Cadastre um novo produto no sistema de gestão de estoque.</p>
            </div>

            @if ($errors->any())
                <div class="alert-premium alert-premium-danger animate-fade-up">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="form-card animate-fade-up">
                <form action="{{ route('produtos.store') }}" method="POST">
                    @csrf

                    <div class="form-section">
                        <div class="form-section-title">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2">
                                <path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z">
                                </path>
                                <line x1="7" y1="7" x2="7.01" y2="7"></line>
                            </svg>
                            Informações Básicas
                        </div>

                        <div class="form-grid">
                            <div class="form-group">
                                <label for="identificador">Identificador</label>
                                <input type="text" class="form-control" id="identificador" name="identificador"
                                    value="{{ old('identificador') }}" placeholder="Código único do produto (opcional)">
                            </div>

                            <div class="form-group">
                                <label for="nome" class="form-control-required">Nome do Produto</label>
                                <input type="text" class="form-control" id="nome" name="nome" value="{{ old('nome') }}"
                                    required placeholder="Ex: Teclado Mecânico RGB">
                            </div>

                            <div class="form-group">
                                <label for="marca" class="form-control-required">Marca</label>
                                <input type="text" class="form-control" id="marca" name="marca" value="{{ old('marca') }}"
                                    required placeholder="Ex: Samsung, Apple, Logitech">
                            </div>

                            <div class="form-group">
                                <label for="setor">Setor</label>
                                <input type="text" class="form-control" id="setor" name="setor" value="{{ old('setor') }}"
                                    placeholder="Ex: Eletrônicos, Escritório, Informática">
                            </div>
                        </div>
                    </div>

                    <div class="form-section">
                        <div class="form-section-title">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2">
                                <rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect>
                                <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path>
                            </svg>
                            Estoque e Detalhes
                        </div>

                        <div class="form-grid">
                            <div class="form-group">
                                <label for="quantidade" class="form-control-required">Quantidade em Estoque</label>
                                <input type="number" class="form-control" id="quantidade" name="quantidade"
                                    value="{{ old('quantidade') }}" required min="0" placeholder="Ex: 10">
                            </div>

                            <div class="form-group">
                                <label for="status" class="form-control-required">Status do Produto</label>
                                <select class="form-select" id="status" name="status" required>
                                    <option value="" disabled selected>Selecione um status</option>
                                    <option value="estoque" {{ old('status') == 'estoque' ? 'selected' : '' }}>Em Estoque
                                    </option>
                                    <option value="em_uso" {{ old('status') == 'em_uso' ? 'selected' : '' }}>Em Uso</option>
                                </select>
                            </div>

                            <div class="form-group-full">
                                <label for="descricao" class="form-control-required">Descrição</label>
                                <textarea class="form-control" id="descricao" name="descricao" rows="3" required
                                    placeholder="Detalhes sobre o produto, especificações, etc.">{{ old('descricao') }}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="form-buttons">
                        <a href="{{ route('produtos.index') }}" class="btn-premium btn-premium-secondary">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2">
                                <line x1="19" y1="12" x2="5" y2="12"></line>
                                <polyline points="12 19 5 12 12 5"></polyline>
                            </svg>
                            Cancelar
                        </a>

                        <button type="submit" class="btn-premium btn-premium-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2">
                                <line x1="12" y1="5" x2="12" y2="19"></line>
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                            </svg>
                            Adicionar Produto
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection