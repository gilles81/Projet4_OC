<?php
/**
 * Class MemberController
 *
 * used to manage loggin session and deconnection
 */
class MemberController extends lib
{
    /**
     * public function loginSession()
     *
     * Loggin : Call loggin view for define Log an Pswd
     */
    public function loginSession()
    {
       $this->sessionStatus();//determine status admin or not
        $myView = new View('userCnxForm');
        $myView->build( array('chapters'=> null ,'comments'=>null,'warningList' => null,'HOST'=>HOST,'adminLevel'=>  $_SESSION['adminLevel']));
    }

    /**
     *   public function deconnexion()
     *
     * Used to deconnect from admin mode .
     *
     *
     */

    public function deconnexion()

    {
        session_destroy();
        // redirect to Home Page
        $myView = new View(' ');
        $myView->redirect('home.html');
    }


}