<?php
/**
 * Class Router
 *
 *Create route et find controller
 */

class Router
{
    private $request;
    private $routes = ['home.html'=> ['controller' , 'FrontOfficeHome' , 'method' => 'showPost']];
  /*To do
  * create other road..
  */
    public function __construct($request)
    {
        $this -> request =$request;
    }
    public function findController()
    {
        $request = $this->request;

        if (key_exists($request , $this->routes))
        {
            $controller = $this->routes[$request]['controller'];
            $method = $this->routes[$request]['method'];

            $currentController = new $controller();
            $currentController ->method();
        }else{
            echo 'Error 404' ;
             }
    }

}

