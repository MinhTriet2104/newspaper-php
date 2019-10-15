<?php
class Comments extends Database
{
    public function getCommentList()
    {
        $sql = parent::$connection->prepare('SELECT * FROM comments');
        return parent::select($sql);
    }
}