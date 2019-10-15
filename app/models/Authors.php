<?php
class Authors extends Database
{
    public function getAuthorsList()
    {
        $sql = parent::$connection->prepare('SELECT * FROM authors');
        return parent::select($sql);
    }
    public function getAuthorNameById($id)
    {  
      
        $sql = parent::$connection->prepare('SELECT author_name FROM authors WHERE author_id=?');
        $sql->bind_param('i', $id);
        return parent::select($sql);
    }
}