<?php
include('db.php');
include('categorie.php');
include('ajout_fiche.php');

$obj = new Database();

//ajout fiches

if (isset($_POST['Description'])) {
     $fiche = new fiches();
     $fiche ->addfiche($_POST['Description']);
    if ($fiche) {
        header('Location: index.php');
    }
}

//ajout categories

if (isset($_POST['libelle'])) {
   $category = new Category();
//    var_dump($_POST) ;
//    die();
   $category->addcategory($_POST['libelle']);
    if ($category) {
        header('Location: index.php');
    }
}

//selection categories

$categories = $obj->select('categories', '*', null, "parent_id=0", null, null);

//update categories

if (isset($_POST['libelles'])) {
    $id = $_POST['id'];
    $libelle = $_POST['libelles'];
    $obj->update('categories', [
        "libelle" => $libelle
    ], "id='$id'");
    header('Location: index.php');
}

//suppression categories

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $obj->delete('categories', "id = '$id'");
    header('Location: index.php');
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/css/bootstrap.min.css" integrity="sha512-SbiR/eusphKoMVVXysTKG/7VseWii+Y3FdHrt0EpKgpToZeemhqHeZeLWLhJutz/2ut2Vw1uQEj2MbRF+TVBUA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Test</title>
</head>

<body>
    <div class="container">
        <div class="row mt-5">
            <h4>Ajout categorie</h4>
            <form action="index.php" method="post">
                <div class="form-gourp">
                    <div class="mb-3">
                        <label for="" class="form-label">Nom categorie :</label>
                        <input type="text" name="libelle" id="" class="form-control" placeholder="" aria-describedby="helpId">
                    </div>
                    <button class="btn btn-primary">Ajouter</button>
            </form>
        </div>
    </div>
    <div class="row mt-3">
        <h4>Vos categorie principales:</h4>
        <?php if ($categories) : ?>
            <table class="table table-hover ">
                <thead>
                    <tr>
                        <th>Noms</th>
                        <th>Sous categorie</th>
                        <th>Fiche</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($categories as $categorie) : ?>
                        <tr>
                            <td><?= $categorie['libelle'] ?></td>
                            <td><a href="liste.php?parent_id=<?= $categorie['id'] ?>" class="btn btn-dark">Voir</a></td>
                            <td><a href="fiche.php?id=<?= $categorie['id'] ?>" class="btn btn-dark">Voir</a></td>
                            <td>
                            <a href="" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#sous_cat" onclick="sous_cat(<?= $categorie['id'] ?>)">ajout s.categorie</a>
                                <a href="" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#fiche" onclick="fiche(<?= $categorie['id'] ?>)">ajout fiche</a>
                                <a href="" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#modalId" onclick="editer('<?= $categorie['libelle'] ?>',<?= $categorie['id'] ?>)">Editer</a>
                                <a href="index.php?delete=<?= $categorie['id'] ?>" class="btn btn-danger">Suprimmer</a>
                            </td>
                        </tr>
                    <?php endforeach ?>

                </tbody>
            </table>
        <?php else : ?>
            <h4>Vous n'avez pas de categorie</h4>
        <?php endif ?>
    </div>
    </div>

    <div class="modal fade" id="modalId" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitleId">Edition categorie</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="index.php" method="post">
                        <div class="mb-3">
                            <label for="" class="form-label">Libelle :</label>
                            <input type="text" name="libelles" id="nom" class="form-control" placeholder="" aria-describedby="helpId">
                            <input type="hidden" name="id" id="id" class="form-control" placeholder="" aria-describedby="helpId">
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
    <div class="modal fade" id="fiche" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitleId">Ajout fiches</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="index.php" method="post">
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
    <div class="modal fade" id="sous_cat" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitleId">Ajout sous categorie</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <form action="index.php" method="post">
                        <div class="mb-3">
                            <label for="libelle" class="form-label">Libelle :</label>
                            <input type="text" name="libelle" id="" class="form-control" placeholder="" aria-describedby="helpId">
                            <input type="hidden" name="parent_id" id="ids" class="form-control" placeholder="" aria-describedby="helpId">
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

    <!-- Optional: Place to the bottom of scripts -->
    <script>
        const myModal = new bootstrap.Modal(document.getElementById('modalId'), options)

        function editer(nom, id) {
            document.getElementById('nom').value = nom;
            document.getElementById('id').value = id;
        }

        function fiche(id) {
            document.getElementById('categorie_id').value = id;

        }
        function sous_cat(id)
        {
            document.getElementById('ids').value = id;

        }
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/js/bootstrap.min.js" integrity="sha512-1/RvZTcCDEUjY/CypiMz+iqqtaoQfAITmNSJY17Myp4Ms5mdxPS5UV7iOfdZoxcGhzFbOm6sntTKJppjvuhg4g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>

</html>