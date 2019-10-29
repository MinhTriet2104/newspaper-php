<?php
require_once './config/Database.php';
spl_autoload_register(function ($className) {
    require './app/models/' . $className . '.php';
});

// $content = $_POST['content'];
$newsId = $_POST['newsId'];

$commentModel = new Comments();
$commentList = [];
if (isset($_POST['userId'])) {
  $userId = $_POST['userId'];
  $content = $_POST['content'];
  $commentId = $commentModel->postComment($content, $userId, $newsId)['LAST_INSERT_ID()'];
  $commentList = $commentModel->getCommentById($commentId);
} else {
  $commentList = $commentModel->getCommentList($newsId);
}


$date = gmdate('Y-m-d H:i:s', time() + 7 * 3600);
$time = "";
foreach ($commentList as $comment) {
$diff = strtotime($date) - strtotime($comment['comment_date']);
if ($diff < 60) {
  $time = "$diff giây trước";
} else if ($diff < 3600) {
  $diff = floor($diff / 60);
  $time = "$diff phút trước";
} else if ($diff < 3600 * 24) {
  $diff = floor($diff / 3600);
  $time = "$diff giờ trước";
} else {
  $diff = floor($diff / (3600 * 24));
  $time = "$diff ngày trước";
}
?>
<!-- comment -->
<div class="media">
  <div class="media-left">
    <img class="media-object" src="<?php echo $comment['user_avatar'] ?>" alt="avatar-img">
  </div>
  <div class="media-body">
    <div class="media-heading">
      <h4><?php echo $comment['user_name']; ?></h4>
      <span class="time"><?php echo $time; ?></span>
    </div>
    <p><?php echo $comment['comment_content']; ?></p>
  </div>
</div>
<!-- /comment -->
<?php
}
?>
