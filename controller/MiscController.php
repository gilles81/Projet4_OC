<?php
/**
 * Class FrontOfficeHome
 *
 * used to show the Post.php on home page
 */
class MiscController
{

    public function showAbout()
    {
        /**
         * Todo
         *
         */
        $myView = new View('about');
        $myView->build(array('chapters'=> null ,'comments'=>null,'HOST'=>HOST ,'adminLevel'=>0));
    }

    public function showContact()
    {
        /**
         * Todo
         *
         */
        $myView = new View('contact');
        $myView->build(array('chapters' => null, 'comments' => null, 'HOST' => HOST, 'adminLevel' => 0));
    }

}