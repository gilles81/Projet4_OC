<?php
session_start();
/**
 * Class Router
 *
 *Create route et find controller
 */

class Routeur
{
    private $request;
    private $routes = [
        'contact.html'                  => ['controller' => 'MiscController', 'method' => 'ShowContact'],
        'about.html'                    => ['controller' => 'MiscController', 'method' => 'ShowAbout'],
        'home.html'                     => ['controller' => 'PostsController', 'method' => 'showPosts'],
        'post.html'                     => ['controller' => 'PostsController', 'method' => 'showPost'],
        'addComment.html'               => ['controller' => 'PostsController', 'method' => 'createComment'],

        'adminverif.html'               => ['controller' => 'PostsController', 'method' => 'identification'],
        'createPost.html'                  => ['controller' => 'PostsController', 'method' => 'createPost'],
        'addPost.html'                   => ['controller' => 'PostsController', 'method' => 'addPost'],
        'removePost.html'                   => ['controller' => 'PostsController', 'method' => 'removePost'],
        'updatePost.html'                       => ['controller' => 'PostsController', 'method' => 'updatePost'],
        'updateOnbasePost.html'          => ['controller' => 'PostsController', 'method' => 'sendUpdatePost'],

        'delete.html'                   => ['controller' => 'PostsController', 'method' => 'removeComment'],

        'admin.html'                    => ['controller' => 'MemberController', 'method' => 'loginSession'],
        'deconnexion.html'              => ['controller' => 'MemberController', 'method' => 'deconnexion']


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
            echo 'Error 404 - Pas de routes pour la requette : ' . $request ;
        }
    }

}

