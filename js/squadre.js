var showOverlayBtn = document.getElementById("showOverlayButton");
var closeOverlayBtn = document.getElementById("closeOverlayBtn");
var clearOverlayBtn = document.getElementById("clearOverlayBtn");
var overlayContent = document.getElementById("overlayContent");
var overlay = document.getElementById("Squadreoverlay");

var showOverlayBtn2 = document.getElementById("showOverlayButton2");
var closeOverlayBtn2 = document.getElementById("closeOverlayBtn2");
var clearOverlayBtn2 = document.getElementById("clearOverlayBtn2");
var overlayContent2 = document.getElementById("overlayContent2");
var overlay2 = document.getElementById("Squadreoverlay2");

var sendRicercaBtn  = document.getElementById("sendRicercaBtn");
var sendAggiungiBtn  = document.getElementById("sendAggiungiBtn");


function initDataTableSquadre() {
    $("#table_squadre thead tr").addClass("filters").appendTo("#table_squadre thead");
  
    var table = $("#table_squadre").DataTable({
      "pageLength": 25,
      "order": [
        [1, "asc"]
      ],
      SorderCellsTop: true,
      fixedHeader: true,
      fixedHeader: {
        header: true,
        footer: true
      },
      colReorder: false,
      scrollY: 700,
      scrollCollapse: true,
      scroller: true,
      dom: 'Bfrtip',
      buttons: [
        'copy', 'excel', 'pdf'
      ]
    });
 
    return table;
  }

//Loads people gradually
function loadTableSquadre() {
  ricercaSquadre(15);
    setTimeout(function () { ricercaSquadre(25) }, 100);
    setTimeout(function () { ricercaSquadre(100) }, 250);
    setTimeout(function () { ricercaSquadre(0) }, 750);
  }


  function setSquadra(id) {
    $.ajax({
      type: "post",
      url: "php/functions/enti.php",
      dataType: 'json',
      cache: false,
      data: {
        function: "setSquadra",
        id: id,
      },
      success: function (returnedData) {
        //console.log("gg")
        changeSubTab(4);
      },
      error: function () {
        alert('Error while request..! try again');
      }
    });
  }
//Populates the table with people from the DB
function getSquadre(limit,id) {
    $.ajax({
      type: "post",
      url: "php/functions/enti.php",
      dataType: 'json',
      cache: false,
      data: {
        function: "getSquadre",
        id: id,
        limit: limit,
      },
      success: function (returnedData) {
        var table = $('#table_squadre').DataTable();
        table.clear();
  
        var myTableArray = [];
        var result = returnedData;
       for (var i = 0; i < result.length; i++) {
        //print(result[i]["nome"])
         myTableArray.push([result[i]["nome"],result[i]["id"], result[i]["atleti"], result[i]["reps"], result[i]["referente"], result[i]["tariffaBase"], result[i]["disciplina"]]);
         //modifica e rimuovi
          //'<div style="text-align: center;"><i id="' + result[i]["id"] + '" class="fa-solid fa-pen" value = "Modifica" onClick="Javascript:console.log(this,' + i + ',0)" style="cursor:pointer; color:#00623b"></i></div>',
          //'<div style="text-align: center;"><i class="fa-solid fa-user-minus" value = "Rimuovi"  onClick="Javascript:console.log(this,' + result[i]["id"] + ')" style="cursor:pointer; color:#D8000C;text-align: center;"></i></div>');
          
        }
  
        table.rows.add(myTableArray);
        //table.column(1).visible(false);
        table.draw(false);
      },
      error: function () {
        alert('Error while request..! try again');
      }
    });
  }


//questa funzione è mantenuta e non usata una singola volta perchè questa è specifica per la ricerca
//multi riga mentre getSquadre è usata solamente per  la ricerca singola
function ricercaSquadre(limit) {
  $.ajax({
    type: "post",
    url: "php/functions/enti.php",
    dataType: 'json',
    cache: false,
    data: {
      function: "getSquadre",
      id              : document.getElementById("squadreRicerca_id").value,
      nome            : document.getElementById("squadreRicerca_nome").value,
      atleti          : document.getElementById("squadreRicerca_atleti").value,
      reps            : document.getElementById("squadreRicerca_reps").value,
      fk_referente    : document.getElementById("squadreRicerca_fk_referente").value,
      fk_tariffaBase  : document.getElementById("squadreRicerca_fk_tariffaBase").value,
      fk_disciplina   : document.getElementById("squadreRicerca_fk_disciplina").value,
      limit: limit,
    },
    success: function (returnedData) {
      var table = $('#table_squadre').DataTable();
      table.clear();

      var myTableArray = [];
      var result = returnedData;
     for (var i = 0; i < result.length; i++) {
        //console.log(result[i])
        myTableArray.push([result[i]["nome"],result[i]["id"], result[i]["atleti"], result[i]["reps"], result[i]["referente"], result[i]["tariffaBase"], result[i]["disciplina"] ]);
        //modifica e rimuovi
        //'<div style="text-align: center;"><i id="' + result[i]["id"] + '" class="fa-solid fa-pen" value = "Modifica" onClick="Javascript:modify_person(this,' + i + ',0)" style="cursor:pointer; color:#00623b"></i></div>',
        //'<div style="text-align: center;"><i class="fa-solid fa-user-minus" value = "Rimuovi"  onClick="Javascript:delete_person(this,' + result[i]["id"] + ')" style="cursor:pointer; color:#D8000C;text-align: center;"></i></div>'
        
      }

      table.rows.add(myTableArray);
      table.column(1).visible(false);
      table.draw(false);
    },
    error: function () {
      alert('Error while request..! try again');
    }
  });
}



