<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use App\Models\User;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        // Consulta base para produtos em uso (para a listagem)
        $query = Produto::query();

        // Filtrar por status 'em_uso' para a listagem
        $query->where('status', 'em_uso');

        // Aplicar filtro de busca se fornecido
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('nome', 'like', "%{$search}%")
                    ->orWhere('marca', 'like', "%{$search}%")
                    ->orWhere('identificador', 'like', "%{$search}%");
            });
        }

        // Estatísticas - Separadas da consulta principal
        $totalProdutos = Produto::count(); // Total de todos os produtos

        // Total de itens em estoque (tanto produtos "em_uso" quanto produtos "estoque")
        $totalEstoque = Produto::sum('quantidade');

        // Produtos com estoque baixo (<=10)
        $lowStock = Produto::where('quantidade', '<=', 10)->count();

        // Paginação dos produtos em uso para exibição
        $produtos = $query->paginate(8)->onEachSide(1)->appends(request()->query());

        // Passar ambos os dados paginados e estatísticas totais para a view
        return view('produtos.index', compact('produtos', 'totalProdutos', 'totalEstoque', 'lowStock'));
    }
    /**
     * Display the stock view based on the user's role.
     */
    public function stock(Request $request)
    {
        $search = $request->input('search');

        // Consulta base
        $query = Produto::query();

        // Filtrar por status 'estoque'
        $query->where('status', 'estoque');

        // Aplicar filtro de busca se fornecido
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('nome', 'like', "%{$search}%")
                    ->orWhere('marca', 'like', "%{$search}%")
                    ->orWhere('identificador', 'like', "%{$search}%");
            });
        }

        // Paginação
        $produtos = $query->paginate(8)->onEachSide(1)->appends(request()->query());

        $user = User::find(auth()->user()->id);

        if ($user->hasRole('admin') || $user->hasRole('t.i') || $user->hasRole('diretoria')) {
            return view('produtos.stock', compact('produtos'));
        } else {
            return redirect()->route('produtos.index');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('produtos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'quantidade' => 'required|integer|min:0',
            'identificador' => 'nullable|string|max:50',
            'marca' => 'required|string|max:50',
            'setor' => 'nullable|string|max:50',
            'descricao' => 'required|string|max:255',
            'status' => 'required|string|in:estoque,em_uso',
        ]);

        $ids = Produto::pluck('identificador')->toArray();
        $idProduct = $request->identificador;

        if (in_array($idProduct, $ids) && $idProduct != null) {
            return redirect()->route('produtos.index')->with('fail', 'Identificador já existente!');
        } else {
            // Criar o produto incluindo o campo status
            $produto = Produto::create([
                'nome' => $request->nome,
                'quantidade' => $request->quantidade,
                'identificador' => $request->identificador,
                'marca' => $request->marca,
                'setor' => $request->setor,
                'descricao' => $request->descricao,
                'status' => $request->status, // Adicionado o campo status
            ]);

            // Redirecionar com base no status
            if ($request->status == 'estoque') {
                return redirect()->route('produtos.stock.index')->with('success', 'Produto adicionado ao estoque com sucesso!');
            } else {
                return redirect()->route('produtos.index')->with('success', 'Produto adicionado em uso com sucesso!');
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $produto = Produto::findOrFail($id);
        return view('produtos.edit', compact('produto'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'quantidade' => 'required|integer|min:0',
            'identificador' => 'nullable|string|max:50',
            'marca' => 'required|string|max:50',
            'setor' => 'nullable|string|max:50',
            'descricao' => 'required|string|max:255',
        ]);

        $produto = Produto::findOrFail($id);

        $produto->update([
            'nome' => $request->nome,
            'quantidade' => $request->quantidade,
            'identificador' => $request->identificador,
            'marca' => $request->marca,
            'setor' => $request->setor,
            'descricao' => $request->descricao,
        ]);

        return redirect()->route('produtos.index')->with('success', 'Produto atualizado com sucesso!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id, $stock)
    {
        // Busca o produto pelo ID
        $produto = Produto::findOrFail($id);

        // Deleta o produto
        $produto->delete();

        // Redireciona de volta com uma mensagem de sucesso
        if ($stock == '1') {
            return redirect()->route('produtos.stock.index')->with('success', 'Produto removido com sucesso!');
        } else {
            return redirect()->route('produtos.index')->with('success', 'Produto removido com sucesso!');
        }
    }

    protected function authenticated(Request $request, $user)
    {
        return redirect('/dashboard');
    }

    public function addToStock(Request $request, $id)
    {
        $produto = Produto::findOrFail($id);
        $produto->identificador = 'ESTQ-' . $id; // ou outro valor que faça sentido
        $produto->save();

        return redirect()->route('produtos.stock.index');
    }
    public function markAsInUse(Request $request, $id)
    {
        $produto = Produto::findOrFail($id);
        $produto->identificador = null;
        $produto->save();

        return redirect()->route('produtos.index');
    }
}
