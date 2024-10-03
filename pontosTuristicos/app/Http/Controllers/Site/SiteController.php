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
            //$explorer = new explorer(); substitui pelo parametro acima
            $explorers = $explorer->all();
            // dd($explorers);

            //compact('explorers') => PEGA O CONTEUDO DA TABELA explorer E JOGA NA VIEW
            return view('site/show', compact('explorers')/*['explorers' => $explorers]*/); //compact('explorers') => PEGA O CONTEUDO DA TABELA explorer E JOGA NA VIEW
        }

        public function create(){
            return view('site/explorer');
        }

        public function store(Request $request, Explorer $explorer){
            // dd($request->only(['subject', 'body']));
            // dd($request->get(['subject', 'body']));
            $data = $request->all();
            //$data['status'] = 'a';

            $explorer = $explorer->create($data);
            // dd($explorer);
            return redirect()->route('explorers.show');
        }
        public function details(string|int $id){
            //SE O ID UTILIZADO N EXISTIR
            //No lugar do find => where('id',$id)->first
            //where campo 'id' = parametro $id

            //Pode ser também => where('id','!=', $id)->first
            if(!$explorer = Explorer::find($id)){
                return back();
            };
            return view('site/details', compact('explorer'));
        }

        public function edit(Explorer $explorer, string|int $id){
            //FAZ A MESMA COISA Q O FIND
            if(!$explorer = $explorer->where('id', $id)->first()){
                return back();
            };
            return view('site/edit', compact('explorer'));
        }

        public function update(Request $request, Explorer $explorer, string $id){
            if(!$explorer = $explorer->find($id)){
                return back();
            };
            $explorer->update($request->only([
                'latitude', 'longitude'
            ]));
            return redirect()->route('explorers.show');
        }
    }
