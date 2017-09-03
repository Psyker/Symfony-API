<?php

namespace AppBundle\Interfaces;

use AppBundle\Entity\Comment;

interface CommentManagerInterface
{

    /**
     * Create a new comment.
     * @param Comment $comment
     * @return Comment
     */
    public function createComment(Comment $comment): Comment;

    /**
     * Return a new instance of Comment.
     * @return Comment
     */
    public function newComment(): Comment;
}