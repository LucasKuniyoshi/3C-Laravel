<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateSupport;
use App\Models\Support;
use Illuminate\Http\Request;

class SupportController extends Controller
{
    public function index(Support $support){
        //$support = new Support(); substitui pelo parametro acima
        $supports = $support->all();
        // dd($supports);

        //compact('supports') => PEGA O CONTEUDO DA TABELA SUPPORT E JOGA NA VIEW
        return view('admin/supports/index', compact('supports')/*['supports' => $supports]*/); //compact('supports') => PEGA O CONTEUDO DA TABELA SUPPORT E JOGA NA VIEW
    }

    public function create(){
        return view('admin/supports/create');
    }

    public function store(StoreUpdateSupport $request, Support $support){
        // dd($request->only(['subject', 'body']));
        // dd($request->get(['subject', 'body']));
        $data = $request->all();
        $data['status'] = 'a';

        $support = $support->create($data);
        // dd($support);
        return redirect()->route('supports.index');
    }

    public function show(string|int $id){
        //SE O ID UTILIZADO N EXISTIR
        //No lugar do find => where('id',$id)->first
        //where campo 'id' = parametro $id

        //Pode ser também => where('id','!=', $id)->first
        if(!$support = Support::find($id)){
            return back();
        };
        return view('admin/supports/show', compact('support'));
    }

    public function edit(Support $support, string|int $id){
        //FAZ A MESMA COISA Q O FIND
        if(!$support = $support->where('id', $id)->first()){
            return back();
        };
        return view('admin/supports/edit', compact('support'));
    }

    public function update(StoreUpdateSupport $request, Support $support, string $id){
        if(!$support = $support->find($id)){
            return back();
        };
     /* $support->subject = $request->subject;
        $support->body = $request->body;
        $support->save(); */ //FAZ A MESMA COISA Q O UPDATE ABAIXO
        $support->update($request->validated());
        return redirect()->route('supports.index');
    }

    public function destroy(string|int $id){
        // if(!$support = Support::find($id)->delete()){
        //     return back();
        // };
        if(!$support = Support::find($id)){
            return back();
        }
        $support->delete();

        return redirect()->route('supports.index');
    }
}
