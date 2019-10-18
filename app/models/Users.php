<?php
class Users extends Database
{
  // Get user list
    public function getUsersList()
    {
        $sql = parent::$connection->prepare('SELECT * FROM users');
        return parent::select($sql);
    }

    // find username
    public function findUsername($username) {
      $sql = parent::$connection->prepare('SELECT * FROM users WHERE user_name = ?');
      $sql->bind_param('s', $username);
      return parent::select($sql);
    }
  
    // Creat new user
    public function createUser($username, $password) {
      $role = "member";
      $sql = parent::$connection->prepare('INSERT INTO `users` (`user_id`, `user_name`, `user_password`, `user_role`) VALUES (NULL, ?, ?, ?)');
      $sql->bind_param('sss', $username, $password, $role);
      return $sql->execute();
    }
}   