@extends('layouts.app')

@section('content')
<div class="container-fluid p-4 bg-dark">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="text-light">Lista de Produtos</h1>
    </div>

    <div class="mb-4">
        <div class="input-group">
            <input type="text" class="form-control bg-dark text-light border-secondary" placeholder="Buscar por nome">
            <button class="btn btn-primary">Buscar</button>
        </div>
    </div>

    <div class="mb-4">
        <a href="{{ route('produtos.create') }}" class="btn btn-primary">Adicionar Produto</a>
        <a href="{{ route('produtos.index')}}" class="btn btn-warning ms-2">Em Uso</a>
    </div>

    <div class="table-responsive">
        <table class="table table-dark table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Marca</th>
                    <th>Quantidade</th>
                    <th>Setor</th>
                    <th>Descrição</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody class="bg-dark text-light">
                @foreach($produtos as $produto)
                    @if ($produto->identificador == null)
                    <tr>
                        <td>{{ $produto->identificador }}</td>
                        <td>{{ $produto->nome }}</td>
                        <td>{{ $produto->marca }}</td>
                        <td>{{ $produto->quantidade }}</td>
                        <td>{{ $produto->setor }}</td>
                        <td>{{ $produto->descricao }}</td>
                        <td>
                            <a href="{{ route('produtos.edit', $produto->id) }}" class="btn btn-warning btn-sm">Editar</a>
                            <form action="{{ route('produtos.stock.destroy', ['id' => $produto->id, 'stock' => '1']) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm delete-btn">Deletar</button>
                            </form>
                        </td>
                    </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>

    <nav aria-label="Page navigation">
        <ul class="pagination justify-content-center">
            <li class="page-item">
                <a class="page-link bg-dark text-light border-secondary" href="#" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
            <li class="page-item active"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link bg-dark text-light border-secondary" href="#">2</a></li>
            <li class="page-item">
                <a class="page-link bg-dark text-light border-secondary" href="#" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        </ul>
    </nav>
</div>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Force dark mode by default
        document.body.classList.add('dark-mode');
        localStorage.setItem('darkMode', 'true');
        
        // Theme toggle functionality
        const toggleButton = document.getElementById('toggleTheme');
        toggleButton.addEventListener('click', function() {
            document.body.classList.toggle('light-mode');
            document.body.classList.toggle('dark-mode');
            const isDarkMode = document.body.classList.contains('dark-mode');
            toggleButton.textContent = isDarkMode ? 'Alternar Modo Claro' : 'Alternar Modo Escuro';
            
            // Save preference
            localStorage.setItem('darkMode', isDarkMode);
        });
        
        // Delete confirmation
        const deleteButtons = document.querySelectorAll('.delete-btn');
        deleteButtons.forEach(button => {
            button.addEventListener('click', function(event) {
                event.preventDefault();
                const form = this.closest('form');

                Swal.fire({
                    title: "Tem certeza?",
                    text: "Você não poderá reverter esta ação!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Sim, deletar!",
                    cancelButtonText: "Cancelar",
                    background: '#333',
                    color: '#fff'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: "Deletado!",
                            text: "O produto foi deletado.",
                            icon: "success",
                            background: '#333',
                            color: '#fff'
                        }).then(() => {
                            form.submit();
                        });
                    }
                });
            });
        });
    });
</script>

<style>
    body {
        background-color: #212529 !important;
        color: #f8f9fa !important;
    }
    
    /* Dark mode (default) */
    .dark-mode {
        background-color: #212529 !important;
        color: #f8f9fa !important;
    }
    
    .dark-mode .table {
        background-color: #212529 !important;
        color: #f8f9fa !important;
        border-color: #495057 !important;
    }
    
    .dark-mode .table-dark {
        background-color: #212529 !important;
    }
    
    .dark-mode .table td, 
    .dark-mode .table th {
        border-color: #495057 !important;
    }
    
    /* Light mode (optional) */
    .light-mode {
        background-color: #f8f9fa !important;
        color: #212529 !important;
    }
    
    .light-mode .table {
        background-color: #fff !important;
        color: #212529 !important;
    }
    
    .light-mode .table-dark {
        background-color: #fff !important;
        color: #212529 !important;
    }
    
    .light-mode .bg-dark {
        background-color: #f8f9fa !important;
        color: #212529 !important;
    }
    
    .light-mode .text-light {
        color: #212529 !important;
    }
    
    .light-mode .border-secondary {
        border-color: #ced4da !important;
    }
    
    .light-mode .btn-outline-light {
        color: #212529 !important;
        border-color: #212529 !important;
    }
    
    /* Fix for Bootstrap overrides */
    .table-dark {
        --bs-table-bg: #212529 !important;
    }
    
    .table-dark td,
    .table-dark th,
    .table-dark thead th {
        border-color: #495057 !important;
    }
    
    /* Added !important to all styles to ensure they override any defaults */
</style>
@endsection
