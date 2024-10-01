<?php
    namespace App\Http\Controllers\Site;

    class SiteController{
        public function contact() {
            return view('site/contact');
        }

        public function exploradores() {
            return view('site/exploradores');
        }
    }
