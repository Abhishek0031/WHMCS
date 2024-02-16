$(document).ready(function(){
  $(".datatable").DataTable();
    $('.deleteBtn').on('click',function(){
      console.log('hii');
        var id = $(this).attr('id');
        swal({
          title: "Are you sure you want to Delete?",
          text: "You will not be able to recover this imaginary file!",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#DD6B55",
          confirmButtonText: "Yes, delete it!",
          cancelButtonText: "No, cancel plx!",
          closeOnConfirm: false,
          closeOnCancel: false
        },function(isConfirm){
          if (isConfirm) {
            $.ajax({
              url: '../modules/addons/ticket_tag/ajax/ajax.php',
              type: 'POST',
              data: {ajaxcheck:'true',id:id, delete: 'deleteId',Check: isConfirm},
              dataType: 'json',
              success:function(response){
                swal("Deleted!", "Your imaginary file has been deleted.", "success");
                  target = "#"+id;
                  $(target).closest('tr').fadeOut("fast");
              }            
          }) 
          } else {
            swal("Cancelled", "Your imaginary file is safe :)", "error");
          }
        });       
    });

    
      $('.datatable').on('click', ".btnClick", function () {
        var id = $(this).data('id');
        var tag = $(this).data('tag');
        var color = $(this).data('color');
        console.log(id);
        $('#myModal input[name="tag_manager"]').val(tag);
        $('#myModal input[name="tag_color"]').val(color);
        $('#myModal input[name="tag_id"]').val(id);
        
        $(".UpdateSub").click(function(e){
           e.preventDefault();

            var tagManager = $('#myModal input[name="tag_manager"]').val();
            var tagColor = $('#myModal input[name="tag_color"]').val();

            $.ajax({
                url: '../modules/addons/ticket_tag/ajax/ajax.php',
                type: 'POST',
                data: {option:'updateData',id: id, tag_manager: tagManager, tag_color: tagColor },
                dataType: 'json',
                success:function(response){
                    console.log(response);
                    if (response.status === 'success') {
                      swal({
                        title: "Updated successfully!",
                        icon: "success",
                        confirmButtonColor: "#3085d6",
                        confirmButtonText: "Okay!"
                      },function(isConfirm){
                        if(isConfirm){
                          location.reload()
                        }
                      })
                    } else if (response.status !== 'error') {
                      swal("'Updation failed '")
                    }
                }
            })
        });
    });
});