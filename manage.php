<?php
require_once './config/database.php';
require_once './config/config.php';
spl_autoload_register(function ($className) {
    require './app/models/' . $className . '.php';
});

$notification='';
$newspaperModel = new Newspapers();
$newspaperList = $newspaperModel->getNewspapersList();
if(isset($_POST['newspaperId']))
{
    
    if($newspaperModel->deleteNewspaper($_POST['newspaperId']))
    {
        $notification = 'delete successfully';
    }
    else {
        $notification = 'delete Failed';
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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script>
        function deleteNewspaper()
        {
            //xac nhan xoa., them onsubmit vao form
            return confirm("You want delete?");
        }
    </script>
</head>
<body>
    <div class="container">
        <a href="addnewspaper.php" class="btn btn-primary">Add newspaper</a>
        <table class="table">
            <tr>
                <td>Newspaper Title</td>
                <td>Action</td>
            </tr>

            <?php
            echo $notification;
            foreach ($newspaperList as $news) 
            {
            ?>

                <tr>
                    <td>
                        <?php echo $news['newspaper_title']; ?>
                    </td>
                    <td>
                        <!-- Update -->
                        <a href="update-news.php?id=<?php echo $news['newspaper_id']; ?>" class="btn btn-primary">Update</a>
                        <!-- Delete -->
                        <form action="manage.php" method="post" onsubmit="return deleteNewspaper()">
                            <input type="hidden" name="newspaperId" value="<?php echo $news['newspaper_id']; ?>">
                            <button type="submit" class="btn btn-danger">Delete</button>
                        
                        </form>
                    
                    </td>
                </tr>

            <?php
            }
            ?>
        </table>
    </div>
</body>
</html>