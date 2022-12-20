<?php 
include_once('../modele/categorie.php');
include('../modele/db.php');
$obj = new Database();


//ajout nouveau categorie

if (isset($_POST['libelle'])) {
    $category = new Category();
 
    $category->addcategory($_POST['libelle']);
        if ($category) {
            header("location:".$_SERVER['HTTP_REFERER']);
        }
    }
    
    //update de categorie

    if (isset($_POST['libelles'])) {
        $id = $_POST['id'];
        $libelle = $_POST['libelles'];
        $obj->update('categories', [
            "libelle" => $libelle
        ], "id='$id'");
        header("location:".$_SERVER['HTTP_REFERER']);
    }


     //suppression categories

     if (isset($_GET['delete'])) {
        $id = $_GET['delete'];
        $id_categ = $obj->select('categories', 'id', null, "id = $id", null, null);
        foreach($id_categ as $d){
            $ids= $d['id']; 
        }
        for($i = $ids;$i<1000;$i++){
            $idd_categ = $obj->select('categories', 'id', null, "parent_id = $i", null, null);
            foreach($idd_categ as $c){
                $iiii = $c['id'];
                $obj->delete('categories', "id = '$iiii'");
                $obj->delete('fiches', "categorie_id = '$iiii'");
            }
        }
        $obj->delete('categories', "id = '$ids'");
        $obj->delete('fiches', "categorie_id = '$ids'");
        header("location:".$_SERVER['HTTP_REFERER']);
    }
    
 