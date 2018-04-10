<?php
/**
 * Class Router
 *
 *Create route et find controller
 */

class Routeur
{
    private $request;
    private $routes = [
        'home.html'=> ['controller' => 'PostController' , 'method' => 'showPosts'],
        'home2.html'=> ['controller' => 'PostController' , 'method' => 'showPosts2'],
        'home3.html'=> ['controller' => 'PostController' , 'method' => 'showPosts3'],
        'home4.html'=> ['controller' => 'PostController' , 'method' => 'showPosts4'],
        'home5.html'=> ['controller' => 'PostController' , 'method' => 'showPosts5']

    ];
  /**To do
  * create other road..
  */
    public function __construct($request)
    {
        $this -> request =$request;
    }

    /**
     *
     *
     * TO DO ...........
     *
     */


    public function findController()
    {
        $request = $this->request;

        if (key_exists($request , $this->routes))
        {
            $controller = $this->routes[$request]['controller'];
            $method = $this->routes[$request]['method'];

            $currentController = new $controller();
            $currentController ->$method();


        }else{
            echo 'Error 404 - Pas de routes' ;
             }
    }

}

