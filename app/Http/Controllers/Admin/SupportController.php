<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateSupports;
use App\Models\Support;
use Illuminate\Http\Request;

class SupportController extends Controller
{
    public function index(Support $support)
    {

        // $support = new Support();
        $supports = $support->all();

        $xss = '<script>alert("sou um hacker");</script>';
        return view('admin/supports/index', compact('supports', 'xss'));
    }

    public function show($id)
    {
        // Support::find($id);
        // Support::where('id', $id)->first()
        // Support::where('id','=', $id)->first()
        if(!$support = Support::find($id)){
            return back();
        }
        return view('admin/supports/show', compact('support'));
        // dd($support->subject);
    }


    public function create()
    {
        return view('admin/supports/create');
    }


    // public function store(Request $request, Support $support)
    // Para validar retorna o requesto support de validação
    public function store(StoreUpdateSupports $request, Support $support)
    {

        // dd($request->only(['body']));
        // pega apenas um valor específico pode ser array com os campos
        // ou chamar direto $request->body
        // $data = $request->all();
        //muda para pegar só os dados validados
        $data = $request->validated();
        $data['status'] = 'a';
        $support->create($data);


        return redirect()->route('supports.index')
                         ->with('message', 'Cadastrado com sucesso!');
    }

    public function edit(Support $support, string $id)
    {
        if(!$support = $support->where('id', $id)->first()){
            return back();
        };

        return view('admin/supports.edit', compact('support'));

    }

    public function update(Request $request, Support $support, string $id)
    {

        if(!$support = $support->find($id)){
            return back();
        }

        // $support->subject = $request->subject;
        // $support->body = $request->body;
        // $support->save();

        // $support->update($request->only(['subject','body']));
        //pegar apenas os dados validados
        $support->update($request->validated());

        return redirect()->route('supports.index');
    }

    public function destroy(string $id)
    {
        if(!$support = Support::find($id)){
            return back();
        }
        $support->delete();

        return redirect()->route('supports.index');
    }
}
