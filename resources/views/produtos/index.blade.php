@extends('layouts.app')

@section('content')
    <style>
        /* Estilos Premium para a Listagem de Produtos */
        /* Estilos Premium para a Listagem de Produtos */
        :root {
            --primary-gradient: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%);
            --card-border-radius: 16px;
            --transition-smooth: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            --box-shadow-soft: 0 10px 25px -5px rgb(99, 102, 241), 0 8px 10px -6px rgba(0, 0, 0, 0.02);
            --box-shadow-hover: 0 20px 25px -5px rgba(99, 102, 241 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        /* Transições suaves para evitar saltos bruscos */
        body {
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        /* Centralizar a tabela de itens */
        .table-card {
            max-width: 1200px;
            margin-left: auto;
            margin-right: auto;
            width: 100%;
            clear: both;
            /* Garante que não há elementos flutuantes interferindo */
            position: static;
        }

        /* Garantir que a tabela responsiva também fique centralizada */
        .table-responsive {
            display: flex;
            justify-content: center;
            width: 100%;
        }

        /* Ajustar responsividade do cabeçalho e botões */
        .actions-bar {
            max-width: 1200px;
            margin-left: auto;
            margin-right: auto;
            width: 100%;
            margin-bottom: 1.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1rem;
            position: static;
        }

        /* Centralizar a paginação */
        .pagination-container {
            display: flex;
            justify-content: center;
            width: 100%;
            max-width: 1200px;
            margin-left: auto;
            margin-right: auto;
            margin-top: 2rem;
            position: static;
        }

        /* Forçar cores para a tabela no modo escuro */
        body.dark-mode .premium-table,
        body.dark-mode .table-card,
        body.dark-mode table.premium-table {
            background-color: #2a2a2a !important;
            color: #e5e7eb !important;
            transition: background-color 0.3s ease, color 0.3s ease, border-color 0.3s ease;
        }

        body.dark-mode .premium-table thead th,
        body.dark-mode table.premium-table th {
            background-color: #1f2937 !important;
            color: #9ca3af !important;
            border-color: #374151 !important;
        }

        body.dark-mode .premium-table tbody td,
        body.dark-mode table.premium-table td {
            background-color: #2a2a2a !important;
            border-color: #374151 !important;
            color: #e5e7eb !important;
        }

        body.dark-mode .premium-table tbody tr:hover,
        body.dark-mode table.premium-table tr:hover {
            background-color: #374151 !important;
        }

        /* Container principal */
        .dashboard-container {
            padding: 2rem 0;
        }

        /* Header estilizado */
        .dashboard-header {
            margin-bottom: 2.5rem;
            position: relative;
        }

        .dashboard-title-section {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 1rem;
            margin-bottom: 1.5rem;
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

        body.dark-mode .dashboard-title {
            background: linear-gradient(135deg, #818cf8 0%, #6366f1 100%);
            -webkit-background-clip: text;
            background-clip: text;
        }

        .dashboard-subtitle {
            font-size: 1rem;
            color: #6b7280;
            margin-top: 0.5rem;
            max-width: 600px;
        }

        body.dark-mode .dashboard-subtitle {
            color: #9ca3af;
        }

        /* Cards de estatísticas */
        .stats-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: #fff;
            border-radius: var(--card-border-radius);
            box-shadow: var(--box-shadow-soft);
            padding: 1.5rem;
            transition: var(--transition-smooth);
            border: 1px solid rgba(229, 231, 235, 0.5);
            position: relative;
            overflow: hidden;
        }

        body.dark-mode .stat-card {
            background: #2a2a2a;
            border-color: rgba(75, 85, 99, 0.5);
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--box-shadow-hover);
        }

        .stat-card::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: var(--primary-gradient);
        }

        .stat-card-value {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 0.25rem;
            color: #4f46e5;
        }

        body.dark-mode .stat-card-value {
            color: #818cf8;
        }

        .stat-card-label {
            font-size: 0.875rem;
            color: #6b7280;
            display: flex;
            align-items: center;
        }

        body.dark-mode .stat-card-label {
            color: #9ca3af;
        }

        .stat-card-icon {
            position: absolute;
            top: 1.5rem;
            right: 1.5rem;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(99, 102, 241, 0.1);
            border-radius: 12px;
            color: #4f46e5;
        }

        body.dark-mode .stat-card-icon {
            background: rgba(129, 140, 248, 0.2);
            color: #818cf8;
        }

        /* Card de busca estilizado */
        .search-card {
            background: #fff;
            border-radius: var(--card-border-radius);
            box-shadow: var(--box-shadow-soft);
            margin-bottom: 2rem;
            padding: 2rem;
            transition: var(--transition-smooth);
            border: 1px solid rgba(229, 231, 235, 0.5);
        }

        body.dark-mode .search-card {
            background: #2a2a2a;
            border-color: rgba(75, 85, 99, 0.5);
        }

        .search-title {
            font-weight: 600;
            font-size: 1.25rem;
            margin-bottom: 1.5rem;
            color: #1f2937;
            display: flex;
            align-items: center;
        }

        body.dark-mode .search-title {
            color: #e5e7eb;
        }

        .search-title svg {
            margin-right: 0.75rem;
            color: #4f46e5;
        }

        body.dark-mode .search-title svg {
            color: #818cf8;
        }

        .search-form .input-group {
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
            border-radius: 12px;
            overflow: hidden;
        }

        .search-input {
            border-top-left-radius: 12px !important;
            border-bottom-left-radius: 12px !important;
            border: 1px solid #e5e7eb;
            padding: 0.75rem 1.25rem;
            font-size: 1rem;
        }

        body.dark-mode .search-input {
            border-color: #4b5563;
            background-color: #2d3238 !important;
            color: #f8f9fa !important;
        }

        .search-button {
            border-top-right-radius: 12px !important;
            border-bottom-right-radius: 12px !important;
            background: var(--primary-gradient);
            border: none;
            padding: 0.75rem 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: white;
            font-weight: 500;
            transition: var(--transition-smooth);
        }

        .search-button:hover {
            opacity: 0.9;
        }

        /* Actions bar */
        .action-buttons {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .btn-premium {
            padding: 0.75rem 1.5rem;
            border-radius: 12px;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            transition: var(--transition-smooth);
            border: none;
        }

        .btn-premium:focus {
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.4);
        }

        .btn-premium-primary {
            background: var(--primary-gradient);
            color: white;
        }

        body.dark-mode .btn-premium-primary {
            background: linear-gradient(135deg, #818cf8 0%, #6366f1 100%);
        }

        .btn-premium-primary:hover {
            opacity: 0.9;
            transform: translateY(-2px);
        }

        .btn-premium-secondary {
            background: #f3f4f6;
            color: #4b5563;
        }

        body.dark-mode .btn-premium-secondary {
            background: #374151;
            color: #e5e7eb;
        }

        .btn-premium-secondary:hover {
            background: #e5e7eb;
            transform: translateY(-2px);
        }

        body.dark-mode .btn-premium-secondary:hover {
            background: #4b5563;
        }

        .btn-premium-warning {
            background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%);
            color: white;
        }

        .btn-premium-warning:hover {
            opacity: 0.9;
            transform: translateY(-2px);
        }

        .result-counter {
            background: #f3f4f6;
            padding: 0.5rem 1rem;
            border-radius: 10px;
            font-size: 0.875rem;
            color: #4b5563;
            display: flex;
            align-items: center;
            flex-shrink: 0;
        }

        body.dark-mode .result-counter {
            background: #374151;
            color: #e5e7eb;
            border: 1px solid #4b5563;
        }

        .result-counter svg {
            margin-right: 0.5rem;
        }

        /* Tabela Premium */
        .table-card {
            background: #fff;
            border-radius: var(--card-border-radius);
            box-shadow: var(--box-shadow-soft);
            margin-bottom: 2rem;
            transition: var(--transition-smooth);
            border: 1px solid rgba(229, 231, 235, 0.5);
            overflow: hidden;
        }

        body.dark-mode .table-card {
            background: #2a2a2a;
            border-color: rgba(75, 85, 99, 0.5);
        }

        .premium-table {
            margin-bottom: 0;
        }

        .premium-table thead th {
            background: #f9fafb;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.05em;
            padding: 1rem;
            color: #6b7280;
            border: none;
        }

        body.dark-mode .premium-table thead th {
            background: #1f2937;
            color: #9ca3af;
        }

        .premium-table tbody td {
            padding: 1rem;
            vertical-align: middle;
            border-bottom: 1px solid #f3f4f6;
            color: #374151;
        }

        body.dark-mode .premium-table tbody td {
            border-color: #374151;
            color: #e5e7eb;
        }

        .premium-table tbody tr:last-child td {
            border-bottom: none;
        }

        .premium-table tbody tr {
            transition: var(--transition-smooth);
        }

        .premium-table tbody tr:hover {
            background: rgba(249, 250, 251, 0.7);
        }

        body.dark-mode .premium-table tbody tr:hover {
            background: rgba(31, 41, 55, 0.7);
        }

        /* Status de quantidade */
        .status-badge {
            display: inline-flex;
            align-items: center;
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-weight: 500;
            font-size: 0.75rem;
        }

        .status-low {
            background: #fef2f2;
            color: #ef4444;
        }

        body.dark-mode .status-low {
            background: rgba(239, 68, 68, 0.2);
        }

        .status-medium {
            background: #fffbeb;
            color: #f59e0b;
        }

        body.dark-mode .status-medium {
            background: rgba(245, 158, 11, 0.2);
        }

        .status-high {
            background: #f0fdf4;
            color: #10b981;
        }

        body.dark-mode .status-high {
            background: rgba(16, 185, 129, 0.2);
        }

        .status-badge::before {
            content: "";
            display: block;
            width: 8px;
            height: 8px;
            border-radius: 50%;
            margin-right: 0.5rem;
        }

        .status-low::before {
            background: #ef4444;
        }

        .status-medium::before {
            background: #f59e0b;
        }

        .status-high::before {
            background: #10b981;
        }

        /* Ações na tabela */
        .row-actions {
            display: flex;
            gap: 0.5rem;
        }

        .action-icon-btn {
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            background: #f3f4f6;
            color: #4b5563;
            transition: var(--transition-smooth);
            border: none;
        }

        body.dark-mode .action-icon-btn {
            background: #374151;
            color: #e5e7eb;
        }

        .action-icon-btn:hover {
            transform: translateY(-2px);
        }

        .action-icon-btn.edit-btn {
            background: rgba(99, 102, 241, 0.1);
            color: #4f46e5;
        }

        body.dark-mode .action-icon-btn.edit-btn {
            background: rgba(129, 140, 248, 0.2);
            color: #818cf8;
        }

        .action-icon-btn.delete-btn {
            background: rgba(239, 68, 68, 0.1);
            color: #ef4444;
        }

        body.dark-mode .action-icon-btn.delete-btn {
            background: rgba(239, 68, 68, 0.2);
        }

        .action-icon-btn.view-btn {
            background: rgba(16, 185, 129, 0.1);
            color: #10b981;
        }

        body.dark-mode .action-icon-btn.view-btn {
            background: rgba(16, 185, 129, 0.2);
        }

        /* Truncate text */
        .truncate {
            max-width: 200px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        /* ID cells */
        .id-cell {
            font-family: "SFMono-Regular", Consolas, "Liberation Mono", Menlo, monospace;
            color: #6b7280;
            font-size: 0.875rem;
        }

        body.dark-mode .id-cell {
            color: #9ca3af;
        }

        /* Paginação estilizada */
        .pagination-premium {
            display: flex;
            gap: 0.5rem;
        }

        .page-item .page-link {
            border-radius: 8px;
            border: none;
            padding: 0.5rem 0.75rem;
            color: #4b5563;
            font-weight: 500;
            transition: var(--transition-smooth);
        }

        body.dark-mode .page-item .page-link {
            background: #374151;
            color: #e5e7eb;
        }

        .page-item.active .page-link {
            background: var(--primary-gradient);
            color: white;
        }

        /* Toggle de modo escuro */
        .theme-toggle {
            display: inline-flex;
            align-items: center;
            padding: 0.5rem 1rem;
            border-radius: 12px;
            background: #f3f4f6;
            color: #4b5563;
            font-weight: 500;
            gap: 0.5rem;
            transition: var(--transition-smooth);
            border: none;
        }

        body.dark-mode .theme-toggle {
            background: #374151;
            color: #e5e7eb;
        }

        .theme-toggle:hover {
            transform: translateY(-2px);
        }

        /* Animações */
        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-up {
            animation: fadeUp 0.5s ease forwards;
        }

        .delay-100 {
            animation-delay: 0.1s;
        }

        .delay-200 {
            animation-delay: 0.2s;
        }

        .delay-300 {
            animation-delay: 0.3s;
        }

        /* Empty state */
        .empty-state {
            text-align: center;
            padding: 3rem;
        }

        .empty-state-icon {
            width: 80px;
            height: 80px;
            margin: 0 auto 1.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(99, 102, 241, 0.1);
            color: #4f46e5;
            border-radius: 50%;
        }

        body.dark-mode .empty-state-icon {
            background: rgba(129, 140, 248, 0.2);
            color: #818cf8;
        }

        .empty-state-title {
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .empty-state-text {
            color: #6b7280;
            max-width: 500px;
            margin: 0 auto 1.5rem;
        }

        body.dark-mode .empty-state-text {
            color: #9ca3af;
        }

        /* Tooltip */
        .custom-tooltip {
            position: relative;
            cursor: help;
        }

        .custom-tooltip::after {
            content: attr(data-tooltip);
            position: absolute;
            bottom: 125%;
            left: 50%;
            transform: translateX(-50%);
            background: rgba(17, 24, 39, 0.9);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 6px;
            font-size: 0.75rem;
            white-space: nowrap;
            opacity: 0;
            visibility: hidden;
            transition: all 0.2s ease;
            pointer-events: none;
            z-index: 100;
        }

        body.dark-mode .custom-tooltip::after {
            background: rgba(255, 255, 255, 0.9);
            color: #111827;
        }

        .custom-tooltip:hover::after {
            opacity: 1;
            visibility: visible;
        }

        /* Responsividade */
        @media (max-width: 991px) {
            .stats-cards {
                grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            }
        }

        @media (max-width: 768px) {
            .dashboard-title {
                font-size: 1.75rem;
            }

            .search-card {
                padding: 1.5rem;
            }

            .actions-bar {
                flex-direction: column;
                align-items: flex-start;
            }

            .result-counter {
                width: 100%;
                justify-content: center;
                margin-top: 1rem;
            }
        }

        @media (max-width: 576px) {
            .stats-cards {
                grid-template-columns: 1fr;
            }

            .dashboard-container {
                padding: 1rem 0;
            }

            .search-title {
                font-size: 1.1rem;
            }
        }

        /* Estilos adicionais para forçar o dark mode */
        body.dark-mode .premium-table {
            color: #e5e7eb !important;
        }

        body.dark-mode .premium-table tbody td {
            border-color: #374151 !important;
            color: #e5e7eb !important;
        }

        body.dark-mode .premium-table thead th {
            background-color: #1f2937 !important;
            color: #9ca3af !important;
        }

        body.dark-mode .modal-content,
        body.dark-mode .modal-body,
        body.dark-mode .modal-footer {
            background-color: #2a2a2a !important;
            color: #e5e7eb !important;
        }

        body.dark-mode .text-muted {
            color: #9ca3af !important;
        }

        /* Garantir que o modo escuro seja aplicado com maior especificidade */
        body.dark-mode {
            background-color: #212529 !important;
            color: #f8f9fa !important;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        /* Cores padrão mais fortes para sobrescrever qualquer estilo em linha */
        body.dark-mode .dashboard-container,
        body.dark-mode .container,
        body.dark-mode .row,
        body.dark-mode .col,
        body.dark-mode .card {
            background-color: #212529 !important;
            color: #f8f9fa !important;
        }

        /* Estilos de formulário para modo escuro */
        body.dark-mode input,
        body.dark-mode select,
        body.dark-mode textarea {
            background-color: #2d3238 !important;
            color: #f8f9fa !important;
            border-color: #495057 !important;
        }

        /* Força cores especificas para garantir contraste */
        body.dark-mode .premium-table thead th {
            background-color: #1f2937 !important;
            color: #e5e7eb !important;
        }

        body.dark-mode .premium-table tbody td {
            background-color: #2a2a2a !important;
            color: #e5e7eb !important;
        }

        /* Garantia que o modo escuro aplica-se em contextos específicos */
        body.dark-mode .table-card,
        body.dark-mode .search-card,
        body.dark-mode .stat-card {
            background-color: #2a2a2a !important;
            border-color: #4b5563 !important;
        }

        /* Estilos para texto e contadores */
        body.dark-mode .text-muted,
        body.dark-mode small,
        body.dark-mode .id-cell,
        body.dark-mode .stat-card-label {
            color: #adb5bd !important;
        }

        /* Garantir que as transições sejam suaves */
        .dashboard-container *,
        .table-card,
        .premium-table,
        .search-card,
        .stat-card,
        .theme-toggle {
            transition: background-color 0.3s ease, color 0.3s ease, border-color 0.3s ease;
        }

        /* Adicionais para corrigir o background do modal no modo escuro */
        body.dark-mode .modal-content {
            background-color: #2a2a2a !important;
        }

        body.dark-mode .modal-header {
            border-bottom-color: #374151 !important;
        }

        body.dark-mode .modal-footer {
            border-top-color: #374151 !important;
        }

        /* Correção específica para o problema de desalinhamento */
        body.dark-mode .actions-bar,
        body.dark-mode .table-card,
        body.dark-mode .pagination-container {
            position: relative;
            z-index: 1;
        }

        /* Força o background escuro para elementos que possam estar sendo afetados */
        body.dark-mode .p-3.bg-light.rounded {
            background-color: #1f2937 !important;
            color: #e5e7eb !important;
        }

        /* Melhorar a visualização da descrição no modal */
        body.dark-mode .product-details .p-3.bg-light.rounded {
            background-color: #1f2937 !important;
            color: #e5e7eb !important;
        }
    </style>

    <div class="dashboard-container">
        <div class="container">
            <!-- Header section -->
            <div class="dashboard-header animate-fade-up">
                <div class="dashboard-title-section">
                    <div>
                        <h1 class="dashboard-title">Gestão de Produtos</h1>
                        <p class="dashboard-subtitle">Gerencie seu catálogo de produtos, controle estoque e monitore a
                            disponibilidade.</p>
                    </div>

                    <button id="toggle-dark-mode" class="theme-toggle">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2">
                            <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path>
                        </svg>
                        <span id="dark-mode-text">Modo Escuro</span>
                    </button>
                </div>

                <!-- Stats cards -->
                <div class="stats-cards">
                    <div class="stat-card animate-fade-up delay-100">
                        <div class="stat-card-value">{{ $totalProdutos }}</div>
                        <div class="stat-card-label">Produtos Cadastrados</div>
                        <div class="stat-card-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2">
                                <path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z">
                                </path>
                                <line x1="7" y1="7" x2="7.01" y2="7"></line>
                            </svg>
                        </div>
                    </div>

                    <div class="stat-card animate-fade-up delay-200">
                        <div class="stat-card-value">
                            {{ $totalEstoque }}
                        </div>
                        <div class="stat-card-label">Itens em Estoque</div>
                        <div class="stat-card-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2">
                                <rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect>
                                <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path>
                            </svg>
                        </div>
                    </div>

                    <div class="stat-card animate-fade-up delay-300">
                        <div class="stat-card-value">{{ $lowStock }}</div>
                        <div class="stat-card-label">Produtos com Estoque Baixo</div>
                        <div class="stat-card-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2">
                                <circle cx="12" cy="12" r="10"></circle>
                                <line x1="12" y1="8" x2="12" y2="12"></line>
                                <line x1="12" y1="16" x2="12.01" y2="16"></line>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Search card -->
            <div class="search-card animate-fade-up">
                <div class="search-title">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2">
                        <circle cx="11" cy="11" r="8"></circle>
                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                    </svg>
                    Buscar Produtos
                </div>
                <form method="GET" action="{{ route('produtos.index') }}" class="search-form">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control search-input"
                            placeholder="Digite para buscar por nome, marca, ou identificador..."
                            value="{{ request()->input('search') }}">
                        <button type="submit" class="btn search-button">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2">
                                <circle cx="11" cy="11" r="8"></circle>
                                <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                            </svg>
                            Buscar
                        </button>
                    </div>
                </form>
            </div>

            <!-- Actions bar - REESTRUTURADO -->
            <div class="actions-bar animate-fade-up">
                <div class="action-buttons">
                    <a href="{{ route('produtos.create') }}" class="btn-premium btn-premium-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2">
                            <line x1="12" y1="5" x2="12" y2="19"></line>
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                        </svg>
                        Novo Produto
                    </a>
                    <a href="{{ route('produtos.index')}}" class="btn-premium btn-premium-warning ms-2">Em Uso</a>
                    <a href="{{ route('produtos.stock.index')}}" class="btn-premium btn-premium-info ms-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2">
                            <path d="M20 12V8H6a2 2 0 0 1-2-2c0-1.1.9-2 2-2h12v4"></path>
                            <path d="M4 6v12c0 1.1.9 2 2 2h14v-4"></path>
                            <path d="M18 12a2 2 0 0 0-2 2c0 1.1.9 2 2 2h4v-4h-4z"></path>
                        </svg>
                        Estoque
                    </a>

                    @if(auth()->user()->hasRole('admin'))
                        <a href="{{ route('produtos.stock.index')}}" class="btn-premium btn-premium-warning">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2">
                                <path d="M20 12V8H6a2 2 0 0 1-2-2c0-1.1.9-2 2-2h12v4"></path>
                                <path d="M4 6v12c0 1.1.9 2 2 2h14v-4"></path>
                                <path d="M18 12a2 2 0 0 0-2 2c0 1.1.9 2 2 2h4v-4h-4z"></path>
                            </svg>
                            Gerenciar Estoque
                        </a>
                    @endif

                    <button class="btn-premium btn-premium-secondary" onclick="exportTable()">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2">
                            <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                            <polyline points="7 10 12 15 17 10"></polyline>
                            <line x1="12" y1="15" x2="12" y2="3"></line>
                        </svg>
                        Exportar
                    </button>
                </div>

                <div class="result-counter">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2">
                        <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                        <line x1="3" y1="9" x2="21" y2="9"></line>
                        <line x1="9" y1="21" x2="9" y2="9"></line>
                    </svg>
                    Mostrando {{ $produtos->count() }} de {{ $produtos->total() }} produtos
                </div>
            </div>

            <!-- Table card - AGORA SEPARADO -->
            <div class="table-card animate-fade-up">
                <div class="table-responsive">
                    <table class="table premium-table" id="productsTable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Produto</th>
                                <th>Marca</th>
                                <th>Estoque</th>
                                <th>Setor</th>
                                <th>Descrição</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($produtos->count() > 0)
                                @foreach($produtos as $produto)
                                    <tr class="produto-row">
                                        <td class="id-cell">{{ $produto->identificador ?? 'N/A' }}</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div>
                                                    <strong>{{ $produto->nome }}</strong>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ $produto->marca }}</td>
                                        <td>
                                            <span
                                                class="status-badge {{ $produto->quantidade > 50 ? 'status-high' : ($produto->quantidade > 10 ? 'status-medium' : 'status-low') }}">
                                                {{ $produto->quantidade }} unidades
                                            </span>
                                        </td>
                                        <td>
                                            @if($produto->setor)
                                                <span class="status-badge status-high">{{ $produto->setor }}</span>
                                            @else
                                                <span class="text-muted">—</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="truncate custom-tooltip" data-tooltip="{{ $produto->descricao }}">
                                                {{ \Illuminate\Support\Str::limit($produto->descricao, 40, '...') }}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="row-actions">
                                                <a href="{{ route('produtos.edit', $produto->id) }}"
                                                    class="action-icon-btn edit-btn" title="Editar produto">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7">
                                                        </path>
                                                        <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z">
                                                        </path>
                                                    </svg>
                                                </a>
                                                <button type="button" class="action-icon-btn view-btn view-details-btn"
                                                    title="Ver detalhes" data-id="{{ $produto->id }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                                        <circle cx="12" cy="12" r="3"></circle>
                                                    </svg>
                                                </button>
                                                <form
                                                    action="{{ route('produtos.stock.destroy', ['id' => $produto->id, 'stock' => '0']) }}"
                                                    method="POST" style="display:inline;" class="form-delete">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="action-icon-btn delete-btn btn-delete"
                                                        title="Excluir produto">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                            <polyline points="3 6 5 6 21 6"></polyline>
                                                            <path
                                                                d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                                            </path>
                                                            <line x1="10" y1="11" x2="10" y2="17"></line>
                                                            <line x1="14" y1="11" x2="14" y2="17"></line>
                                                        </svg>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="7">
                                        <div class="empty-state">
                                            <div class="empty-state-icon">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                    <circle cx="12" cy="12" r="10"></circle>
                                                    <path d="M8 12h8"></path>
                                                </svg>
                                            </div>
                                            <h3 class="empty-state-title">Nenhum produto encontrado</h3>
                                            <p class="empty-state-text">Não foram encontrados produtos correspondentes à sua
                                                busca. Tente modificar os critérios de busca ou adicione um novo produto.
                                            </p>
                                            <a href="{{ route('produtos.create') }}" class="btn-premium btn-premium-primary">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                    <line x1="12" y1="5" x2="12" y2="19"></line>
                                                    <line x1="5" y1="12" x2="19" y2="12"></line>
                                                </svg>
                                                Adicionar Produto
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Paginação - AGORA SEPARADA -->
            <div class="pagination-container animate-fade-up">
                {{ $produtos->appends(request()->query())->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>

    <!-- Modal de detalhes do produto -->
    <div class="modal fade" id="productDetailsModal" tabindex="-1" aria-labelledby="productDetailsModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border-radius: 16px; overflow: hidden;">
                <div class="modal-header" style="background: var(--primary-gradient); color: white; border-bottom: none;">
                    <h5 class="modal-title" id="productDetailsModalLabel">Detalhes do Produto</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body" id="productDetailsContent">
                    <div class="text-center py-4">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Carregando...</span>
                        </div>
                        <p class="mt-2">Carregando detalhes do produto...</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-premium btn-premium-secondary" data-bs-dismiss="modal">Fechar</button>
                    <a href="#" class="btn-premium btn-premium-primary" id="editProductBtn">Editar Produto</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            // Aplicar modo escuro se estiver salvo no localStorage
            if (localStorage.getItem('dark-mode') === 'enabled') {
                $('body').addClass('dark-mode');
                $('#dark-mode-text').text('Modo Claro');

                // Atualiza SweetAlert se estiver presente
                if (typeof Swal !== 'undefined') {
                    const container = Swal.getContainer();
                    if (container) container.classList.add('swal2-dark');
                }
            } else {
                $('body').removeClass('dark-mode');
                $('#dark-mode-text').text('Modo Escuro');
            }

            // Integração com o sistema de dark mode existente
            $('#toggle-dark-mode').click(function () {
                $('body').toggleClass('dark-mode');

                if ($('body').hasClass('dark-mode')) {
                    localStorage.setItem('dark-mode', 'enabled');
                    $('#dark-mode-text').text('Modo Claro');

                    // Atualiza SweetAlert se estiver presente
                    if (typeof Swal !== 'undefined') {
                        const container = Swal.getContainer();
                        if (container) container.classList.add('swal2-dark');
                    }
                } else {
                    localStorage.setItem('dark-mode', 'disabled');
                    $('#dark-mode-text').text('Modo Escuro');

                    // Atualiza SweetAlert se estiver presente
                    if (typeof Swal !== 'undefined') {
                        const container = Swal.getContainer();
                        if (container) container.classList.remove('swal2-dark');
                    }
                }
            });

            // Modal de detalhes do produto
            $('.view-details-btn').click(function () {
                const productId = $(this).data('id');
                const modal = $('#productDetailsModal');
                const contentArea = $('#productDetailsContent');
                const editBtn = $('#editProductBtn');

                // Configurar o link de edição
                editBtn.attr('href', `/produtos/${productId}/edit`);

                // Exibir o modal com indicador de carregamento
                modal.modal('show');

                // Simular carregamento dos detalhes (substitua por uma chamada AJAX real)
                setTimeout(function () {
                    // Obter dados da linha da tabela (em produção, isso seria uma chamada AJAX)
                    const row = $(`button[data-id="${productId}"]`).closest('tr');
                    const id = row.find('.id-cell').text();
                    const nome = row.find('td:nth-child(2) strong').text();
                    const marca = row.find('td:nth-child(3)').text();
                    const quantidade = row.find('.status-badge').text().trim();
                    const setor = row.find('td:nth-child(5)').text().trim();
                    const descricao = row.find('.custom-tooltip').data('tooltip');

                    // Construir HTML detalhado
                    const detailsHtml = `
                                    <div class="product-details">
                                        <div class="mb-4">
                                            <small class="text-muted d-block mb-1">Identificador</small>
                                            <div class="id-cell fs-5">${id}</div>
                                        </div>

                                        <div class="mb-4">
                                            <small class="text-muted d-block mb-1">Nome do Produto</small>
                                            <div class="fs-4 fw-bold">${nome}</div>
                                        </div>

                                        <div class="row mb-4">
                                            <div class="col-6">
                                                <small class="text-muted d-block mb-1">Marca</small>
                                                <div>${marca}</div>
                                            </div>
                                            <div class="col-6">
                                                <small class="text-muted d-block mb-1">Quantidade</small>
                                                <div class="status-badge ${quantidade.includes('0 ') ? 'status-low' : (parseInt(quantidade) > 50 ? 'status-high' : 'status-medium')}">${quantidade}</div>
                                            </div>
                                        </div>

                                        <div class="mb-4">
                                            <small class="text-muted d-block mb-1">Setor</small>
                                            <div>${setor === '—' ? '<span class="text-muted">Nenhum setor definido</span>' : setor}</div>
                                        </div>

                                        <div>
                                            <small class="text-muted d-block mb-1">Descrição</small>
                                            <div class="p-3 bg-light rounded" style="${$('body').hasClass('dark-mode') ? 'background-color: #1f2937 !important' : ''}">${descricao || '<span class="text-muted">Sem descrição</span>'}</div>
                                        </div>
                                    </div>
                                `;

                    // Atualizar o conteúdo do modal
                    contentArea.html(detailsHtml);
                }, 800);
            });
        });

        // Configuração do SweetAlert para confirmações
        const deleteButtons = document.querySelectorAll('.btn-delete');
        deleteButtons.forEach(button => {
            button.addEventListener('click', function (event) {
                event.preventDefault();
                const form = this.closest('form');

                // Configuração do SweetAlert com tema associado
                Swal.fire({
                    title: "Confirmar exclusão?",
                    text: "Este produto será permanentemente removido do sistema.",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#4f46e5",
                    cancelButtonColor: "#ef4444",
                    confirmButtonText: "Sim, excluir",
                    cancelButtonText: "Cancelar",
                    background: $('body').hasClass('dark-mode') ? '#2a2a2a' : '#fff',
                    color: $('body').hasClass('dark-mode') ? '#e5e7eb' : '#374151',
                    customClass: {
                        confirmButton: 'btn btn-danger',
                        cancelButton: 'btn btn-secondary'
                    },
                    showClass: {
                        popup: 'animate__animated animate__fadeInDown'
                    },
                    hideClass: {
                        popup: 'animate__animated animate__fadeOutUp'
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Animação de exclusão
                        const row = button.closest('tr');
                        $(row).fadeOut(400, function () {
                            form.submit();
                        });
                    }
                });
            });
        });

        // Função para exportar a tabela
        window.exportTable = function () {
            // Obter cabeçalhos da tabela
            const headers = [];
            $('#productsTable thead th').each(function () {
                headers.push($(this).text().trim());
            });

            // Obter dados das linhas
            const rows = [];
            $('#productsTable tbody tr').each(function () {
                const rowData = [];
                $(this).find('td').each(function (index) {
                    // Tratamento especial para células com conteúdo complexo
                    if (index === 3) { // Coluna de estoque
                        // Extrair apenas o número de unidades
                        const quantidade = $(this).find('.status-badge').text().trim().split(' ')[0];
                        rowData.push(quantidade);
                    } else if (index === 5) { // Coluna de descrição
                        // Usar o texto completo do tooltip
                        const descricao = $(this).find('.custom-tooltip').data('tooltip') ||
                            $(this).find('.custom-tooltip').text().trim();
                        rowData.push(descricao);
                    } else if (index === 6) { // Coluna de ações
                        // Pular coluna de ações
                        return;
                    } else {
                        // Para outras colunas, pegar o texto
                        rowData.push($(this).text().trim());
                    }
                });
                rows.push(rowData);
            });

            // Criar o conteúdo do CSV
            let csvContent = headers.join(',') + '\n';
            rows.forEach(row => {
                // Adicionar aspas em cada valor para lidar com vírgulas no texto
                const formattedRow = row.map(cell => `"${cell.replace(/"/g, '""')}"`);
                csvContent += formattedRow.join(',') + '\n';
            });

            // Criar um elemento de download
            const encodedUri = encodeURI('data:text/csv;charset=utf-8,' + csvContent);
            const link = document.createElement('a');
            link.setAttribute('href', encodedUri);
            link.setAttribute('download', 'produtos_' + new Date().toISOString().slice(0, 10) + '.csv');
            document.body.appendChild(link);

            // Feedback para o usuário
            Swal.fire({
                title: 'Exportação iniciada',
                text: 'Seus dados estão sendo baixados',
                icon: 'info',
                timer: 2000,
                timerProgressBar: true,
                showConfirmButton: false,
                background: $('body').hasClass('dark-mode') ? '#2a2a2a' : '#fff',
                color: $('body').hasClass('dark-mode') ? '#e5e7eb' : '#374151'
            });

            // Disparar o download
            link.click();
            document.body.removeChild(link);
        };
    </script>
@endsection