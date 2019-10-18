$(document).ready(function() {
  let page = 1;
  $.get("loadmore.php", { page: page }, function(data) {
    $("#content").append(data);
  });
  $("#load-more").click(function() {
    page++;
    $.get("loadmore.php", { page: page }, function(data) {
      $("#content").append(data);
    });
  });
});
