<?php

/**
 * Class Post.php
 *
 * Define a Post.php
 *
 *
 */


class Topic
{
    private $commentId;
    private $postId;
    private $Author;
    private $creationDate;
    private $moderationDate;
    private $commentContent;
    private $AnswerId;
    private $Moderation;

    /**
     * @return mixed
     */
    public function getModeration()
    {
        return $this->Moderation;
    }

    /**
     * @param mixed $Moderation
     */
    public function setModeration($Moderation)
    {
        $this->Moderation = $Moderation;
    }

    /**
     * @return mixed
     */
    public function getAnswerId()
    {
        return $this->AnswerId;
    }

    /**
     * @param mixed $AnswerId
     */
    public function setAnswerId($AnswerId)
    {
        $this->AnswerId = $AnswerId;
    }
    /**
     * @return mixed
     */
    public function getCommentId()
    {
        return $this->commentId;
    }

    /**
     * @param mixed $commentId
     */
    public function setCommentId($commentId)
    {
        $this->commentId = $commentId;
    }

    /**
     * @return mixed
     */
    public function getPostId()
    {
        return $this->postId;
    }

    /**
     * @param mixed $postId
     */
    public function setPostId($postId)
    {
        $this->postId = $postId;
    }

    /**
     * @return mixed
     */
    public function getAuthor()
    {
        return $this->Author;
    }

    /**
     * @param mixed $Author
     */
    public function setAuthor($Author)
    {
        $this->Author = $Author;
    }

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
    public function getModerationDate()
    {
        return $this->moderationDate;
    }

    /**
     * @param mixed $moderationDate
     */
    public function setModerationDate($moderationDate)
    {
        $this->moderationDate = $moderationDate;
    }

    /**
     * @return mixed
     */
    public function getCommentContent()
    {
        return $this->commentContent;
    }

    /**
     * @param mixed $commentContent
     */
    public function setCommentContent($commentContent)
    {
        $this->commentContent = $commentContent;
    }

    /**
     * @return mixed
     */



}
