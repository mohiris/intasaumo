<?php
namespace Core\Routing;

class Route{

    private $routes = [];

    /**
     * @param string $path
     * @param array $callback
     * @return void
     */
     public function get(string $path, array $callback)
     {
        $this->routes['get'][$path] = $callback;
        
     }

      /**
     * @param string $path
     * @param array $callback
     * @return void
     */
    public function post(string $path, array $callback)
    {
       $this->routes['post'][$path] = $callback;
       
    }

     public function getRoutes()
     {
        return $this->routes;

     }
 
}