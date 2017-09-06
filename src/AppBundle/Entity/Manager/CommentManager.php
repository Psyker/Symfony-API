<?php

namespace AppBundle\Entity\Manager;

use AppBundle\Entity\Comment;
use AppBundle\Interfaces\CommentManagerInterface;

class CommentManager extends AbstractManager implements CommentManagerInterface
{
    /**
     * Create a new comment.
     * @param Comment $comment
     * @param bool $flush
     * @return Comment
     */
    public function createComment(Comment $comment, $flush = false): Comment
    {
        $this->persistObject($comment, $flush);

        return $comment;
    }

    /**
     * Return a new instance of Comment
     * @return Comment
     */
    public function newComment(): Comment
    {
        $class = $this->getClass();

        return new $class;
    }

    /**
     * Remove a comment.
     * @param Comment $comment
     * @return Comment
     */
    public function removeComment(Comment $comment): Comment
    {
        $this->removeObject($comment);

        return $comment;
    }
}
