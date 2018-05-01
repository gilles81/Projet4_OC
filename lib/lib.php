<?php
/**
 * Class lib
 *
 *D if a seesion is not create (ie after admin deconection) session level  0 "visitor" is created.
 */

class lib

    {

        public function sessionStatus()
        {
            if (!isset($_SESSION['Status']))
            {

                $_SESSION['Status'] = 1;
                $_SESSION['adminLevel'] = 0; // Direct in VISITOR MODE

            }
        }

}
