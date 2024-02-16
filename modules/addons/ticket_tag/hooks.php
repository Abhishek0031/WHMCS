<?php 

use WHMCS\Database\Capsule;

add_hook('AdminAreaHeadOutput', 1, function($vars) {
 
    if(($vars['pagetemplate'] == 'viewticket' )){
        $result =  Capsule::table('mod_tag_manager')->get();
        $ticketTagValue =  Capsule::table('mod_assign_tag_ticket')->where("ticket_id", $vars["ticketid"])->first();

        $html .= '<select id="tagvalue" class="btn btn-default"><option value="" selected>Select Tag</option>';
        foreach($result as $value) {          
            if($value->id == $ticketTagValue->tag_id){      
            $html.= '<option value="'.$value->id.'" selected>'.$value->tag_manager.'</option>';  
        }  else{
                $html.= '<option value="'.$value->id.'">'.$value->tag_manager.'</option>';  

            }
        }
       $html.=  '</select>';
       
       $return = "<script>
         $(document).ready(function(){
            let ticket_id = '$vars[ticketid]';
            let tagList='$html';
            $('.dropdown.btns-padded').append(tagList);
            $('#tagvalue').on('change',function(){
                let tag_id = $(this).val();
                $.ajax({
                    url:'../modules/addons/ticket_tag/ajax/ajax.php',
                    type: 'POST',
                    data: {addTag: 'tagAdd', tag_id,ticket_id},
                    success:function(response){
                        jQuery.growl.notice({ title: 'Success', message: response});                       
                    }
                });
            })
         })
         </script>";
         return $return;
    }



    if($vars['filename'] == 'supporttickets'){

        $resultValue = Capsule::table('mod_tag_manager')
            ->join('mod_assign_tag_ticket', 'mod_tag_manager.id', '=', 'mod_assign_tag_ticket.tag_id')
            ->select(
                'mod_assign_tag_ticket.ticket_id',
                'mod_tag_manager.tag_color',
                'mod_tag_manager.tag_manager'
            )
            ->get();
            $htmlTdTable=[];
            foreach ($resultValue as $value) {
                
                $htmlTdTable[$value->ticket_id]= '<td style="background:' . $value->tag_color . '">' . $value->tag_manager . '</td>';
            }
            $htmlTdTable = json_encode($htmlTdTable);
        $return = "<script>
         $(document).ready(function(){
            let htmlTdTable = ".$htmlTdTable.";

            $('#sortabletbl2 tr th:nth-child(3)').after('<th>Tag</th>');
            
            $('#sortabletbl2 tbody tr').each(function(index, value){
                let ticketId = $(this).find('input').val();

                $(this).find('td:nth-child(3)').after('<td> -- </td>');

                for(x in htmlTdTable) {
                    if(ticketId == x){
                        $(this).find('td:nth-child(4)').remove();
                        $(this).find('td:nth-child(3)').after(htmlTdTable[x]);
                    }
                }
                
            })
            
        })

         </script>";
         return $return;
    }

    

    // echo '<pre>';
    // print_r($vars);
    // die();
});
