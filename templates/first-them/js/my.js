$(document).ready(function(){
  $('#hover-dropdown').hover(function(){
    $(this).find('.dropdown-menu').stop(true, true).delay(20).fadeIn(50);
  }, function(){
    $(this).find('.dropdown-menu').stop(true, true).delay(20).fadeOut(50);
  });

  jQuery(".parentMenuAnchor").click(function () {
    // alert("iam in");
    if (jQuery(this).parent().hasClass("active")) {
      jQuery(this).parent().removeClass("active");
    } else {
      jQuery(".parentMenue").removeClass("active");
      jQuery(".sub_menu_list").removeClass("active");
      jQuery(this).parent().addClass("active");
    }
  });
 
  jQuery(".subMenuListMenuAnchor").click(function () {
    // alert("iam in");
    if (jQuery(this).parent().hasClass("active")) {
      jQuery(this).parent().removeClass("active");
    } else {
      jQuery(".sub_menu_list").removeClass("active");
      jQuery(this).parent().addClass("active");
    }
  });
});
