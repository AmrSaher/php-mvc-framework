<?php 

declare(strict_types=1);

namespace App;

use App\Exceptions\RouteNotFoundException;

class App {
    protected Router $router;
    protected array $request;
    protected Config $config;
    private static DB $db;

    public function __construct(Router $router, array $request, Config $config)
    {
        $this->router = $router;
        $this->request = $request;
        $this->config = $config;
        
        // Database Connection
        static::$db = new DB($config->db ?? []);
    }

    public static function db() : DB
    {
        return static::$db;
    }

    public function run()
    {
        try {
            echo $this->router->resolve($this->request['uri'], strtolower($this->request['method']));
        } catch (RouteNotFoundException $e) {
            http_response_code(404);

            echo View::make('error/404');
        }
    }
}