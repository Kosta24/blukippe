<?php
if($_SESSION["grado"] == 10000){
    $tabsVar = <<< HTML
        <div class="row" id="tabs">
            <div onclick="document.getElementById('menu').value=1; return changeTab('tab1');" class="col tab">Eventi</div>
            <div onclick="document.getElementById('menu').value=1; return changeTab('tab2');" class="col tab">Registro</div>
            <div onclick="document.getElementById('menu').value=1; return changeTab('tab3');" class="col tab">Enti</div>
            <div onclick="document.getElementById('menu').value=1; return changeTab('tab4');" class="col tab">Logs</div>
        
                <select class="col tab" id="menu" onchange="changeTab('tab5');changeSubTab(this.value);changeTab('tab5');">
                    <option value="1">Altre</option>
                    <option value="1">Utenti</option>
                    <option value="2">Extra</option>
                    <option value="3">Tariffe</option>
                    <option value="4">Locali</option>
                    <option value="5">Attività</option>
                    <option value="6">Affiliazioni</option>
                    <option value="7">Fam. Affilia...</option>
                    <option value="8">Discipline</option>
                </select>
        
        </div>
       HTML;
}

else if($_SESSION["grado"] == 1000){
    $tabsVar = <<< HTML
        <div class="row" id="tabs">
            <div onclick="document.getElementById('menu').value=1; return changeTab('tab1');" class="col tab">Eventi</div>
            <div onclick="document.getElementById('menu').value=1; return changeTab('tab2');" class="col tab">Registro</div>
            <div onclick="document.getElementById('menu').value=1; return changeTab('tab3');" class="col tab">Enti</div>
  
            <select class="col tab" id="menu" onchange="changeSubTab(this.value);changeTab('tab4');">
                <option value="1">Altre</option>
                <option value="1">Extra</option>
                <option value="2">Tariffe</option>
                <option value="3">Locali</option>
                <option value="4">Attività</option>
                <option value="5">Affiliazioni</option>
                <option value="6">Fam. Affilia...</option>
                <option value="7">Discipline</option>
            </select>
       
        </div>
    HTML;
}
else if($_SESSION["grado"] == 100){
    $tabsVar = <<< HTML
        <div class="row" id="tabs">
            <div onclick="return changeTab('tab1');" class="col tab">Eventi</div>
            <div onclick="return changeTab('tab2');" class="col tab">Registro</div>
            <div onclick="return changeTab('tab3');" class="col tab">Enti</div>
        </div>
    HTML;
}
else if($_SESSION["grado"] == 10){
    $tabsVar = <<< HTML
        <div class="row" id="tabs">
            <div onclick="return changeTab('tab1');" class="col tab">Eventi</div>
            <div onclick="return changeTab('tab2');" class="col tab">Enti</div>
        </div>
    HTML;
}
else if($_SESSION["grado"] == 1){
    $tabsVar = <<< HTML
        <div class="row" id="tabs">
            <div onclick="return changeTab('tab1');" class="col tab">Eventi</div>
        </div>
    HTML;
}
else $tabsVar  = "No Permission";


echo '<div class="container-fluid tab-wrapper">';
echo $tabsVar;
echo "</div>";