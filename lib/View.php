<?php
/**
 *
 * Class View
 *
 *
 */

class View {

    private $template;

    public function __construct($template)
    {
        $this -> template =$template;
    }

    public function build()
    {
        $template = $this-> template;
        ob_start(VIEW.$template. '.php');
        $content = ob_get_clean();
        include(VIEW.'_layout.php');

    }


}