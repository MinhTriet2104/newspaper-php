<?php
require_once './config/database.php';
require_once './config/config.php';
spl_autoload_register(function ($className) {
    require './app/models/' . $className . '.php';
});
    $newspaperTitle='';
    $newspaperImage="";
    $newspaperAuthorId= 0;
    $newspaperDate='';
    $newspaperContent="";
    $newspaperView=0;
    $newspaperCategoryId=0;
    $id = '';
    $notification = '';
    $urlId='';
    if(isset($_GET['id'])) 
    {
    $id = $_GET['id'];
    
    $urlId = "?id=$id";
    $newspaperModel = new Newspapers();
    $news = $newspaperModel->getNewsById($id);
    $newspaperTitle = $news['newspaper_title'];
    $newspaperImage = $news['newspaper_imgae'];
    $newspaperAuthorId = $news['newspaper_author_id'];
    //$newspaperDate= $newspaperDate.date('Y-m-d H:i:s');
    $newspaperContent= $news['newspaper_content'];
    $newspaperView = $news['newspaper_view'];
    $newspaperCategoryId= $news['newspaper_category_id'];
    }

    if(!empty($_POST['newspaperTitle']) && !empty($_POST['newspaperImage']) && !empty($_POST['newspaperAuthorId']) && !empty($_POST['newspaperContent']) && !empty($_POST['newspaperView']) && !empty($_POST['newspaperCategoryId']))
    {
      $newspaperTitle= $_POST['newspaperTitle'];
      $newspaperImage= $_POST['newspaperImage'];
      $newspaperAuthorId= $_POST['newspaperAuthorId'];
      $newspaperDate= $newspaperDate.date('Y-m-d h:i:s');
      $newspaperContent= $_POST['newspaperContent'];
      $newspaperView= $_POST['newspaperView'];
      $newspaperCategoryId= $_POST['newspaperCategoryId'];
    
     
      if(isset($_GET['id']))
      {
      //update news
      if($newspaperModel->updateNewspaper($newspaperTitle, $newspaperImage, $newspaperAuthorId, $newspaperDate,$newspaperContent, $newspaperView,$newspaperCategoryId,$id))
      {
          $notification = "update successfully";
      }
      else
      {
          $notification = "update failed";
      }
      }
    
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote-bs4.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote-bs4.js"></script>

</head>

<body>

  <div class="container">
    <p><?php echo $notification;?></p>
    <h1>Update Newspaper</h1>
    <form action="update-news.php<?php echo $urlId;?>" method="POST">
      <div class="form-group">
        <label for="">Title</label>
        <input type="text" class="form-control" id="newspaperTitle" name="newspaperTitle" value="<?php echo $newspaperTitle ?>">
      </div>
      <div class="form-group">
        <label for="">Image</label>
        <input type="text" class="form-control" id="newspaperImage" name="newspaperImage" value="<?php echo $newspaperImage ?>">
      </div>
      <div class="form-group">
        <label for="">Author ID</label>
        <input type="text" class="form-control" id="newspaperAuthorId" name="newspaperAuthorId" value="<?php echo $newspaperAuthorId ?>">
      </div>
      <!-- <div class="form-group">
        <label for="">Date</label>
        <input type="datetime-local" class="form-control" id="newspaperDate" name="newspaperDate">
      </div> -->
      <label for="">Content</label>
      
      <div class="form-group">
        <textarea name="newspaperContent" id="summernote"><?php echo $newspaperContent ?></textarea> 
      </div>
      <script>
      $('#summernote').summernote({
        placeholder: 'Nhập nội dung...',
        tabsize: 2,
        height: 100
      });
    </script>
      <div class="form-group">
        <label for="">View</label>
        <input type="text" class="form-control" id="newspaperView" name="newspaperView" value="<?php echo $newspaperView ?>">
      </div>
      <div class="form-group">
        <label for="">Category ID</label>
        <input type="text" class="form-control" id="newspaperCategoryId" name="newspaperCategoryId" value="<?php echo $newspaperCategoryId ?>">
      </div>
      <button type="submit" class="btn btn-primary">Update</button>
    </form>
  </div>
</body>

</html>