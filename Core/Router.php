<?php

namespace Core;

class Router{
    protected $routes = [];

    public function add($uri, $view, $method){
        $this->routes[] = [
            "uri" => $uri, 
            "view" => $view,
            "method" => $method,
            ];

        return $this;
    }

    public function get($uri, $view){
        return $this->add($uri, $view, "GET");
    }

    public function post($uri, $view){
        return $this->add($uri, $view, "POST");

    }

    public function delete($uri, $view){
        return $this->add($uri, $view, "DELETE");
    }
    
    public function patch($uri, $view){
        return $this->add($uri, $view, "PATCH");
    }

    public function put($uri, $view){
        return $this->add($uri, $view, "PUT");
    }
    protected function abort($code = 404){
    http_response_code($code);
    
    require basePath("views/{$code}.php");

    die();
}

    public function previousUrl(){
        return $_SERVER['HTTP_REFERER'];
    }

    public function only($key){
        $this->routes[array_key_last($this->routes)]["middleware"] = $key;
        return $this;
    }

    public function route($uri, $method){
        foreach($this->routes as $route){
            if($route['uri']==$uri && $route['method']==strtoupper($method)){
                return require basePath("Views\\".$route['view'].".view.php");
            }
        }
        $this->abort();
    }
}

