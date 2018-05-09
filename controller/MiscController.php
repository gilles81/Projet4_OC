<?php

/**
 * Class MiscController
 */

class MiscController
{

    /**
     * public function showAbout()
     *
     * call a view with Presentation of J.Forteroche form
     *
     *
     */

    public function showAbout()
    {

        $myView = new View('about');
        $myView->build(array('chapters'=> null ,'comments'=>null,'warningList' => null,'HOST'=>HOST ,'adminLevel'=>$_SESSION['adminLevel'] ));
    }

    /**
     * public function showContact()
     *
     * call a view with contact form
     */


    public function showContact()
    {

        $myView = new View('contact');
        $myView->build(array('chapters' => null, 'comments' => null,'warningList' => null ,'HOST' => HOST, 'adminLevel' =>$_SESSION['adminLevel']));
    }


    /**
     * displayMentions
     *
     * call a view to display legal mention
     */


    public function displayMentions()
    {

        $myView = new View('legalMentions');
        $myView->build(array('chapters' => null, 'comments' => null,'warningList' => null ,'HOST' => HOST, 'adminLevel' => $_SESSION['adminLevel'] ));
    }

}