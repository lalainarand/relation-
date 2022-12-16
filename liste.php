<?php
include('db.php');
include('categorie.php');
include('ajout_fiche.php');
$obj = new Database();
if (isset($_POST['parent_id'])) {
    $id = $_POST['parent_id'];
} elseif (isset($_POST['Description'])) {
    $id = $_POST['categorie_id'];
} else {
    $id = $_GET['parent_id'];
}
$liste =  $obj->select('categories', '*', null, "parent_id='$id'", null, null);
$fiche =  $obj->select('fiches', '*', null, "categorie_id='$id'", null, null);
// var_dump($fiche);

if (isset($_POST['libelle'])) {
    $category = new Category();
    // var_dump($_POST);
    // die();
    $category->addcategory($_POST['libelle']);
    if ($category) {
        header('Location:' . $_SERVER['HTTP_REFERER']);
    }
}

if (isset($_POST['libelles'])) {
    //    var_dump($_POST) ;
    //     die();
    $id = $_POST['id'];
    $parent_id  = $_POST['parent_id'];
    $libelle = $_POST['libelles'];
    $obj->update('categories', [
        "libelle" => $libelle
    ], "id='$id'");

    header("Location: liste.php?parent_id=$parent_id");
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $id_categ = $obj->select('categories', 'id', null, "id = '$id'", null, null);

    foreach ($id_categ as $d) {
        $ids = $d['id'];
    }
    for ($i = $ids; $i < 1000; $i++) {
        $idd_categ = $obj->select('categories', 'id', null, "parent_id = $i", null, null);
        foreach ($idd_categ as $c) {
            $iiii = $c['id'];
            $obj->delete('categories', "id = '$iiii'");
            $obj->delete('fiches', "categorie_id = '$iiii'");
        }
    }

    $obj->delete('categories', "id = '$id'");
    $obj->delete('fiches', "categorie_id = '$id'");
    // $id_categ = $obj->select('categories', 'id', null, "id = '$id'", null, null);



    header('Location:' . $_SERVER['HTTP_REFERER']);
}

if (isset($_POST['Description'])) {
    $fiche = new fiches();
    $fiche->addfiche($_POST['Description']);
    if ($fiche) {
        header("location:" . $_SERVER['HTTP_REFERER']);
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/css/bootstrap.min.css" integrity="sha512-SbiR/eusphKoMVVXysTKG/7VseWii+Y3FdHrt0EpKgpToZeemhqHeZeLWLhJutz/2ut2Vw1uQEj2MbRF+TVBUA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <title>Document</title>
</head>

<body>

    <div class="container">
        <div class="row mt-5">
            <a href="javascript:history.go(-1)" class="btn btn-dark">Retour</a> 
            <?php if ($liste) : ?>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Libelle</th>
                            <th>Sous categorie</th>
                            <th>fiche</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php foreach ($liste as $f) : ?>
                            <tr>
                                <td><?= $f['libelle'] ?></td>
                                <td><a href="liste.php?parent_id=<?= $f['id'] ?>" class="btn btn-dark">Voir</a></td>
                                <td><a href="fiche.php?id=<?= $f['id'] ?>" class="btn btn-dark">Voir</a></td>
                                <td>
                                    <!-- <a href="" class="btn btn-warning">Editer</a>
                                <a href="" class="btn btn-danger">Supprimer</a>
                                <a href="" class="btn btn-info">Ajout fiche</a> -->
                                    <a href="" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#teste" onclick="getId(<?= $f['id'] ?>)">ajout s.categorie</a>
                                    <a href="" class="btn btn-info" onclick="edition('<?= $f['libelle'] ?>',<?= $f['id'] ?>,'<?= $f['parent_id'] ?>')" data-bs-toggle="modal" data-bs-target="#modalIdee">Editer</a>
                                    <a href="liste.php?delete=<?= $f['id'] ?>" class="btn btn-danger">Suprimmer</a>
                                    <!-- <a href="" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#teste" onclick="getId(<?= $f['id'] ?>)">ajout s.categorie</a> -->
                                    <a href="" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#fichier" onclick="getIdFiche(<?= $f['id'] ?>)">ajout fiche</a>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            <?php else : ?>
                <h4 class="text-center text-info">Y a pas de sous categorie</h4>
            <?php endif ?>
        </div>
        <div class="modal fade" id="teste" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTitleId">Ajout sous categorie</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="liste.php" method="post">
                            <div class="mb-3">
                                <label for="libelle" class="form-label">Libelle :</label>
                                <input type="text" name="libelle" id="" class="form-control" placeholder="" aria-describedby="helpId">
                                <!-- <input type="hidden" name="categorie_id" id="parent_id" class="form-control" placeholder="" aria-describedby="helpId"> -->

                                <input type="hidden" name="parent_id" id="parent_ids" class="form-control" placeholder="" aria-describedby="helpId">
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal fade" id="fichier" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTitleId">Ajout fiches</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="liste.php" method="post">
                            <div class="mb-3">
                                <label for="libelle" class="form-label">Libelle :</label>
                                <input type="text" name="labelle" id="labelle" class="form-control" placeholder="" aria-describedby="helpId">
                                <input type="hidden" name="categorie_id" id="categorie_id" class="form-control" placeholder="" aria-describedby="helpId">
                            </div>
                            <div class="mb-3">
                                <label for="Description" class="form-label">Description :</label>
                                <input type="text" name="Description" id="Description" class="form-control" placeholder="" aria-describedby="helpId">
                            </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalIdee" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitleId">Edition categorie</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="liste.php" method="post">
                        <div class="mb-3">
                            <label for="" class="form-label">Libelle :</label>
                            <input type="text" name="libelles" id="nom" class="form-control" placeholder="" aria-describedby="helpId">
                            <input type="hidden" name="id" id="id" class="form-control" placeholder="" aria-describedby="helpId">
                            <input type="hidden" name="parent_id" id="parents" class="form-control" placeholder="" aria-describedby="helpId">

                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.2/jquery.min.js" integrity="sha512-tWHlutFnuG0C6nQRlpvrEhE4QpkG1nn2MOUMWmUeRePl4e3Aki0VB6W1v3oLjFtd0hVOtRQ9PHpSfN6u6/QXkQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/js/bootstrap.min.js" integrity="sha512-1/RvZTcCDEUjY/CypiMz+iqqtaoQfAITmNSJY17Myp4Ms5mdxPS5UV7iOfdZoxcGhzFbOm6sntTKJppjvuhg4g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(document).ready(function() {
            // const myModal = new bootstrap.Modal(document.getElementById('fichier'), options)
            $('#fichier').modal('hide');
        });

        function getId(parent_id) {
            document.getElementById('parent_ids').value = parent_id;
        }

        function edition(nom, id, parent_id) {
            document.getElementById('nom').value = nom;
            document.getElementById('id').value = id;
            document.getElementById('parents').value = parent_id;
        }

        function getIdFiche(parent_id) {
            document.getElementById('categorie_id').value = parent_id;
        }
    </script>
</body>