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
        <div class="row  mt-5">
            <h2>Detaile categorie : Categorie 1</h2>
        </div>
        <div class="row mt-2">
            <div class="col-md-6">
                <button class="btn btn-info text-white">Ajout fiche</button>
                <button class="btn btn-dark">Ajout Sous categorie</button>
            </div>
        </div>
        <div class="row mt-4">
            <h4>Liste des fiches</h4>
            <table class="table table-hover p-3">
                <tr>
                    <th>Libelle</th>
                    <th>Action</th>
                </tr>
                <tr>
                    <td>Fiche 1</td>
                    <td>
                        <a href="" class="btn btn-info">Editer</a>
                        <a href="" class="btn btn-danger">Suprimmer</a>
                    </td>
                </tr>
            </table>
        </div>
        <div class="row">
            <h4>Liste des sous categorie</h4>
            <div class="accordion" id="accordionExample">
              <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne">
                  <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    Sous categorie 1
                  </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                  <div class="accordion-body">
                  <div class="col-md-6">
                    <button class="btn btn-info text-white">Ajout fiche</button>
                    <button class="btn btn-dark">Ajout Sous categorie</button>
                  </div>
                  <div class="row mt-4">
                    <h4>Liste des fiches de ce sous categ</h4>
                    <table class="table table-hover p-3">
                        <tr>
                            <th>Libelle</th>
                            <th>Action</th>
                        </tr>
                        <tr>
                            <td>Fiche 1</td>
                            <td>
                                <a href="" class="btn btn-info">Editer</a>
                                <a href="" class="btn btn-danger">Suprimmer</a>
                            </td>
                        </tr>
                    </table>
                  </div>
                  <div class="row mt-4">
                    <h4>Liste des sous categorie</h4>
                    <table class="table table-hover p-3">
                        <tr>
                            <th>Libelle</th>
                            <th>Action</th>
                        </tr>
                        <tr>
                            <td>Sous</td>
                            <td>
                                <a href="" class="btn btn-info">Editer</a>
                                <a href="" class="btn btn-danger">Suprimmer</a>
                            </td>
                        </tr>
                    </table>
                </div>
                </div>
              </div>
              
            </div>
        </div>
        
    </div>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/js/bootstrap.min.js" integrity="sha512-1/RvZTcCDEUjY/CypiMz+iqqtaoQfAITmNSJY17Myp4Ms5mdxPS5UV7iOfdZoxcGhzFbOm6sntTKJppjvuhg4g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</html>