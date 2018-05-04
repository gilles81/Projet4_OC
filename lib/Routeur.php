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
        'removePost.html'                   => ['controller' => 'PostsController', 'method' => 'deletePost'],
        'updatePost.html'                       => ['controller' => 'PostsController', 'method' => 'updatePost'],
        'updateOnbasePost.html'          => ['controller' => 'PostsController', 'method' => 'sendUpdatePost'],
        'delete.html'                   => ['controller' => 'PostsController', 'method' => 'removeComment'],
        'deleteReply.html'                   => ['controller' => 'PostsController', 'method' => 'removeReply'],
        'next.html'                   => ['controller' => 'PostsController', 'method' => 'nextChapter'],
        'prev.html'                   => ['controller' => 'PostsController', 'method' => 'prevChapter'],
        'admin.html'                    => ['controller' => 'MemberController', 'method' => 'loginSession'],

        'deconnexion.html'              => ['controller' => 'MemberController', 'method' => 'deconnexion'],
        'reply.html'                     => ['controller' =>'PostsController', 'method' => 'answer'],
        'setTopicWarning.html'         => ['controller' =>'PostsController', 'method' => 'setTopicWarning'],

        'unsetTopicWarning.html'         => ['controller' =>'PostsController', 'method' => 'unsetTopicWarning'],
        'unsetAnswerWarning.html'         => ['controller' =>'PostsController', 'method' => 'unsetAnswerWarning'],

        'setAnswerWarning.html'         => ['controller' =>'PostsController', 'method' => 'setAnswerWarning'],

        'addAnswer.html'                 => ['controller' =>'PostsController', 'method' => 'newAnswer']


    ];
  /**
  * create other road..
  */
    public function __construct($request)
    {
        $this -> request =$request;
    }


    /**
     *  public function findController()
     *
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

