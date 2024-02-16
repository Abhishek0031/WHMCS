<style>
  .dropdown-item:hover{
    display:block;
  }
</style>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
<div>
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
    <ul class="nav navbar-nav">
        <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle navi" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Menu
          <i class="fa fa-caret-down"></i>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown" style=' padding-left 10px; '>
          <?php 
            $data = $mymoduleObject->dropDownGet();
            foreach($data as $element){
              echo '<a class="dropdown-item" name='.$element->menu_name.' " href="#" id =\''.$element->id.'\'>'.$element->menu_name.'</a><br/>';
              echo "<div class='".$element->menu_name."'></div>";
            }
            ?>

        </div> 
      </li>
    
    </ul>
      <a class="navbar-brand" href="#">WebSiteName</a>
    </div>
    <ul class="nav navbar-nav">
        <li class="nav-item <?php echo isset($_GET['action']) && $_GET['action'] === '' ? 'active' : ''; ?>"><a class="navi" href="<?php echo $var['modulelink']; ?>">Home</a></li>
        <li class="nav-item <?php echo isset($_GET['action']) && $_GET['action'] === 'client' ? 'active' : ''; ?>"><a class="navi" href="<?php echo $var['modulelink']; ?>&action=client">Client</a></li>
        <li class="nav-item <?php echo isset($_GET['action']) && $_GET['action'] === 'order' ? 'active' : ''; ?>"><a class="navi" href="<?php echo $var['modulelink']; ?>&action=order">Order</a></li>
        <li class="nav-item <?php echo isset($_GET['action']) && $_GET['action'] === 'invoice' ? 'active' : ''; ?>"><a class="navi" href="<?php echo $var['modulelink']; ?>&action=invoice">Invoice</a></li>
        <li class="nav-item <?php echo isset($_GET['action']) && $_GET['action'] === 'addMenu' ? 'active' : ''; ?>"><a class="navi" href="<?php echo $var['modulelink']; ?>&action=menuForm">Add Menu</a></li>
      </ul>
  </div>
</nav>
</div>

<script>
$(document).ready(function() {
  $(".navi").hover(function() {
    $(".nav-item").removeClass("active");
    $(this).parent().addClass("active");
    $(".nav-item:not(.active) .navi").addClass("disabled");
    $(".nav-item.active .navi").removeClass("disabled");
  });

  $('.dropdown-item').hover(function(){
    var id = $(this).attr('id');
    var name = $(this).attr('name');
    var target = '.'+name;
    var trim = $.trim('dropdown-item',name);
    console.log(name);
    $.ajax({
      url:'',
      method:'POST',
      dataType:'json',
      data:{ajaxCheck: 'navDropDown',parentId:id},
      success:function(data){
        // console.log(data); 
        var msg2 = "<ul>";
        for (x in data){
          msg2 =
             msg2 +
             "<li id='"+data[x]["id"]+"'>"+
            data[x]["menu_name"] +
            "</li>"
        }
        msg2 = msg2 + '</ul>';
        if(data){
          // $('.dropdown-item').css('display','block')
          $(target).html(msg2);
          $(target).addClass('name');


        }
      }
    })
  })
});
</script>

