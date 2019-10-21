$(document).ready(function() {
  let page = 1;
  let categoryId = $("#category-id").val();
  $.get("loadmore.php", { page: page, category: categoryId }, function(data) {
    $("#content").append(data);
  });
  $("#load-more").click(function() {
    page++;
    $.get("loadmore.php", { page: page, category: categoryId }, function(data) {
      $("#content").append(data);
    });
  });
});
