<script src="libs/jquery/jquery-3.2.1.slim.min.js" type="text/javascript"></script>
<script src="libs/ajax/jquery.min.js" type="text/javascript"></script>
<script src="libs/bootstrap5/js/bootstrap.bundle.min.js" type="text/javascript"></script>
<script src="libs/datatables/datatables.min.js" type="text/javascript"></script>
<script src="libs/fontawesome/8d48ca70e8.js" crossorigin="anonymous"></script>


<script src="js/index.js"></script>
<?php
//se eri già su una pagina quando ricarichi ti rimette li altrimenti pagina principale
if(isset($_SESSION['tab'])){
    $var = <<< HTML
        <script>
          setTimeout(function() {
            changeTab("{$_SESSION['tab']}");
            setSelectedTab("{$_SESSION['tab']}")
          }, 100);
        </script>
    HTML;
}
else{
  $var = <<< HTML
    <script>
      setTimeout(function() {
        changeTab("tab1")
        setSelectedTab("1")
      }, 10 0);
    </script>
  HTML;
}
echo $var;

?>


</html>