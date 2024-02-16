<body>
<div>
    <center><h1>client</h1></center>         
  <table class="table table-hover">
    <thead>
      <tr class='info'>
        <th>Firstname</th>
        <th>Lastname</th>
        <th>Email</th>
        <th>Company Name</th>
        <th>Adress</th>
        <th>Status</th>
      </tr>
    </thead>
    <tbody>
        <?php 
 
        use WHMCS\Database\Capsule;
        
        $data = Capsule::table('tblclients')->get();
        $check=0;
        foreach($data as $element){
            if($check % 2 == 0){
                echo "<tr><td>".$element->firstname.'</td>';
                echo '<td>'.$element->lastname.'</td>';
                echo '<td>'.$element->email.'</td>';
                echo '<td>'.$element->companyname.'</td>';
                echo '<td>'.$element->postcode.', '.$element->city.', '.$element->state.'</td>';
                echo '<td>'.$element->status.'</td></tr>';     
                $check++;       
            } else{
                echo "<tr class='success' ><td>".$element->firstname.'</td>';
                echo '<td>'.$element->lastname.'</td>';
                echo '<td>'.$element->email.'</td>';
                echo '<td>'.$element->companyname.'</td>';
                echo '<td>'.$element->address1.'</td>';
                echo '<td>'.$element->status.'</td></tr>'; 
                $check++;       

            }
        }    
        ?>
     {@debug}
    </tbody>
  </table>
</div>


