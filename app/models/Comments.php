<?php
class Comments extends Database
{
  // get comment with news id
  public function getCommentList($newsId) {
      $sql = parent::$connection->prepare('SELECT comments.comment_date ,comments.comment_content, users.user_name, users.user_avatar FROM comments, users WHERE users.user_id = comments.comment_user_id AND comment_newspaper_id = ?');
      $sql->bind_param('i', $newsId);
      return parent::select($sql);
  }

  // post comment
  public function postComment($content, $userId, $newsId) {
    $date = gmdate('Y-m-d H:i:s', time() + 7 * 3600);
    $sql = parent::$connection->prepare('INSERT INTO `comments` (`comment_id`, `comment_content`, `comment_date`, `comment_user_id`, `comment_newspaper_id`) VALUES (NULL, ?, ?, ?, ?)');
    $sql->bind_param('ssii', $content, $date, $userId, $newsId);
    $sql->execute();
    $sql = parent::$connection->prepare('SELECT LAST_INSERT_ID()');
    return parent::select($sql)[0];
  }

  // get comment by id
  public function getCommentById($commentId) {
    $sql = parent::$connection->prepare('SELECT comments.comment_date ,comments.comment_content, users.user_name, users.user_avatar FROM comments, users WHERE users.user_id = comments.comment_user_id AND comment_id = ?');
    $sql->bind_param('i', $commentId);
    return parent::select($sql);
}
}