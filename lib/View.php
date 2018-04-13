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
        foreach ($params as $name => $value) {
            ${$name} = $value;
        }

        $template = $this->template;

        ob_start();
        include(VIEW . $template . '.php');
        $content = ob_get_clean();
        include(VIEW . '_layout.php');
    }

    public function redirect($route)
    {

      header("location: ".HOST.$route );
        exit;
    }
}