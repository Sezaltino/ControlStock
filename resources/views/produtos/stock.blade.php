@extends('layouts.app')

@section('content')


    <h1>Lista de Produtos</h1>
    <a href="{{ route('produtos.create') }}" class="btn btn-primary">Adicionar Produto</a>
    <a href="{{ route('produtos.index')}}" class="btn btn-warning">Em Uso</a>
    <table class="table">
        <thead>
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
        <tbody>
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
                        <a href="{{ route('produtos.edit', $produto->id) }}" class="btn btn-warning">Editar</a>
                        <form action="{{ route('produtos.stock.destroy', ['id' => $produto->id, 'stock' => '1']) }}" method="POST" style="display:inline;" onsubmit="return confirm('Tem certeza que deseja remover este produto?');">                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Deletar</button>
                        </form>
                    </td>
                </tr>
                @endif
            @endforeach
        </tbody>
    </table>
        <!-- Script SweetAlert para confirmação -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const deleteButtons = document.querySelectorAll('.btn-danger');
            deleteButtons.forEach(button => {
                button.addEventListener('click', function(event) {
                    event.preventDefault(); // Impede o envio imediato do formulário
                    const form = this.closest('form');

                    Swal.fire({
                        title: "Tem certeza?",
                        text: "Você não poderá reverter esta ação!",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Sim, deletar!",
                        cancelButtonText: "Cancelar"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            Swal.fire({
                                title: "Deletado!",
                                text: "O produto foi deletado.",
                                icon: "success"
                            }).then(() => {
                                form.submit(); // Submete o formulário após a confirmação
                            });
                        }
                    });
                });
            });
        });
    </script>
@endsection
