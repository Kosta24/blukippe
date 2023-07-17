<script src="js/enteSingola.js" type="text/javascript"></script>

<div class="button-wrapper">
  <div class="button-pages" onclick="return changeSubTab(3);" >Vai a squadre</div>
  <div class="button-pages" onclick="return changeSubTab(1);" >Torna a tutte le enti</div>
</div>
Admin Ente

<br>
AGGIUNGERE MODIFICA E RIMOZIONE(CON RIMOZIONE SI INTENDE DISATTIVAZIONE)
<br>

<div class="Datatable_container">
    <table class="Datatable_table" id='table_enti'>
            <thead>
            </thead>
            <tbody>
        </tbody>
        <tfoot>
        </tfoot>
    </table>
</div>

<?php
    $idEnte = $_SESSION['condVar']["idEnte"];
    $var = <<<HTML
        <script>

            getEnti(0,$idEnte);
            modificando = -1
        </script>
    HTML;

    echo $var;
?>