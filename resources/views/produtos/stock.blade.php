@extends('layouts.app')

@section('content')
    <style>
        /* Variáveis de estilo */
        :root {
            --primary-gradient: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%);
            --card-border-radius: 16px;
            --transition-smooth: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            --box-shadow-soft: 0 10px 25px -5px rgba(0, 0, 0, 0.05), 0 8px 10px -6px rgba(0, 0, 0, 0.02);
            --box-shadow-hover: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);

            /* Cores para modo claro */
            --light-bg: #ffffff;
            --light-surface: #f9fafb;
            --light-border: rgba(229, 231, 235, 0.5);
            --light-text: #374151;
            --light-text-secondary: #6b7280;

            /* Cores para modo escuro */
            --dark-bg: #121212;
            --dark-surface: #2a2a2a;
            --dark-surface-header: #1f2937;
            --dark-border: rgba(75, 85, 99, 0.5);
            --dark-text: #e5e7eb;
            --dark-text-secondary: #9ca3af;
        }

        /* Transições suaves para evitar saltos bruscos */
        body {
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        /* Configurações para modo escuro global */
        body.dark-mode {
            background-color: var(--dark-bg) !important;
            color: var(--dark-text) !important;
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

        /* Forçar cores para a tabela no modo escuro - REFORÇADO */
        body.dark-mode .premium-table,
        body.dark-mode .table-card,
        body.dark-mode table.premium-table,
        body.dark-mode .table,
        body.dark-mode table.table,
        body.dark-mode .table-dark {
            background-color: var(--dark-surface) !important;
            color: var(--dark-text) !important;
            transition: background-color 0.3s ease, color 0.3s ease, border-color 0.3s ease;
        }

        /* Regras específicas para todos os tipos de tabela em modo escuro */
        body.dark-mode table,
        body.dark-mode .table,
        body.dark-mode table.table,
        body.dark-mode table.table-dark,
        body.dark-mode table.premium-table {
            --bs-table-bg: var(--dark-surface) !important;
            --bs-table-color: var(--dark-text) !important;
            --bs-table-border-color: var(--dark-border) !important;
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
            color: var(--light-text-secondary);
            margin-top: 0.5rem;
            max-width: 600px;
        }

        body.dark-mode .dashboard-subtitle {
            color: var(--dark-text-secondary);
        }

        /* Search card */
        .search-card {
            background: var(--light-bg);
            border-radius: var(--card-border-radius);
            box-shadow: var(--box-shadow-soft);
            margin-bottom: 2rem;
            padding: 2rem;
            transition: var(--transition-smooth);
            border: 1px solid var(--light-border);
        }

        body.dark-mode .search-card {
            background: var(--dark-surface);
            border-color: var(--dark-border);
        }

        .search-title {
            font-weight: 600;
            font-size: 1.25rem;
            margin-bottom: 1.5rem;
            color: var(--light-text);
            display: flex;
            align-items: center;
        }

        body.dark-mode .search-title {
            color: var(--dark-text);
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
            display: inline-flex;
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

        .btn-premium-danger {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            color: white;
        }

        .btn-premium-danger:hover {
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

        /* Tabela Premium */
        .table-card {
            background: var(--light-bg);
            border-radius: var(--card-border-radius);
            box-shadow: var(--box-shadow-soft);
            margin-bottom: 2rem;
            transition: var(--transition-smooth);
            border: 1px solid var(--light-border);
            overflow: hidden;
        }

        body.dark-mode .table-card {
            background: var(--dark-surface);
            border-color: var(--dark-border);
        }

        .premium-table {
            margin-bottom: 0;
            width: 100%;
        }

        /* Estilos específicos para tabelas */
        .premium-table,
        .table,
        .table-dark,
        table {
            background-color: var(--light-bg);
            color: var(--light-text);
        }

        .premium-table thead th,
        .table thead th,
        .table-dark thead th,
        table thead th {
            background: var(--light-surface);
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.05em;
            padding: 1rem;
            color: var(--light-text-secondary);
            border: none;
        }

        body.dark-mode .premium-table thead th,
        body.dark-mode .table thead th,
        body.dark-mode .table-dark thead th,
        body.dark-mode table thead th {
            background: var(--dark-surface-header) !important;
            color: var(--dark-text-secondary) !important;
        }

        .premium-table tbody td,
        .table tbody td,
        .table-dark tbody td,
        table tbody td {
            padding: 1rem;
            vertical-align: middle;
            border-bottom: 1px solid #f3f4f6;
            color: var(--light-text);
            background-color: var(--light-bg);
        }

        body.dark-mode .premium-table tbody td,
        body.dark-mode .table tbody td,
        body.dark-mode .table-dark tbody td,
        body.dark-mode table tbody td {
            border-color: var(--dark-border) !important;
            color: var(--dark-text) !important;
            background-color: var(--dark-surface) !important;
        }

        .premium-table tbody tr:last-child td {
            border-bottom: none;
        }

        .premium-table tbody tr,
        .table tbody tr,
        .table-dark tbody tr,
        table tbody tr {
            transition: var(--transition-smooth);
            background-color: var(--light-bg);
        }

        body.dark-mode .premium-table tbody tr,
        body.dark-mode .table tbody tr,
        body.dark-mode .table-dark tbody tr,
        body.dark-mode table tbody tr {
            background-color: var(--dark-surface) !important;
        }

        .premium-table tbody tr:hover,
        .table tbody tr:hover,
        .table-dark tbody tr:hover,
        table tbody tr:hover {
            background: rgba(249, 250, 251, 0.7);
        }

        body.dark-mode .premium-table tbody tr:hover,
        body.dark-mode .table tbody tr:hover,
        body.dark-mode .table-dark tbody tr:hover,
        body.dark-mode table tbody tr:hover {
            background: rgba(31, 41, 55, 0.7) !important;
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

        /* Paginação estilizada */
        .pagination-container {
            display: flex;
            justify-content: center;
            width: 100%;
            max-width: 1200px;
            margin-left: auto;
            margin-right: auto;
            margin-top: 2rem;
        }

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
            .dashboard-container {
                padding: 1rem 0;
            }

            .search-title {
                font-size: 1.1rem;
            }
        }

        /* Estilos adicionais para forçar o dark mode */
        body.dark-mode .premium-table,
        body.dark-mode .table,
        body.dark-mode .table-dark,
        body.dark-mode table {
            color: var(--dark-text) !important;
            background-color: var(--dark-surface) !important;
        }

        body.dark-mode .premium-table tbody td,
        body.dark-mode .table tbody td,
        body.dark-mode .table-dark tbody td,
        body.dark-mode table tbody td {
            border-color: var(--dark-border) !important;
            color: var(--dark-text) !important;
            background-color: var(--dark-surface) !important;
        }

        body.dark-mode .premium-table thead th,
        body.dark-mode .table thead th,
        body.dark-mode .table-dark thead th,
        body.dark-mode table thead th {
            background-color: var(--dark-surface-header) !important;
            color: var(--dark-text-secondary) !important;
            border-color: var(--dark-border) !important;
        }

        body.dark-mode .modal-content,
        body.dark-mode .modal-body,
        body.dark-mode .modal-footer {
            background-color: var(--dark-surface) !important;
            color: var(--dark-text) !important;
        }

        body.dark-mode .text-muted {
            color: var(--dark-text-secondary) !important;
        }

        /* Forçar escurecimento da tabela */
        body.dark-mode table tr,
        body.dark-mode table td,
        body.dark-mode table th,
        body.dark-mode .table tr,
        body.dark-mode .table td,
        body.dark-mode .table th,
        body.dark-mode .table-dark tr,
        body.dark-mode .table-dark td,
        body.dark-mode .table-dark th {
            background-color: var(--dark-surface) !important;
            color: var(--dark-text) !important;
        }

        /* Forçar escurecimento dos cabeçalhos da tabela */
        body.dark-mode table thead th,
        body.dark-mode .table thead th,
        body.dark-mode .table-dark thead th,
        body.dark-mode thead th {
            background-color: var(--dark-surface-header) !important;
            color: var(--dark-text-secondary) !important;
        }

        /* Para tabelas Bootstrap específicas */
        body.dark-mode .table-bordered,
        body.dark-mode .table-striped {
            --bs-table-bg: var(--dark-surface) !important;
            --bs-table-striped-bg: var(--dark-surface-header) !important;
            --bs-table-striped-color: var(--dark-text) !important;
            --bs-table-active-bg: #374151 !important;
            --bs-table-active-color: var(--dark-text) !important;
            --bs-table-hover-bg: #374151 !important;
            --bs-table-hover-color: var(--dark-text) !important;
            color: var(--dark-text) !important;
            border-color: var(--dark-border) !important;
        }

        /* Garantir que sobreescreve classes do Bootstrap */
        body.dark-mode .bg-light {
            background-color: var(--dark-surface) !important;
        }

        body.dark-mode .bg-dark {
            background-color: var(--dark-surface-header) !important;
        }

        body.dark-mode .text-light {
            color: var(--dark-text) !important;
        }

        body.dark-mode .border-secondary {
            border-color: var(--dark-border) !important;
        }

        /* Garanta que as transições sejam suaves */
        .dashboard-container *,
        .table-card,
        .premium-table,
        .search-card,
        .stat-card,
        .theme-toggle,
        .table,
        .table-dark,
        table,
        tr,
        td,
        th {
            transition: background-color 0.3s ease, color 0.3s ease, border-color 0.3s ease;
        }

        /* Estilo para deixar igual ao index com bordas luminosas */
        body {
            background-color: #1a1c23 !important;
            color: #e5e7eb !important;
        }

        .table-card {
            background-color: #1f2937 !important;
            border: 1px solid rgba(99, 102, 241, 0.1) !important;
            box-shadow: 0 0 20px rgba(79, 70, 229, 0.15) !important;
            border-radius: 16px !important;
            overflow: hidden !important;
        }

        .stats-card,
        .search-card {
            background-color: #1f2937 !important;
            border: 1px solid rgba(99, 102, 241, 0.1) !important;
            box-shadow: 0 0 20px rgba(79, 70, 229, 0.15) !important;
            border-radius: 16px !important;
        }

        .premium-table thead th {
            background-color: #252b38 !important;
            color: #9ca3af !important;
            border-bottom: 1px solid rgba(99, 102, 241, 0.2) !important;
        }

        .premium-table tbody tr {
            background-color: #1f2937 !important;
        }

        .premium-table tbody tr:hover {
            background-color: #252b38 !important;
        }

        .premium-table tbody td {
            border-bottom: 1px solid rgba(99, 102, 241, 0.1) !important;
            color: #e5e7eb !important;
        }

        /* Botões e Cards de estatísticas */
        .btn-premium,
        .theme-toggle {
            border-radius: 12px !important;
        }

        .action-icon-btn {
            background-color: #252b38 !important;
        }

        /* Forçar modo escuro para todas as tabelas e garantir que o efeito de borda seja consistente */
        table,
        .table,
        .table-dark,
        .premium-table {
            background-color: #1f2937 !important;
            color: #e5e7eb !important;
        }

        table tbody tr,
        .table tbody tr,
        .table-dark tbody tr,
        .premium-table tbody tr {
            background-color: #1f2937 !important;
        }

        table thead th,
        .table thead th,
        .table-dark thead th,
        .premium-table thead th {
            background-color: #252b38 !important;
        }

        .dashboard-container {
            background-color: #1a1c23 !important;
        }

        .container {
            background-color: transparent !important;
        }

        /* Melhorar a aparência de badges de status */
        .status-badge {
            background-color: rgba(99, 102, 241, 0.1) !important;
            border: 1px solid rgba(99, 102, 241, 0.2) !important;
        }

        .status-low {
            background-color: rgba(239, 68, 68, 0.1) !important;
            border: 1px solid rgba(239, 68, 68, 0.2) !important;
        }

        .status-medium {
            background-color: rgba(245, 158, 11, 0.1) !important;
            border: 1px solid rgba(245, 158, 11, 0.2) !important;
        }

        .status-high {
            background-color: rgba(16, 185, 129, 0.1) !important;
            border: 1px solid rgba(16, 185, 129, 0.2) !important;
        }

        /* Estilos para o modo claro quando ativado explicitamente */
        body:not(.dark-mode) {
            background-color: #f8f9fa !important;
            color: #212529 !important;
        }

        /* Quando NÃO está no modo escuro (modo claro) */
        body:not(.dark-mode) .table-card {
            background-color: #ffffff !important;
            border: 1px solid rgba(229, 231, 235, 0.5) !important;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.05) !important;
        }

        body:not(.dark-mode) .stats-card,
        body:not(.dark-mode) .search-card {
            background-color: #ffffff !important;
            border: 1px solid rgba(229, 231, 235, 0.5) !important;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.05) !important;
        }

        body:not(.dark-mode) .premium-table thead th,
        body:not(.dark-mode) table thead th,
        body:not(.dark-mode) .table thead th {
            background-color: #f9fafb !important;
            color: #6b7280 !important;
            border-bottom: 1px solid #e5e7eb !important;
        }

        body:not(.dark-mode) .premium-table tbody tr,
        body:not(.dark-mode) table tbody tr,
        body:not(.dark-mode) .table tbody tr {
            background-color: #ffffff !important;
        }

        body:not(.dark-mode) .premium-table tbody tr:hover,
        body:not(.dark-mode) table tbody tr:hover,
        body:not(.dark-mode) .table tbody tr:hover {
            background-color: #f9fafb !important;
        }

        body:not(.dark-mode) .premium-table tbody td,
        body:not(.dark-mode) table tbody td,
        body:not(.dark-mode) .table tbody td {
            border-bottom: 1px solid #e5e7eb !important;
            color: #374151 !important;
            background-color: #ffffff !important;
        }

        body:not(.dark-mode) .action-icon-btn {
            background-color: #f3f4f6 !important;
            color: #4b5563 !important;
        }

        body:not(.dark-mode) .action-icon-btn.edit-btn {
            background-color: rgba(99, 102, 241, 0.1) !important;
            color: #4f46e5 !important;
        }

        body:not(.dark-mode) .action-icon-btn.delete-btn {
            background-color: rgba(239, 68, 68, 0.1) !important;
            color: #ef4444 !important;
        }

        body:not(.dark-mode) .dashboard-container {
            background-color: #f8f9fa !important;
        }

        body:not(.dark-mode) .theme-toggle {
            background-color: #f3f4f6 !important;
            color: #4b5563 !important;
        }

        /* Corrigir badges de status no modo claro */
        body:not(.dark-mode) .status-badge {
            background-color: #f3f4f6 !important;
            border: 1px solid #e5e7eb !important;
            color: #4b5563 !important;
        }

        body:not(.dark-mode) .status-low {
            background-color: #fef2f2 !important;
            color: #ef4444 !important;
            border: 1px solid #fee2e2 !important;
        }

        body:not(.dark-mode) .status-medium {
            background-color: #fffbeb !important;
            color: #f59e0b !important;
            border: 1px solid #fef3c7 !important;
        }

        body:not(.dark-mode) .status-high {
            background-color: #f0fdf4 !important;
            color: #10b981 !important;
            border: 1px solid #dcfce7 !important;
        }

        /* Corrigir a barra de busca no modo claro */
        body:not(.dark-mode) .search-input {
            background-color: #ffffff !important;
            color: #374151 !important;
            border: 1px solid #e5e7eb !important;
        }

        /* Corrigir cabeçalhos e títulos no modo claro */
        body:not(.dark-mode) .dashboard-title {
            color: #111827 !important;
        }

        body:not(.dark-mode) .dashboard-subtitle {
            color: #6b7280 !important;
        }

        /* Forçar o fundo branco na tabela no modo claro */
        body:not(.dark-mode) table,
        body:not(.dark-mode) .table,
        body:not(.dark-mode) .premium-table {
            background-color: #ffffff !important;
            color: #374151 !important;
        }
    </style>


    <div class="dashboard-container">
        <div class="container">
            <!-- Header section -->
            <div class="dashboard-header animate-fade-up">
                <div class="dashboard-title-section">
                    <div>
                        <h1 class="dashboard-title">Estoque de Produtos</h1>
                        <p class="dashboard-subtitle">Gerencie o estoque de produtos disponíveis no sistema.</p>
                    </div>

                    <button id="toggleTheme" class="theme-toggle">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2">
                            <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path>
                        </svg>
                        <span id="dark-mode-text">Modo Claro</span>
                    </button>
                </div>
            </div>

            <!-- Barra de pesquisa -->
            <div class="search-card animate-fade-up">
                <div class="search-title">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2">
                        <circle cx="11" cy="11" r="8"></circle>
                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                    </svg>
                    Buscar Produtos
                </div>
                <form method="GET" action="{{ route('produtos.stock.index') }}" class="search-form">
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

            <!-- Actions bar -->
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
                    @php
                        $isStockPage = Route::currentRouteName() === 'produtos.stock.index';
                    @endphp

                    <a href="{{ $isStockPage ? route('produtos.index') : route('produtos.stock.index') }}"
                        class="btn-premium btn-premium-warning">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2">
                            @if($isStockPage)
                                <!-- Ícone para "Em Uso" -->
                                <path d="M4 21V8a3 3 0 0 1 3-3h5l2 3h7a3 3 0 0 1 3 3v5"></path>
                                <path d="M15 21h6"></path>
                                <path d="M18 18v6"></path>
                            @else
                                <!-- Ícone para "Estoque" -->
                                <path d="M20 12V8H6a2 2 0 0 1-2-2c0-1.1.9-2 2-2h12v4"></path>
                                <path d="M4 6v12c0 1.1.9 2 2 2h14v-4"></path>
                                <path d="M18 12a2 2 0 0 0-2 2c0 1.1.9 2 2 2h4v-4h-4z"></path>
                            @endif
                        </svg>
                        {{ $isStockPage ? 'Em Uso' : 'Estoque' }}
                    </a>
                </div>

                <div class="result-counter">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2">
                        <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                        <line x1="3" y1="9" x2="21" y2="9"></line>
                        <line x1="9" y1="21" x2="9" y2="9"></line>
                    </svg>
                    {{ count($produtos->where('status', 'estoque')) }} produtos em estoque
                </div>
            </div>

            <!-- Tabela de produtos -->
            <div class="table-card animate-fade-up">
                <div class="table-responsive">
                    <table class="table premium-table" id="productsTable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Produto</th>
                                <th>Marca</th>
                                <th>Quantidade</th>
                                <th>Setor</th>
                                <th>Descrição</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($produtos->where('status', 'estoque')) > 0)
                                @foreach($produtos as $produto)
                                    @if($produto->status == 'estoque')
                                        <tr>
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
                                                            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                                            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                                        </svg>
                                                    </a>
                                                    <form
                                                        action="{{ route('produtos.stock.destroy', ['id' => $produto->id, 'stock' => '1']) }}"
                                                        method="POST" style="display:inline;" class="form-delete">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="action-icon-btn delete-btn"
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
                                    @endif
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
                                            <h3 class="empty-state-title">Nenhum produto em estoque</h3>
                                            <p class="empty-state-text">Não foram encontrados produtos em estoque. Adicione um
                                                novo produto ou ajuste os filtros</p>
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

            <!-- Paginação -->
            <div class="pagination-container animate-fade-up">
                <ul class="pagination pagination-premium">
                    {{-- Link Anterior --}}
                    <li class="page-item {{ ($produtos->currentPage() == 1) ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $produtos->url($produtos->currentPage() - 1) }}"
                            aria-label="Previous">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2">
                                <polyline points="15 18 9 12 15 6"></polyline>
                            </svg>
                        </a>
                    </li>

                    {{-- Links de Página --}}
                    @for ($i = 1; $i <= $produtos->lastPage(); $i++)
                        <li class="page-item {{ ($produtos->currentPage() == $i) ? 'active' : '' }}">
                            <a class="page-link" href="{{ $produtos->url($i) }}">{{ $i }}</a>
                        </li>
                    @endfor

                    {{-- Link Próxima --}}
                    <li class="page-item {{ ($produtos->currentPage() == $produtos->lastPage()) ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $produtos->url($produtos->currentPage() + 1) }}" aria-label="Next">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2">
                                <polyline points="9 18 15 12 9 6"></polyline>
                            </svg>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Verificar a preferência de tema do usuário no localStorage
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

            // Funcionalidade de alternância de tema
            const toggleButton = document.getElementById('toggleTheme');
            if (toggleButton) {
                toggleButton.addEventListener('click', function () {
                    $('body').toggleClass('dark-mode');

                    const isDarkMode = $('body').hasClass('dark-mode');
                    $('#dark-mode-text').text(isDarkMode ? 'Modo Claro' : 'Modo Escuro');

                    // Salva preferência
                    localStorage.setItem('dark-mode', isDarkMode ? 'enabled' : 'disabled');

                    // Atualiza a aparência do SweetAlert se estiver presente
                    if (typeof Swal !== 'undefined') {
                        const container = Swal.getContainer();
                        if (container) {
                            if (isDarkMode) {
                                container.classList.add('swal2-dark');
                            } else {
                                container.classList.remove('swal2-dark');
                            }
                        }
                    }
                });
            }

            // Confirmação de exclusão
            const deleteButtons = document.querySelectorAll('.delete-btn');
            deleteButtons.forEach(button => {
                button.addEventListener('click', function (event) {
                    event.preventDefault();
                    const form = this.closest('form');

                    Swal.fire({
                        title: "Tem certeza?",
                        text: "Você não poderá reverter esta ação!",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#4f46e5",
                        cancelButtonColor: "#ef4444",
                        confirmButtonText: "Sim, deletar!",
                        cancelButtonText: "Cancelar",
                        background: $('body').hasClass('dark-mode') ? '#2a2a2a' : '#fff',
                        color: $('body').hasClass('dark-mode') ? '#e5e7eb' : '#374151',
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

            // Truncate tooltips para descrições
            const tooltips = document.querySelectorAll('.custom-tooltip');
            tooltips.forEach(tooltip => {
                const text = tooltip.getAttribute('data-tooltip');
                if (text && text.length > 40) {
                    tooltip.setAttribute('data-tooltip', text.substring(0, 100) + '...');
                }
            });
        });
    </script>
@endsection