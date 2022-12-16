<?php
include('db.php');
include('categorie.php');
$obj = new Database();                
if (isset($_POST['parent_id'])) {
    $id = $_POST['parent_id'];
} else {
    $id = $_GET['parent_id'];
}
$liste =  $obj->select('categories', '*', null, "parent_id='$id'", null, null);

if (isset($_POST['libelle'])) {
    $category = new Category();
    // var_dump($_POST);
    // die();
    $category->addcategory($_POST['libelle']);
    if ($category) {
        header("Location: liste.php?parent_id=$id");
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
            <?php if ($liste) : ?>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Libelle</th>
                            <th>Sous categorie</th>
                            <th>Fiche</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php foreach ($liste as $f) : ?>
                            <tr>
                                <td><?= $f['libelle'] ?></td>
                                <td><?= $f['parent_id'] ?></td>
                                <td><a href="" class="btn btn-dark">Voir</a></td>
                                <td><a href="" class="btn btn-dark">Voir</a></td>
                                <td>
                                    <!-- <a href="" class="btn btn-warning">Editer</a>
                                <a href="" class="btn btn-danger">Supprimer</a>
                                <a href="" class="btn btn-info">Ajout fiche</a> -->
                                    <a href="" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#teste" onclick="getId(<?=$f['id'] ?>)">ajout s.categorie</a>
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
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/js/bootstrap.min.js" integrity="sha512-1/RvZTcCDEUjY/CypiMz+iqqtaoQfAITmNSJY17Myp4Ms5mdxPS5UV7iOfdZoxcGhzFbOm6sntTKJppjvuhg4g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        function getId(parent_id) {
            document.getElementById('parent_ids').value = parent_id;
        }
    </script>
</body>