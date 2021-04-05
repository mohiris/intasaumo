<?php
namespace Core;

/**
 * @class Core\Application
 * @author Christian Mohindo
 */

use Core\Routing\Router;
use Core\Http\Request;
use Core\Database\DB;

class Application{
    
    /**
    * @var Core\Router
    */
    public Router $router;
  
    /**
    * @var Core\DB
    */
    public DB $db;

    /**
     * @param array $routes
     * @param array $db_config
     */
    public function __construct($routes, $db_config)
    {

        $this->router = new Router($routes);
        $this->db = new DB($db_config);
        
    }

    public function run()
    {
        $this->router->resolve();
    }
}