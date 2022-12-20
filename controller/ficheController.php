<?php 
include_once('../modele/ajout_fiche.php');
include_once('../modele/db.php');
$obj = new Database();

 //ajout fiches

 if (isset($_POST['Description'])) {
    $fiche = new fiches();
    $fiche ->addfiche($_POST['Description']);
    if ($fiche) {
        header("location:".$_SERVER['HTTP_REFERER']);
    }
}


//mise à jour de  fiche

if (isset($_POST['descriptions'])) {
    $id = $_POST['id'];
    $labelle = $_POST['labelles'];
    $description = $_POST['descriptions'];
    $categorie_id = $_POST['categorie_id'];
    $obj->update('fiches', [
        "labelle" => $labelle,
        "description" => $description
    ], "id='$id'");
    header("location:" . $_SERVER['HTTP_REFERER']);
}



//suppression de fiche

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $obj->delete('fiches', "id = '$id'");
    header("location:" . $_SERVER['HTTP_REFERER']);
}