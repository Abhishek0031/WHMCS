<script src="https://common.olemiss.edu/_js/sweet-alert/sweet-alert.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://common.olemiss.edu/_js/sweet-alert/sweet-alert.css">


<script src="{$tplVar['rootURL']}/modules/addons/ticket_tag/assets/js/ticketjs.js"></script>
<link rel="stylesheet" href="{$tplVar['rootURL']}/modules/addons/ticket_tag/assets/css/style.css">

<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>

<div class="container-fluid">
  
  <div class="menu_bar ticket-tag-menu">
    <img src="https://whmcs81.shinedezign.pro/modules/addons/affiliate/images/wgs-logo.svg">      
    <ul>
      <li class="active"><a href="#">
        <span class="glyphicon glyphicon-cog"></span>
      </a>Setting</li>
    </ul>
  </div>
  <br/>
<div class="container">
    <div class="col-sm-12 auto-m d-block">
        <div class="box ticket-tag-box">
          <!-- <pre> -->
           <!-- {$tplVar|@print_r} -->
           <!-- </pre> -->

            {if $tplVar['insertMsg']['status'] == 'error'}
           <div class="alert alert-danger" role="alert">
            {$tplVar['insertMsg']['message']}
            </div>
          
           {elseif $tplVar['insertMsg']['status'] == 'success'}
           <div class="alert alert-success" role="alert">
            {$tplVar['insertMsg']['message']}
            </div>
           {/if}
          
           <form action="" method="post">
            <div class="form-group">
                <label for="enter tag">Enter Tag</label>
                <input type="text" name="tag_manager" id="tag" class="form-control" placeholder="Enter Tag Name *">
            </div>
            <div class="form-group">
            <label for="tag background color">Tag Background Color</label>
            <input type="color" name="tag_color" class="form-control">
        </div>
        <input type="submit" class="btn btn-success" name="insert" value="submit">
      </form> 
    </div>
    </div>
</div>
<br/>

<div class="container">
  <table id="delete_inactive_client" class="datatable" style="width:100%">
<thead>
    <tr class="info" >
        <th>Id</th>
        <th>Tag Manager</th>
        <th>Tag Color</th>
        <th><center>Action</center></th>
      </tr>
    </thead>
    <tbody>
      {foreach from=$tplVar['tag_manager_details'] item=foo}
      <tr>
        <td>{$foo->id}</td>
        <td>{$foo->tag_manager}</td>
        <td>{$foo->tag_color}</td>
        <td><center><button type="button" class="btnClick btn btn-default btn-sm" 
            data-toggle="modal" data-target="#myModal" 
            data-id="{$foo->id}" data-tag="{$foo->tag_manager}" 
            data-color="{$foo->tag_color}"><span class="glyphicon glyphicon-pencil"></span></button>
        <button class="btn btn-default deleteBtn" id="{$foo->id}" name="delete"><span class="glyphicon glyphicon-trash"></span></button></center></td>
    </tr>
        {/foreach}
      </tbody>
</table> 

</div>
    <!-- Modal -->
    <div class="modal fade edit-popup" id="myModal" role="dialog">
      <div class="modal-dialog">
      
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title text-success"><center>Edit Details Here</center></h4>
          </div>
          <div class="modal-body">
            <form action="" method="post">
                <div class="form-group">
                  <b><p class="text-success" id="msg"></p></b>
                    <label for="enter tag">Enter Tag</label>
                    <input type="text" name="tag_manager" id="editTagManager" class="form-control">
                </div>
                <div class="form-group">
                    <label for="tag background color">Tag Background Color</label>
                    <input type="color" name="tag_color" id="editTagColor" class="form-control">
                </div>
              </form>
            </div>
            <div class="modal-footer">
              <button type="submit"  id="updateBtn" class="btn btn-success UpdateSub" name="update">Update</button>
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
  </div>
  