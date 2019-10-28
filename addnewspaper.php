<?php
require_once './config/database.php';
require_once './config/config.php';
spl_autoload_register(function ($className) {
    require './app/models/' . $className . '.php';
});

//add product
$newspaperTitle="";
$newspaperImgae="";
$newspaperAuthorId= 0;
$newspaperDate='';
$newspaperContent="";
$newspaperView=0;
$newspaperCategoryId=0;
$notification = '';

if(!empty($_POST['newspaperTitle']) && !empty($_POST['newspaperImage']) && !empty($_POST['newspaperAuthorId']) && !empty($_POST['newspaperContent']) && !empty($_POST['newspaperView']) && !empty($_POST['newspaperCategoryId']))
{
  $newspaperTitle= $_POST['newspaperTitle'];
  $newspaperImgae= $_POST['newspaperImage'];
  $newspaperAuthorId= $_POST['newspaperAuthorId'];
  $newspaperDate= $newspaperDate.date('Y-m-d h:i:s');
  $newspaperContent= $_POST['newspaperContent'];
  $newspaperView= $_POST['newspaperView'];
  $newspaperCategoryId= $_POST['newspaperCategoryId'];

  $newspaperModel = new Newspapers();

  //add news
  if($newspaperModel->addNewspaper($newspaperTitle, $newspaperImgae, $newspaperAuthorId, $newspaperDate,$newspaperContent, $newspaperView,$newspaperCategoryId))
  {
      $notification = "Added successfully";
  }
  else
  {
      $notification = "Added failed";
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
    <h1>Add Newspaper</h1>
    <form action="addnewspaper.php" method="POST">
      <div class="form-group">
        <label for="">Title</label>
        <input type="text" class="form-control" id="newspaperTitle" name="newspaperTitle">
      </div>
      <div class="form-group">
        <label for="">Image</label>
        <input type="text" class="form-control" id="newspaperImage" name="newspaperImage">
      </div>
      <div class="form-group">
        <label for="">Author ID</label>
        <input type="text" class="form-control" id="newspaperAuthorId" name="newspaperAuthorId">
      </div>
      <!-- <div class="form-group">
        <label for="">Date</label>
        <input type="datetime-local" class="form-control" id="newspaperDate" name="newspaperDate">
      </div> -->
      <label for="">Content</label>
      
      <div class="form-group">
        <textarea name="newspaperContent" id="summernote"></textarea> 
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
        <input type="text" class="form-control" id="newspaperView" name="newspaperView">
      </div>
      <div class="form-group">
        <label for="">Category ID</label>
        <input type="text" class="form-control" id="newspaperCategoryId" name="newspaperCategoryId">
      </div>
      <button type="submit" class="btn btn-primary">ADD</button>
    </form>
  </div>
</body>

</html>