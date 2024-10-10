@extends('layout')

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

    <form action="{{ route('produtos.update', $produto->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label for="identificador">Identificador</label>
            <input type="text" class="form-control" id="identificador" name="identificador" value="{{ $produto->identificador }}">
        </div>
        <div class="form-group">
            <label for="nome">Nome do Produto</label>
            <input type="text" class="form-control" id="nome" name="nome" value="{{ $produto->nome }}" required>
        </div>

        <div class="form-group">
            <label for="marca">Marca</label>
            <input type="text" class="form-control" id="marca" name="marca" value="{{ $produto->marca }}" required>
        </div>

        <div class="form-group">
            <label for="quantidade">Quantidade</label>
            <input type="number" class="form-control" id="quantidade" name="quantidade" value="{{ $produto->quantidade }}" required min="0">
        </div>

        <div class="form-group">
            <label for="setor">Setor</label>
            <input type="text" class="form-control" id="setor" name="setor" value="{{ $produto->setor }}">
        </div>

        <div class="form-group">
            <label for="descricao">Descrição</label>
            <input type="text" class="form-control" id="descricao" name="descricao" value="{{ $produto->descricao }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Atualizar Produto</button>
    </form>
@endsection
