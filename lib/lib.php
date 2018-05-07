<?php

/**
 * Class lib
 *
 * this is a lib of method
 *
 *  *
 */

class lib

    {


    /**
     * public function sessionStatus()
     *
     * Set Session status an admin level in case of
     *
     */

        public function sessionStatus()
        {
            if (!isset($_SESSION['Status']))
            {
                $_SESSION['Status'] = 1;
                $_SESSION['adminLevel'] = 0; // Direct in VISITOR MODE
            }
        }

    /**
     * @param Post $currentChapter
     * @param array $chapters
     * @return mixed
     */
    public function findNextChapter(Post $currentChapter , Array $chapters)
    {
        $nextPostId=$currentChapter->getPostId();
        for ($i =(count($chapters)-1) ; $i >=0; --$i) {
                if ( $chapters[$i]->getPosition()  > $currentChapter->getPosition()   ) {
                    $nextPostId = $chapters[$i]->getPostId();
                }
        }
        return $nextPostId;
    }

    /**
     *
     * public function findPrevChapter
     *
     * find a Previous chapter when Prev button is set .
     *
     * @param $currentChapter
     * @param $chapters
     * @return mixed
     */
    public function findPrevChapter(Post $currentChapter ,Array $chapters)
    {
        $prevPostId=$currentChapter->getPostId();
        for ($i =0 ; $i <= (count($chapters)-1); ++$i) {
            if ( $chapters[$i]->getPosition()  < $currentChapter->getPosition()   ) {
                $prevPostId = $chapters[$i]->getPostId();
            }
        }
        return $prevPostId;
    }
}