<body>
<div>
    <center><h1>client</h1></center>         
  <table class="table table-hover">
    <thead>
      <tr class='info'>
        <th>ID</th>
        <th>NAME</th>
        <th>TYPE</th>
        <th>description</th>
        <th>short_description</th>
      </tr>
    </thead>
    <tbody>
        <?php 
 
        use WHMCS\Database\Capsule;
        
        $data = Capsule::table('tblproducts')->get();
        $check=0;
        foreach($data as $element){
            if($check % 2 == 0){
                echo "<tr><td>".$element->id.'</td>';
                echo '<td>'.$element->name.'</td>';
                echo '<td>'.$element->type.'</td>';
                echo '<td>'.$element->description.'</td>';
                echo '<td>'.$element->short_description.'</td></tr>';     
                $check++;       
            } else{
                echo "<tr><td>".$element->id.'</td>';
                echo '<td>'.$element->name.'</td>';
                echo '<td>'.$element->type.'</td>';
                echo '<td>'.$element->description.'</td>';
                echo '<td>'.$element->short_description.'</td></tr>';     
                $check++;     
            }
        }    
        ?>
     
    </tbody>
  </table>
</div>


