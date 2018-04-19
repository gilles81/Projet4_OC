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

    public function build($datas)
    {
        $template = $this->template;
        $loader = new Twig_Loader_Filesystem(ROOT . 'view/');

        $twig = new Twig_Environment($loader, [
            'cache' => false //__DIR__ .'/tmp'
        ]);

        $twig->addExtension(new Twig_Extensions_Extension_Text());




        if ($datas){
            foreach ($datas as $name => $value) {
                $a = $name;
                $$a = $value;
            }

            echo $twig->render($template . '.twig', ['chapters' => $chapters,'comments' => $comments ,'HOST'=>$HOST, 'adminLevel' => $adminLevel]);
        }else {

            //echo $twig->render($template . '.twig' , ['users' => $users] );
        }


}


public function redirect($route)
    {
        echo session_save_path();


        echo '     laa 5 </br> ';
        echo '   ----------</br> ';
        echo '   ---------- </br> ' .$_SESSION['adminLevel'];


        header("location: ".HOST.$route );

        exit;
    }
}