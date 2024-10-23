@extends('layouts.app')

@section('content')
    <h1>Editar Produto</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label for="identificador">Identificador</label>
            <input type="text" class="form-control" id="identificador" name="identificador" value="{{ $user->id }}">
        </div>
        <div class="form-group">
            <label for="nome">Nome do Usuário</label>
            <input type="text" class="form-control" id="nome" name="nome" value="{{ $user->nome }}" required>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="text" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
        </div>

        <div class="form-group">
            <label for="role">Role</label>
            <select type="select" class="form-control" id="role" name="role">
                @foreach ($user->roles as $role)
                    <option value="{{ $role->name }}">{{ $role->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Atualizar User</button>
    </form>
@endsection
