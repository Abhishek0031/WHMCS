    // $(document).ready(function(){
    // alert('hii')
    $('.btn').click(function(){
      var id = $(this).attr('id');
      console.log(id);
      $.ajax({
          url: '',
          method: 'POST',
          data: {
            table: id,
            ajaxMethdos: 'true' 
           },
           dataType:'json',
          success: function(response) {
            console.log( response); 
            var headHtml = '';
            var bodyHtml = '';
            var headingHtml = '';
            if(id == 'tblclients'){
              headingHtml = '<h1>Client</h1>';
              headHtml = " <tr class='table-info'><th>Firstname</th><th>Lastname</th><th>Email</th><th>Company Name</th><th>Address</th><th>Status</th></tr>";
              for (x in response){
                  bodyHtml = bodyHtml + "<tr><td>" + response[x]["firstname"] + 
                  "</td><td>" + response[x]["lastname"] + 
                  "</td><td>" + response[x]["email"] + 
                  "</td><td>" + response[x]["companyname"] + 
                  "</td><td>" + response[x]["address1"] + 
                  "</td><td>" + response[x]["status"] + "</td></tr>"
              }
            } else if(id == 'tbldomainpricing_premium'){
              headingHtml = '<h1>Invoice</h1>';
              headHtml = " <tr class='table-info'><th>ID</th><th>MARK UP</th><th>To Amount</th><th>Created At</th><th>Updated At</th></tr>";
              for (x in response){
                  bodyHtml = bodyHtml + "<tr><td>" + response[x]["id"] + 
                  "</td><td>" + response[x]["markup"] + 
                  "</td><td>" + response[x]["to_amount"] + 
                  "</td><td>" + response[x]["created_at"] + 
                  "</td><td>" + response[x]["updated_at"] + 
                  "</td></tr>"
              }
            } else if(id == 'tblproducts'){
              headingHtml = '<h1>Order</h1>';
              headHtml = " <tr class='table-info'><th>ID</th><th>Name</th><th>Type</th><th>Description</th><th>Short Description</th></tr>";
              for (x in response){
                  bodyHtml = bodyHtml + "<tr><td>" + response[x]["id"] + 
                  "</td><td>" + response[x]["name"] + 
                  "</td><td>" + response[x]["type"] + 
                  "</td><td>" + response[x]["description"] + 
                  "</td><td>" + response[x]["short_description"] + 
                  "</td></tr>"
              }
            }
            $('#content').hide();
            $('#show').html(headingHtml);
            $('thead').html(headHtml);
            $('tbody').html(bodyHtml);

          }
          });
    });
// });


