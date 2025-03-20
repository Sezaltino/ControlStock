@extends('layouts.app')

@section('content')
    <h1>Adicionar Produto</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('produtos.store') }}" method="POST">
        @csrf
     
        <div class="form-group">
            <label for="identificador">Identificador</label>
            <input type="text" class="form-control" id="identificador" name="identificador" value="{{ old('identificador') }}">
        </div>

        <div class="form-group">
            <label for="nome">Nome do Produtos</label>
            <input type="text" class="form-control" id="nome" name="nome" value="{{ old('nome') }}" required>
        </div>

        <div class="form-group">
            <label for="marca">Marca</label>
            <input type="text" class="form-control" id="marca" name="marca" value="{{ old('marca') }}" required>
        </div>

        <div class="form-group">
            <label for="quantidade">Quantidade</label>
            <input type="number" class="form-control" id="quantidade" name="quantidade" value="{{ old('quantidade') }}" required min="0">
        </div>

        <div class="form-group">
            <label for="setor">Setor</label>
            <input type="text" class="form-control" id="setor" name="setor" value="{{ old('setor') }}">
        </div>

        <div class="form-group">
            <label for="descricao">Descrição</label>
            <input type="text" class="form-control" id="descricao" name="descricao" value="{{ old('descricao') }}" required>
        </div>
        
        <button type="submit" class="btn btn-success mt-5">Adicionar Produto</button>
    </form>
@endsection
