<?php
class Users extends Database
{
    public function getUsersList()
    {
        $sql = parent::$connection->prepare('SELECT * FROM users');
        return parent::select($sql);
    }
}   