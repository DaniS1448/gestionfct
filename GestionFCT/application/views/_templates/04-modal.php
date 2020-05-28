<?php
if (sizeof($modals)>0) {echo "\n<!--- ======= Inicio modales ======= --->\n";}
foreach ($modals as $modal) {
    require_once 'modals/'.$modal.'.php';
}
if (sizeof($modals)>0) {echo "\n<!--- ======= Fin modales ======= --->\n";}
?>