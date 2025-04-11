@extends('layouts.app')

@section('content')
<style>
    /* Estilos específicos para a página de edição de produtos */
    .produto-card {
        background: #fff;
        border-radius: 10px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        margin-bottom: 2rem;
        transition: all 0.3s;
    }
    
    body.dark-mode .produto-card {
        background: #242424;
    }
    
    .produto-header {
        position: relative;
        padding: 1.5rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 1px solid #e5e7eb;
        background: linear-gradient(90deg, rgba(99, 102, 241, 0.1) 0%, transparent 100%);
    }
    
    body.dark-mode .produto-header {
        border-bottom: 1px solid #444;
        background: linear-gradient(90deg, rgba(129, 140, 248, 0.1) 0%, transparent 100%);
    }
    
    .produto-title {
        margin: 0;
        font-size: 1.75rem;
        font-weight: 700;
        display: flex;
        flex-direction: column;
    }
    
    .produto-subtitle {
        font-size: 0.925rem;
        color: #6b7280;
        margin-top: 0.25rem;
        font-weight: 400;
    }
    
    body.dark-mode .produto-subtitle {
        color: #aaa;
    }
    
    .produto-body {
        padding: 1.5rem;
    }
    
    .produto-form-grid {
        display: grid;
        grid-template-columns: repeat(12, 1fr);
        gap: 1.5rem;
    }
    
    .form-group {
        display: flex;
        flex-direction: column;
        margin-bottom: 0;
        position: relative;
    }
    
    .form-group-sm {
        grid-column: span 4;
    }
    
    .form-group-md {
        grid-column: span 6;
    }
    
    .form-group-lg {
        grid-column: span 8;
    }
    
    .form-group-full {
        grid-column: span 12;
    }
    
    .form-label {
        font-size: 0.875rem;
        font-weight: 500;
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
    }
    
    .form-label svg {
        margin-right: 0.5rem;
        opacity: 0.7;
    }
    
    .form-group:focus-within .form-label svg {
        opacity: 1;
        color: #6366f1;
    }
    
    body.dark-mode .form-group:focus-within .form-label svg {
        color: #818cf8;
    }
    
    .required-field::after {
        content: "*";
        color: #ef4444;
        margin-left: 0.25rem;
    }
    
    /* Indicador de quantidade */
    .quantity-indicator {
        display: flex;
        align-items: center;
        font-size: 0.8rem;
        margin-top: 0.5rem;
        font-weight: 500;
    }
    
    .quantity-indicator::before {
        content: "";
        display: inline-block;
        width: 8px;
        height: 8px;
        border-radius: 50%;
        margin-right: 0.5rem;
    }
    
    .quantity-high::before {
        background-color: #10b981;
    }
    
    .quantity-medium::before {
        background-color: #f59e0b;
    }
    
    .quantity-low::before {
        background-color: #ef4444;
    }
    
    /* Box de informações */
    .info-box {
        background-color: #e0e7ff;
        border-radius: 0.5rem;
        padding: 1rem;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
    }
    
    body.dark-mode .info-box {
        background-color: #312e81;
    }
    
    .info-box-icon {
        margin-right: 1rem;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 40px;
        background-color: #6366f1;
        color: white;
        border-radius: 50%;
    }
    
    body.dark-mode .info-box-icon {
        background-color: #818cf8;
    }
    
    .info-box-content {
        flex-grow: 1;
    }
    
    .info-box-title {
        font-weight: 600;
        color: #4f46e5;
        margin: 0 0 0.25rem 0;
    }
    
    body.dark-mode .info-box-title {
        color: #818cf8;
    }
    
    .info-box-text {
        margin: 0;
        font-size: 0.9rem;
    }
    
    /* Setor tag */
    .setor-tag {
        display: inline-flex;
        align-items: center;
        background-color: #e0e7ff;
        color: #4f46e5;
        padding: 0.25rem 0.75rem;
        border-radius: 50px;
        font-size: 0.8rem;
        font-weight: 500;
        margin-top: 0.5rem;
    }
    
    body.dark-mode .setor-tag {
        background-color: #312e81;
        color: #818cf8;
    }
    
    /* Barra de progresso para campos */
    .form-progress-bar {
        height: 3px;
        background-color: #e5e7eb;
        border-radius: 3px;
        overflow: hidden;
        margin-top: 0.25rem;
    }
    
    body.dark-mode .form-progress-bar {
        background-color: #444;
    }
    
    .form-progress-value {
        height: 100%;
        background-color: #6366f1;
        transition: width 0.25s;
    }
    
    body.dark-mode .form-progress-value {
        background-color: #818cf8;
    }
    
    /* Responsividade */
    @media (max-width: 992px) {
        .form-group-sm, .form-group-md, .form-group-lg {
            grid-column: span 6;
        }
    }
    
    @media (max-width: 768px) {
        .form-group-sm, .form-group-md, .form-group-lg {
            grid-column: span 12;
        }
    }
    
    /* Animação para o card */
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .produto-card {
        animation: fadeIn 0.5s ease-out forwards;
    }
    
    /* Botão dark mode */
    .toggle-dark-mode-btn {
        display: flex;
        align-items: center;
        padding: 0.5rem 1rem;
        border-radius: 8px;
        border: 1px solid #e5e7eb;
        background-color: #f9fafb;
        color: #374151;
        font-size: 0.875rem;
        transition: all 0.2s;
        cursor: pointer;
    }
    
    body.dark-mode .toggle-dark-mode-btn {
        border-color: #444;
        background-color: #333;
        color: #e0e0e0;
    }
    
    .toggle-dark-mode-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    }
    
    body.dark-mode .toggle-dark-mode-btn:hover {
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.3);
    }