function aggiungiSquadra(limit) {
    $.ajax({
      type: "post",
      url: "php/functions/enti.php",
      dataType: 'json',
      cache: false,
      data: {
        function: "aggiungiSquadra",
        nome            : document.getElementById("squadreAggiungi_nome").value,
        atleti          : document.getElementById("squadreAggiungi_atleti").value,
        reps            : document.getElementById("squadreAggiungi_reps").value,
        fk_referente    : document.getElementById("squadreAggiungi_fk_referente").value,
        fk_tariffaBase  : document.getElementById("squadreAggiungi_fk_tariffaBase").value,
        fk_disciplina   : document.getElementById("squadreAggiungi_fk_disciplina").value,
        limit: limit,
      },
      success: function (returnedData) {
        //console.log(returnedData);
        ricercaSquadre(0);
      },
      error: function () {
        alert('Error while request..! try again');
      }
    });
  }
  


function pulisciRicercaSquadre(){
  document.getElementById("squadreRicerca_id").value = "";
  document.getElementById("squadreRicerca_nome").value = "";
  document.getElementById("squadreRicerca_atleti").value = "";
  document.getElementById("squadreRicerca_reps").value = "";
  document.getElementById("squadreRicerca_fk_referente").value = "";
  document.getElementById("squadreRicerca_fk_tariffaBase").value = "";
  document.getElementById("squadreRicerca_fk_disciplina").value = "";
}

function pulisciAggiuntaSquadre(){
    document.getElementById("squadreAggiungi_nome").value = "";
    document.getElementById("squadreAggiungi_atleti").value = "";
    document.getElementById("squadreAggiungi_reps").value = "";
    document.getElementById("squadreAggiungi_fk_referente").value = "";
    document.getElementById("squadreAggiungi_fk_tariffaBase").value = "";
    document.getElementById("squadreAggiungi_fk_disciplina").value = "";
  }

//row
$(document).ready(function() {
  var table = $('#table_squadre').DataTable();

  $('#table_squadre tbody').on('click', 'tr', function() {
    var rowData = table.row(this).data();
    //console.log(rowData[1]);
    setSquadra(rowData[1]);
  });
});

//nascondi mostra overlay
  closeOverlayBtn.addEventListener("click", function() {
    overlay.style.height = "0%";
  });

  sendRicercaBtn.addEventListener("click", function() {
    ricercaSquadre(0);
    overlay.style.height = "0%";
  });

  clearOverlayBtn.addEventListener("click", function() {
    pulisciRicercaSquadre();
    ricercaSquadre(0);
  });

  showOverlayBtn.addEventListener("click", function() {
    overlay.style.height = "100%";
  });
  

  //controlla se viene selezionato un elemento dentro a loverlay content
   overlayContent.addEventListener('click', e => {
    if(e.target !== e.currentTarget) ;//console.log("child clicked") 
    else overlay.style.height = "0%";
  })
//controlla se viene selezionato un elemento dentro l'overlay
  overlay.addEventListener('click', e => {
    if(e.target !== e.currentTarget) ;//console.log("child clicked") 
    else overlay.style.height = "0%";
  })





//AGGIUNTA
  
//nascondi mostra overlay
closeOverlayBtn2.addEventListener("click", function() {
    overlay2.style.height = "0%";
  });

  sendAggiungiBtn.addEventListener("click", function() {
    aggiungiSquadra(0);
    
    pulisciAggiuntaSquadre();
    overlay2.style.height = "0%";
  });

  clearOverlayBtn2.addEventListener("click", function() {
    pulisciAggiuntaSquadre();
  });

  showOverlayBtn2.addEventListener("click", function() {
    overlay2.style.height = "100%";
  });
  

  //controlla se viene selezionato un elemento dentro a loverlay content
   overlayContent2.addEventListener('click', e => {
    if(e.target !== e.currentTarget) ;//console.log("child clicked") 
    else overlay2.style.height = "0%";
  })
//controlla se viene selezionato un elemento dentro l'overlay
  overlay2.addEventListener('click', e => {
    if(e.target !== e.currentTarget) ;//console.log("child clicked") 
    else overlay2.style.height = "0%";
  })

