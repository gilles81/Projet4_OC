<?php
/**
 *
 * Class View
 *
 * define a View class
 */

class View {

    private $template;

    public function __construct($template)
    {
        $this -> template =$template;
    }

    public function build($params = array())
    {
        $template = $this->template;
        $loader = new Twig_Loader_Filesystem(ROOT. '/view');
        $twig = new Twig_Environment($loader , [
            'cache' => false //__DIR__ .'/tmp'
        ]);

        foreach ($params as $name => $value) {
            ${$name} = $value;
        }

        echo '---'.$name;

        echo $twig->render( 'home.twig',$name);
        /**
        ob_start();
        include(VIEW . $template . '.php');
        $content = ob_get_clean();
        include(VIEW . '_layout.twig');
         */
    }

    public function redirect($route)
    {

      header("location: ".HOST.$route );
        exit;
    }
}