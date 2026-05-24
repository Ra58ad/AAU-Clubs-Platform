<?php

namespace Core;

class Authenticator{
    public function attempt($username, $password){
        $user = App::resolve(Database::class)->query('select * from users where username = ?', [$username])->find();

        if($user){
            if (password_verify($password, $user['password'])){
                $this->login([
                    'username' => $_POST['username'],
                    'id' => $user['id'],
                ]);
                return true;
            }
        }
        return false;
    }

    public function login($user){
        $_SESSION['user'] = [
            'username' => $user['username'],
            'id' => $user['id'],
        ];

        session_regenerate_id(true);
    }

    public function logout(){
        Session::destroy();
    }
}
