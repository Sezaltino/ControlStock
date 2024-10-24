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
            <input type="text" class="form-control" id="identificador" name="identificador" value="{{ $user->id }}" readonly>
        </div>
        <div class="form-group">
            <label for="name">Nome do Usuário</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="text" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
        </div>
        <div class="form-group">
            <label for="roles">Roles</label> <br>

            @foreach ($roles as $role)
                <input
                    type="checkbox"
                    id="role_{{$role->id}}"
                    name="roles[]"
                    value="{{$role->name}}"
                    @if($user->roles->contains($role->id)) checked @endif
                />
                <label for="role_{{$role->id}}">{{ $role->name }}</label><br/>
            @endforeach
        </div>
                    

        <button type="submit" class="btn btn-primary">Atualizar User</button>
    </form>
@endsection
