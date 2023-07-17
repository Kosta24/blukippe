<script src="js/enteSingola.js" type="text/javascript"></script>
<div class="button-wrapper">
  <div class="button-pages" onclick="return changeSubTab(3);" >Vai a squadre</div>
  <div class="button-pages" onclick="return changeSubTab(2);" >Torna all'ente</div>
</div>
Admin Squadra

<br>
AGGIUNGERE MODIFICA E RIMOZIONE(CON RIMOZIONE SI INTENDE DISATTIVAZIONE)
<br>

<div class="Datatable_container">
    <table class="Datatable_table" id='table_squadre'>
            <thead>
            </thead>
            <tbody>
        </tbody>
        <tfoot>
        </tfoot>
    </table>
</div>

<?php
    $idSquadra = $_SESSION['condVar']["idSquadra"];
    $var = <<<HTML
        <script>

            getSquadre(0,$idSquadra);
            modificando = -1
        </script>
    HTML;

    echo $var;
?>