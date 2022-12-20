<?php
 
        class fiches
        {

            public function addfiche($libelle) 
                {
                  $obj = new Database();
                  $fiche = $obj->insert('fiches', $_POST);
                }
         }
        

?>