</style>

<div class="produto-card">
    <div class="produto-header">
        <div class="produto-title">
            Editar Produto
            <span class="produto-subtitle">Atualize as informações do produto no sistema</span>
        </div>
        
        <button class="toggle-dark-mode-btn" id="toggle-dark-mode" type="button">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="margin-right: 8px;">
                <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path>
            </svg>
            <span id="dark-mode-text">Alternar Modo Escuro</span>
        </button>
    </div>

    <div class="produto-body">
        @if ($errors->any())
            <div class="alert alert-danger">
                <div style="font-weight: 600; margin-bottom: 10px; display: flex; align-items: center;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="margin-right: 8px;">
                        <circle cx="12" cy="12" r="10"></circle>
                        <line x1="12" y1="8" x2="12" y2="12"></line>
                        <line x1="12" y1="16" x2="12.01" y2="16"></line>
                    </svg>
                    Atenção! Ocorreram erros ao processar o formulário
                </div>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        <div class="info-box">
            <div class="info-box-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="12" cy="12" r="10"></circle>
                    <line x1="12" y1="16" x2="12" y2="12"></line>
                    <line x1="12" y1="8" x2="12.01" y2="8"></line>
                </svg>
            </div>
            <div class="info-box-content">
                <div class="info-box-title">Informações do Produto</div>
                <div class="info-box-text">Campos marcados com <span style="color: #ef4444;">*</span> são obrigatórios.</div>
            </div>
        </div>
        
        <form action="{{ route('produtos.update', $produto->id) }}" method="POST" id="produtoForm">
            @csrf
            @method('PUT')
            
            <div class="produto-form-grid">
                <div class="form-group form-group-md">
                    <label for="identificador" class="form-label">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M4 7V4h16v3"></path>
                            <path d="M9 20h6"></path>
                            <path d="M12 4v16"></path>
                        </svg>
                        Identificador
                    </label>
                    <input type="text" class="form-control" id="identificador" name="identificador" value="{{ $produto->identificador }}" placeholder="Ex: PROD-001">
                </div>
                
                <div class="form-group form-group-md">
                    <label for="nome" class="form-label required-field">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"></path>
                            <line x1="7" y1="7" x2="7.01" y2="7"></line>
                        </svg>
                        Nome do Produto
                    </label>
                    <input type="text" class="form-control" id="nome" name="nome" value="{{ $produto->nome }}" required placeholder="Digite o nome do produto">
                    <div class="form-progress-bar">
                        <div class="form-progress-value" id="nomeProgress" style="width: 0%"></div>
                    </div>
                </div>
                
                <div class="form-group form-group-md">
                    <label for="marca" class="form-label required-field">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M20.24 12.24a6 6 0 0 0-8.49-8.49L5 10.5V19h8.5z"></path>
                            <line x1="16" y1="8" x2="2" y2="22"></line>
                            <line x1="17.5" y1="15" x2="9" y2="15"></line>
                        </svg>
                        Marca
                    </label>
                    <input type="text" class="form-control" id="marca" name="marca" value="{{ $produto->marca }}" required placeholder="Digite a marca do produto">
                </div>
                
                <div class="form-group form-group-sm">
                    <label for="quantidade" class="form-label required-field">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <polyline points="6 9 12 15 18 9"></polyline>
                        </svg>
                        Quantidade
                    </label>
                    <input type="number" class="form-control" id="quantidade" name="quantidade" value="{{ $produto->quantidade }}" required min="0" placeholder="0">
                    <div class="quantity-indicator {{ $produto->quantidade > 50 ? 'quantity-high' : ($produto->quantidade > 10 ? 'quantity-medium' : 'quantity-low') }}" id="quantityIndicator">
                        {{ $produto->quantidade > 50 ? 'Estoque Alto' : ($produto->quantidade > 10 ? 'Estoque Médio' : 'Estoque Baixo') }}
                    </div>
                </div>
                
                <div class="form-group form-group-sm">
                    <label for="setor" class="form-label">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"></path>
                        </svg>
                        Setor
                    </label>
                    <input type="text" class="form-control" id="setor" name="setor" value="{{ $produto->setor }}" placeholder="Digite o setor do produto">
                    @if($produto->setor)
                    <div class="setor-tag">{{ $produto->setor }}</div>
                    @endif
                </div>
                
                <div class="form-group form-group-full">
                    <label for="descricao" class="form-label required-field">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <line x1="21" y1="10" x2="3" y2="10"></line>
                            <line x1="21" y1="6" x2="3" y2="6"></line>
                            <line x1="21" y1="14" x2="3" y2="14"></line>
                            <line x1="21" y1="18" x2="3" y2="18"></line>
                        </svg>
                        Descrição
                    </label>
                    <textarea class="form-control" id="descricao" name="descricao" required placeholder="Descreva detalhes importantes do produto" rows="4">{{ $produto->descricao }}</textarea>
                    <div class="form-progress-bar">
                        <div class="form-progress-value" id="descricaoProgress" style="width: 0%"></div>
                    </div>
                </div>
            </div>
            
            <div class="d-flex justify-content-end mt-4 gap-2">
                <a href="{{ route('produtos.index') }}" class="btn btn-secondary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="margin-right: 5px;">
                        <path d="M19 12H5"></path>
                        <polyline points="12 19 5 12 12 5"></polyline>
                    </svg>
                    Cancelar
                </a>
                <button type="submit" class="btn btn-primary" id="submitBtn">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="margin-right: 5px;">
                        <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path>
                        <polyline points="17 21 17 13 7 13 7 21"></polyline>
                    </svg>
                    Atualizar Produto
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    $(document).ready(function() {
        // Funções para campos de formulário
        const nomeInput = document.getElementById('nome');
        const nomeProgress = document.getElementById('nomeProgress');
        const descricaoInput = document.getElementById('descricao');
        const descricaoProgress = document.getElementById('descricaoProgress');
        const quantidadeInput = document.getElementById('quantidade');
        const quantityIndicator = document.getElementById('quantityIndicator');
        
        // Atualizar barras de progresso
        function updateProgressBar(input, progressBar, minLength = 3, maxLength = 50) {
            const value = input.value.length;
            const percentage = Math.min(Math.max(value / maxLength * 100, 0), 100);
            progressBar.style.width = percentage + '%';
            
            if (value < minLength) {
                progressBar.style.backgroundColor = '#ef4444';
            } else if (value < minLength * 2) {
                progressBar.style.backgroundColor = '#f59e0b';
            } else {
                progressBar.style.backgroundColor = '#10b981';
            }
            
            if ($('body').hasClass('dark-mode')) {
                if (value < minLength) {
                    progressBar.style.backgroundColor = '#f87171';
                } else if (value < minLength * 2) {
                    progressBar.style.backgroundColor = '#fbbf24';
                } else {
                    progressBar.style.backgroundColor = '#34d399';
                }
            }
        }
        
        // Atualizar indicador de quantidade
        function updateQuantityIndicator() {
            const value = parseInt(quantidadeInput.value) || 0;
            quantityIndicator.classList.remove('quantity-high', 'quantity-medium', 'quantity-low');
            
            if (value > 50) {
                quantityIndicator.classList.add('quantity-high');
                quantityIndicator.textContent = 'Estoque Alto';
            } else if (value > 10) {
                quantityIndicator.classList.add('quantity-medium');
                quantityIndicator.textContent = 'Estoque Médio';
            } else {
                quantityIndicator.classList.add('quantity-low');
                quantityIndicator.textContent = 'Estoque Baixo';
            }
        }
        
        // Eventos para inputs
        if (nomeInput && nomeProgress) {
            updateProgressBar(nomeInput, nomeProgress);
            nomeInput.addEventListener('input', function() {
                updateProgressBar(nomeInput, nomeProgress);
            });
        }
        
        if (descricaoInput && descricaoProgress) {
            updateProgressBar(descricaoInput, descricaoProgress, 10, 200);
            descricaoInput.addEventListener('input', function() {
                updateProgressBar(descricaoInput, descricaoProgress, 10, 200);
            });
        }
        
        if (quantidadeInput && quantityIndicator) {
            updateQuantityIndicator();
            quantidadeInput.addEventListener('input', updateQuantityIndicator);
        }
        
        // Animação no envio do formulário
        const form = document.getElementById('produtoForm');
        const submitBtn = document.getElementById('submitBtn');
        
        if (form && submitBtn) {
            form.addEventListener('submit', function(e) {
                const originalText = submitBtn.innerHTML;
                submitBtn.innerHTML = '<div class="spinner-border spinner-border-sm me-2" role="status"><span class="visually-hidden">Carregando...</span></div> Processando...';
                submitBtn.disabled = true;
                
                // Re-habilitar o botão após 10 segundos caso o formulário não seja enviado
                setTimeout(function() {
                    if (submitBtn.disabled) {
                        submitBtn.innerHTML = originalText;
                        submitBtn.disabled = false;
                    }
                }, 10000);
            });
        }
    });
</script>
@endsection