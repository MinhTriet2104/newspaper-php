<?php
require_once './config/Database.php';
require_once './config/config.php';
spl_autoload_register(function ($className) {
    require './app/models/' . $className . '.php';
});

// Tao url
function createUrl($str, $id) {
  $str = strip_tags($str);
  $str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", 'a', $str);
  $str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $str);
  $str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $str);
  $str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", 'o', $str);
  $str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $str);
  $str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $str);
  $str = preg_replace("/(đ)/", 'd', $str);
  $str = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", 'A', $str);
  $str = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", 'E', $str);
  $str = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", 'I', $str);
  $str = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", 'O', $str);
  $str = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", 'U', $str);
  $str = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'Y', $str);
  $str = preg_replace("/(Đ)/", 'D', $str);
  $str = preg_replace("/(\“|\”|\‘|\’|\,|\!|\&|\;|\@|\#|\%|\~|\`|\=|\_|\'|\]|\[|\}|\{|\)|\(|\+|\-|\^|\;|\:)/", '', $str);
  $str = trim(preg_replace("/\s+/", ' ', $str));
  return strtolower(str_replace(' ', '-', $str) . '-' . $id);
}

$categoryModels = new Categories();
$categoryList = $categoryModels->getCategoriesList();

$newspaperModels=new Newspapers();

$page = isset($_GET['page']) ? $_GET['page'] : 1; 
$newsRecent = $newspaperModels->loadMore($page, 5);

foreach ($newsRecent as $news) {
$url = createUrl($news['newspaper_title'], $news['newspaper_id']);
$date = new DateTime($news['newspaper_date']);
$date = $date->format('d M Y, H:i');
echo "<div class='post post-row'>";
  echo "<a class='post-img' href='blog-post.php/$url'><img src='" . $news['newspaper_imgae'] . "' alt='news-img'></a>";
echo "<div class='post-body'>";
  echo "<div class='post-category'>";
    echo "<a href='category.php" . $categoryModels->getNameById($news['newspaper_category_id'])['category_name'] . "'></a>";
    echo "</div>";
    echo "<h3 class='post-title'><a href='blog-post.php/$url'>" . strip_tags( $news['newspaper_title']) . "</a></h3>";
    echo "<ul class='post-meta'>";
      echo "<li><a href='author.html'>" . $newspaperModels->getAuthorById($news['newspaper_author_id'])['author_name'] . "</a></li>";
      echo "<li>$date</li>";
    echo "</ul>";
    echo "<p>" . strip_tags(substr( $news['newspaper_content'],0, 150)) ." ...</p>";
  echo "</div>";
echo "</div>";
}