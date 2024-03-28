<?php

namespace WHMCS\Module\Addon\MyAddon\Class;

use WHMCS\Database\Capsule;

class mymodule
{
    public function menuForm()
    {
        try {
            $parentMenu = null;

            if (isset($_POST['menu_type'])) {
                if ($_POST['menu_type'] == 'child_menu' && isset($_POST['child_menu'])) {
                    $parentMenu = $_POST['child_menu'];
                } elseif ($_POST['menu_type'] == 'sub_menu' && isset($_POST['parent_menu'])) {
                    $parentMenu = $_POST['parent_menu'];
                }
            }

            $insertData = [
                'parent_id' => $parentMenu,
                'menu_name' => $_POST['menu_name'],
                'menu_url' => $_POST['menu_url'],
                'menu_type' => $_POST['menu_type'],
                'icon' => $_POST['icon'],
                'menu_class' => $_POST['menu_class'],
                'status' => $_POST['menu_status'],
            ];

            Capsule::table('mod_menu_manager')->insert($insertData);

            return ['status' => 'success', 'message' => 'Success: Data inserted.'];

        } catch (Exception $e) {
            return ['status' => 'fail', 'message' => 'Failure: Data could not be inserted.'];
        }
    }

    public function getMenu($data){
        if (isset($data['type']) && ($data['type'] == 'sub_menu'||($data['type'] == 'child_menu' && !isset($data['value'])))) {
            $result = Capsule::table('mod_menu_manager')->where(['menu_type'=>'parent_menu'])->get();
            echo json_encode($result);
        } elseif(isset($data['value'])){
            $result = Capsule::table('mod_menu_manager')->where(['parent_id'=>$data['value']])->get();
            echo json_encode($result);
        } else {
            echo json_encode(['error' => 'Invalid selection']);
        }

        // echo $data;
    }

    public function dropDownGet(){
        $data = Capsule::table('mod_menu_manager')->where(['menu_type'=>'parent_menu'])->get();
        return $data;
    }

    public function getNavMenu($data){
        $result = Capsule::table('mod_menu_manager')->where(['parent_id'=>$data['parentId']])->get();
        echo json_encode($result);
    }

        public function imageStore(){
            try{
                $allowed_extensions = array(".jpg","jpeg",".png",".gif");
                $fileName = $_FILES["img"]["name"];
                $extension = substr($fileName,strlen($fileName)-4,strlen($fileName));
                $uplodeDir = '../modules/addons/myaddon/storage/image/'.$_POST['img_name'].$extension;
                
                if(!in_array($extension,$allowed_extensions)){
                    return "<script>alert('Invalid format. Only jpg / jpeg/ png /gif format allowed');</script>";
                } elseif($_FILES["img"]["size"] < 2000000) {
                    return "<script>alert('Image is larger in Size -> max size:-20Mb ');</script>";
                } else{
                    $check = move_uploaded_file($_FILES["img"]["tmp_name"],$uplodeDir);
                    return "image inserted"; 
                }
            }
            catch (Exception $e){
                return "fail to insert image";
            }
        }
        

public function dynamicNavMenue()
    {
        $parentCount = Capsule::table('mod_menu_manager')->where(['menu_type'=>'parent_menu'])->get() ;
        $mainArray = [];
        foreach($parentCount as $value) {
            $subCount = Capsule::table('mod_menu_manager')->where('parent_id',$value->id)->get();
            $parentArray = [
                'menu_name' => $value->menu_name,
                'menu_url' => $value->menu_url,
                'menu_type' => $value->menu_type,
                'icon' => $value->icon,
                'menu_class' => $value->menu_class,
                'menu_status' => $value->menu_status
            ];
            $subArray = [];
            foreach($subCount as $subValue) {
                $childCount = Capsule::table('mod_menu_manager')->where('parent_id',$subValue->id)->get();
                $subArrayMenu = [
                    'parent_id' => $subValue->parent_id,
                    'menu_name' => $subValue->menu_name,
                    'menu_url' => $subValue->menu_url,
                    'menu_type' => $subValue->menu_type,
                    'icon' => $subValue->icon,
                    'menu_class' => $subValue->menu_class,
                    'menu_status' => $subValue->menu_status
                ];
                $childArray = [];
                foreach($childCount as $childValue) {
                    $chilArrayMenu = [
                        'parent_id' => $childValue->parent_id,
                        'menu_name' => $childValue->menu_name,
                        'menu_url' => $childValue->menu_url,
                        'menu_type' => $childValue->menu_type,
                        'icon' => $childValue->icon,
                        'menu_class' => $childValue->menu_class,
                        'menu_status' => $childValue->menu_status
                    ];
                    $childArray[] = $chilArrayMenu;
                }
                $subArrayMenu['child_menu'] = $childArray;
                $subArray[] = $subArrayMenu;
                $parentArray['sub_menu'] = $subArray;
            }
            $mainArray[] = $parentArray;
        }
        return $mainArray;

    }

    public function clientGet($data){

    $record = Capsule::table($data['table'])->get();
    echo json_encode($record);


    }
}
?>