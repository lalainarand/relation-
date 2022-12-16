<?php
 
        class Category 
        {

            public function addcategory($libelle) 
                {
                  $obj = new Database();
                  $obj->insert('categories', $_POST);
                }
         }
        

?>