<?php

/**
 * Class Post.php
 *
 * Define a Post.php
 *
 *
 */


class Comment
{
    private $commentId;
    private $postId;
    private $Author;
    private $creationDate;
    private $moderationDate;
    private $commentContent;

     /**
     * @return mixed
     */
    public function getCommentId()
    {
        return $this->commentId;
    }/**
     * @param mixed $commentId
     */
    public function setCommentId($commentId)
    {
        $this->commentId = $commentId;
    }/**
     * @return mixed
     */
    public function getPostId()
    {
        return $this->postId;
    }/**
     * @param mixed $postId
     */
    public function setPostId($postId)
    {
        $this->postId = $postId;
    }/**
     * @return mixed
     */
    public function getAuthor()
    {
        return $this->Author;
    }/**
     * @param mixed $Author
     */
    public function setAuthor($Author)
    {
        $this->Author = $Author;
    }/**
     * @return mixed
     */
    public function getCreationDate()
    {
        return $this->creationDate;
    }/**
     * @param mixed $creationDate
     */
    public function setCreationDate($creationDate)
    {
        $this->creationDate = $creationDate;
    }/**
     * @return mixed
     */
    public function getModerationDate()
    {
        return $this->moderationDate;
    }/**
     * @param mixed $moderationDate
     */
    public function setModerationDate($moderationDate)
    {
        $this->moderationDate = $moderationDate;
    }/**
     * @return mixed
     */
    public function getCommentContent()
    {
        return $this->commentContent;
    }/**
     * @param mixed $commentContent
     */
    public function setCommentContent($commentContent)
    {
        $this->commentContent = $commentContent;
    }

}
