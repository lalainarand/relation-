<?php
include('../db.php');
$obj = new Database();

//affichage des listes fiches

if (isset($_POST['categorie_id'])) {
    $id = $_POST['categorie_id'];
} else {
    $id = $_GET['id'];
}
$fiche =  $obj->select('fiches', '*', null, "categorie_id='$id'", null, null);
// $categories = $obj->select('categories', '*', null, "id='$id'", null, null);
// foreach ($categories as $cat) {
//     $nom = $cat['libelle'];
//     $tes = $cat['id'];
// }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/css/bootstrap.min.css" integrity="sha512-SbiR/eusphKoMVVXysTKG/7VseWii+Y3FdHrt0EpKgpToZeemhqHeZeLWLhJutz/2ut2Vw1uQEj2MbRF+TVBUA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <title>Gestion categorie</title>
</head>

<body>

    <div class="container">
        <div class="row mt-5">
            <a href="javascript:history.go(-1)" class="btn btn-dark">Retour</a>
        </div>
        <div class="row mt-5">
            <h4>Liste des fiche </h4>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Libelle</th>
                        <th>Description</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($fiche as $f) : ?>
                        <tr>
                            <td><?= $f['labelle'] ?></td>
                            <td><?= $f['description'] ?></td>
                            <td>
                                <a href="" data-bs-toggle="modal" data-bs-target="#edit_fiche" onclick="editer('<?= $f['labelle'] ?>','<?= $f['description'] ?>',<?= $f['id'] ?>,<?= $f['categorie_id'] ?>)" class="btn btn-info">Editer</a>
                                <a href="../controller/ficheController.php?delete=<?= $f['id'] ?>" class="btn btn-danger">Supprimer</a>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="modal fade" id="edit_fiche" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitleId">Edition de fiche</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="../controller/ficheController.php" method="post">
                        <div class="mb-3">
                            <label for="" class="form-label">Libelle :</label>
                            <input type="text" name="labelles" id="labelle" class="form-control" placeholder="" aria-describedby="helpId">
                            <input type="hidden" name="id" id="id" class="form-control" placeholder="" aria-describedby="helpId">
                            <input type="hidden" name="categorie_id" id="categorie_id" class="form-control" placeholder="" aria-describedby="helpId">
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label">description :</label>
                            <input type="text" name="descriptions" id="description" class="form-control" placeholder="" aria-describedby="helpId">
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/js/bootstrap.min.js" integrity="sha512-1/RvZTcCDEUjY/CypiMz+iqqtaoQfAITmNSJY17Myp4Ms5mdxPS5UV7iOfdZoxcGhzFbOm6sntTKJppjvuhg4g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        function editer(labelle, description, id, categorie_id) {
            document.getElementById('labelle').value = labelle;
            document.getElementById('description').value = description;
            document.getElementById('id').value = id;
            document.getElementById('categorie_id').value = categorie_id;
        }
    </script>
</body>

</html>