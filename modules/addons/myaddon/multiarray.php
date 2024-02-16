<?php 
        
use WHMCS\Database\Capsule;

$data = Capsule::table('mod_menu_manager')->get();
echo "<pre>";

$dataObject = (object) $data;
$array = (array) $dataObject;
// print_r($array);
// foreach($data as $element) {
//     if($element->parent_id == NULL){
//     echo ' Array  (<br/>';

//     echo($element->menu_name."=>");
//     echo "<br>";
    
//     $parent_id = $element->id;
//     foreach($data as $element) {
//         if($element->parent_id == $parent_id){
//             echo("        [".$element->menu_name."]=>");
//     echo "<br>";

//             $innerParent_id = $element->id;
//             foreach($data as $element) {
//                 if($element->parent_id == $innerParent_id   ){
//                     echo("                    [".$element->menu_name.']');
//     echo "<br>";
//                 }
//              }
//         }

//      }
//     if($element->parent_id == $parent_id){
//         print_r($element);
//     }
//     }
// }

$ar = [];
foreach($data as $element) {
    if($element->parent_id == NULL){
    $ar[$element->menu_name] = NULL;
    $name = $element->menu_name;
    $parent_id = $element->id;
    foreach($data as $element) {
                if($element->parent_id == $parent_id){
                 $ar[$name][$element->menu_name] = NULL ;
                 $innerName = $element->menu_name;
                 $innerId = $element->id;
                 foreach($data as $element) {
                    if($element->parent_id == $innerId){
                     $ar[$name][$innerName] = $element->menu_name ;
                    }
                }
                }
            }
        }
}
print_r($ar);

?>