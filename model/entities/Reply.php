<?php

/**
 * Class Reply.php
 *
 * Define a Post.php
 *
 *
 */


class Reply
{
    private $id;


    private $answer;
    private $answerId;
    private $author;

    private $moderation;
    private $creationDate;

    /**
     * @return mixed
     */
    public function getCreationDate()
    {
        return $this->creationDate;
    }

    /**
     * @param mixed $creationDate
     */
    public function setCreationDate($creationDate)
    {
        $this->creationDate = $creationDate;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getAnswer()
    {
        return $this->answer;
    }

    /**
     * @param mixed $answer
     */
    public function setAnswer($answer)
    {
        $this->answer = $answer;
    }

    /**
     * @return mixed
     */
    public function getAnswerId()
    {
        return $this->answerId;
    }

    /**
     * @param mixed $answerId
     */
    public function setAnswerId($answerId)
    {
        $this->answerId = $answerId;
    }

    /**
     * @return mixed
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @param mixed $author
     */
    public function setAuthor($author)
    {
        $this->author = $author;
    }

    /**
     * @return mixed
     */
    public function getModeration()
    {
        return $this->moderation;
    }

    /**
     * @param mixed $moderation
     */
    public function setModeration($moderation)
    {
        $this->moderation = $moderation;
    }
}
