<?php
    namespace App\Http\Controllers\Site;

use App\Models\Explorer;
use Illuminate\Http\Request;

    class SiteController{
        public function contact() {
            return view('site/contact');
        }

        public function explorers() {
            return view('site/explorer');
        }

        public function show(Explorer $explorer){
            //$support = new Support(); substitui pelo parametro acima
            $explorers = $explorer->all();
            // dd($supports);

            //compact('supports') => PEGA O CONTEUDO DA TABELA SUPPORT E JOGA NA VIEW
            return view('site/show', compact('explorers')/*['supports' => $supports]*/); //compact('supports') => PEGA O CONTEUDO DA TABELA SUPPORT E JOGA NA VIEW
        }

        public function create(){
            return view('site/explorer');
        }

        public function store(Request $request, Explorer $explorer){
            // dd($request->only(['subject', 'body']));
            // dd($request->get(['subject', 'body']));
            $data = $explorer->all();

            $explorer = $explorer->create($data);
            // dd($support);
            return redirect()->route('explorers.show');
        }
    }
