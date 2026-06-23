<?php

namespace Core;

class Router{
    protected $routes = [];

    public function add($uri, $controller, $method){
        $this->routes[] = [
            "uri" => $uri, 
            "controller" => $controller,
            "method" => $method,
            ];

        return $this;
    }

    public function get($uri, $cont){
        return $this->add($uri, $cont, "GET");
    }

    public function post($uri, $cont){
        return $this->add($uri, $cont, "POST");

    }

    public function delete($uri, $cont){
        return $this->add($uri, $cont, "DELETE");
    }
    
    public function patch($uri, $cont){
        return $this->add($uri, $cont, "PATCH");
    }

    public function put($uri, $cont){
        return $this->add($uri, $cont, "PUT");
    }
    protected function abort($code = 404){
    http_response_code($code);
    
    require basePath("Views/{$code}.php");

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
                return require basePath('controllers/' . $route['controller']);
            }
        }
        $this->abort();
    }
}

