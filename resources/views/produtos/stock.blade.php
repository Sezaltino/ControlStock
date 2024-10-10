@extends('layout')

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
                        <form action="{{ route('produtos.destroy', ['id' => $produto->id, 'stock' => '1']) }}" method="POST" style="display:inline;" onsubmit="return confirm('Tem certeza que deseja remover este produto?');">                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Deletar</button>
                        </form>
                    </td>
                </tr>
                @endif
            @endforeach
        </tbody>
    </table>
@endsection
