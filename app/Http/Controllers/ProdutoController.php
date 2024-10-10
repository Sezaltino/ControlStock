<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $produtos = Produto::all();
        return view('produtos.index', compact('produtos'));
    }

    public function stock()
    {
        $produtos = Produto::all();
        return view('produtos.stock', compact('produtos'));
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
        ]);

        $ids = Produto::pluck('identificador')->toArray();
        $idProduct = $request->identificador;

        if (in_array($idProduct, $ids)) {
            return redirect()->route('produtos.index')->with('fail', 'Identificador já existente!'); 
        }
        else {
            Produto::create([
                'nome' => $request->nome,
                'quantidade' => $request->quantidade,
                'identificador' => $request->identificador,
                'marca' => $request->marca,
                'setor' => $request->setor,
                'descricao' => $request->descricao,
            ]);
    
            return redirect()->route('produtos.index')->with('success', 'Produto cadastrado com sucesso!');
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
            return redirect()->route('produtos.stock')->with('success', 'Produto removido com sucesso!');
        }
        else {
            return redirect()->route('produtos.index')->with('success', 'Produto removido com sucesso!');
        }
    }
}
