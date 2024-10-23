@extends('layouts.app')

@section('content')

    <h1>Usuarios</h1>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Criado em</th>
                <th>Atualizado em</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)         
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->created_at }}</td>
                    <td>{{ $user->updated_at }}</td>
                    <td>{{ $user->roles[0]->name}}</td>
                    <td>
                        <a href="{{ route('users.edit', $users[0]->id) }}" class="btn btn-warning">Editar</a>
                        
                        <!-- Formulário de exclusão -->
                        <form action="{{ route('users.destroy', $users[0]->id) }}" method="POST" style="display:inline;" class="form-delete">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-danger btn-delete">Deletar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Script SweetAlert para confirmação -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const deleteButtons = document.querySelectorAll('.btn-delete');
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
