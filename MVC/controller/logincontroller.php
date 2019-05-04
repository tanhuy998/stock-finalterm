<?php 
    class LoginController {

        public function Index() {
            if (isset($_COOKIE['token']) && $_COOKIE['token'] !== '') {
                Route::Redirect('home/');
            } 
            $view = new SigninView();
        }
    }