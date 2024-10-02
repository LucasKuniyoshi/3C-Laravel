<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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

    public function store(Request $request, Support $support){
        // dd($request->only(['subject', 'body']));
        // dd($request->get(['subject', 'body']));
        $data = $request->all();
        $data['status'] = 'a';

        $support = $support->create($data);
        // dd($support);
        return redirect()->route('supports.index');
    }
}
