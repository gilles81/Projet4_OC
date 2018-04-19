<?php
/**
 * Class
 *
 *Create route et find controller
 */

class lib
{
    public function sessionStatus()
    {
        if (isset($_SESSION['Status']))
        {
            Echo 'Session Exist';
            echo  $_SESSION['Status'];
            echo $_SESSION['adminLevel'];

        }else
        {
            //session_start();
            $_SESSION['Status']=1;
            $_SESSION['adminLevel']=0; // Direct in VISITOR MODE
            Echo 'Session Exist';
            echo $_SESSION['adminLevel'];
        }
    }
}
