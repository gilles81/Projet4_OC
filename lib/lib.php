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

    public function findNextChapter($currentChapter ,$chapters)
    {

        $nextPostId=$currentChapter->getPostId();
        for ($i =(count($chapters)-1) ; $i >=0; --$i) {
            echo $currentChapter->getPosition().'---'.$chapters[$i]->getPosition().'</br>';

                if ( $chapters[$i]->getPosition()  > $currentChapter->getPosition()   ) {
                    echo $currentChapter->getPosition() . '++++++' . $chapters[$i]->getPosition() . '</br>';
                    $nextPostId = $chapters[$i]->getPostId();
                }
        }


        return $nextPostId;
    }


    public function findPrevChapter($currentChapter ,$chapters)
    {
        $prevPostId=$currentChapter->getPostId();
        for ($i =0 ; $i <= (count($chapters)-1); ++$i) {
            echo $currentChapter->getPosition().'---'.$chapters[$i]->getPosition().'</br>';

            if ( $chapters[$i]->getPosition()  < $currentChapter->getPosition()   ) {
                echo $currentChapter->getPosition() . '++++++' . $chapters[$i]->getPosition() . '</br>';
                $prevPostId = $chapters[$i]->getPostId();
            }
        }



        return $prevPostId;
    }
}