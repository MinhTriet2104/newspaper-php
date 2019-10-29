$(document).ready(function() {
  let id = $("#newsId").val();
  let userId = $("#user-id").val();
  $.post("/callie/comment.php", { newsId: id }, function(data) {
    $("#comment").append(data);
  });

  $("#send").click(function() {
    let content = $("#message").val();
    $.post(
      "/callie/comment.php",
      { content: content, userId: userId, newsId: id },
      function(data) {
        $("#comment").prepend(data);
      }
    );
  });
});
