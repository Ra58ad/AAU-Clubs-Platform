<?php

namespace Core;

class Authenticator{
    public function attempt($username, $password){
        $user = App::resolve(Database::class)->query('select * from users where username = ?', [$username])->find();

        if($user){
            if (password_verify($password, $user['password'])){
                $this->login([
                    'username' => $user['username'],
                    'id' => $user['id'],
                    'role' => $user['role'],
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
            'role' => $user['role'] ?? 'member',
        ];

        session_regenerate_id(true);
    }

    public function check(){
        return isset($_SESSION['user']);
    }

    public function logout(){
        Session::destroy();
    }
}
