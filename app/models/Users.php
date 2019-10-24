<?php
class Users extends Database
{
  // Get user list
    public function getUsersList()
    {
        $sql = parent::$connection->prepare('SELECT * FROM users');
        return parent::select($sql);
    }

    // check username and password
    public function login($username, $password) {
      $sql = parent::$connection->prepare('SELECT * FROM users WHERE user_name = ? AND user_password = ?');
      $sql->bind_param('ss', $username, $password);
      return parent::select($sql);
    }

    // find username
    public function findUsername($username) {
      $sql = parent::$connection->prepare('SELECT * FROM users WHERE user_name = ?');
      $sql->bind_param('s', $username);
      return parent::select($sql);
    }

    // find email
    public function findEmail($email) {
      $sql = parent::$connection->prepare('SELECT * FROM users WHERE user_email = ?');
      $sql->bind_param('s', $email);
      return parent::select($sql);
    }
  
    // Creat new user
    public function createUser($username, $password, $email) {
      $role = "member";
      $avatar = "https://i.imgur.com/e6A4vLz.jpg";
      $sql = parent::$connection->prepare('INSERT INTO `users` (`user_id`, `user_name`, `user_password`, `user_email`, `user_role`, `user_avatar`) VALUES (NULL, ?, ?, ?, ?, ?)');
      $sql->bind_param('sssss', $username, $password, $email, $role, $avatar);
      return $sql->execute();
    }
}   