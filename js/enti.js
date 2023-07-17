var showOverlayBtn = document.getElementById("showOverlayButton");
var closeOverlayBtn = document.getElementById("closeOverlayBtn");
var clearOverlayBtn = document.getElementById("clearOverlayBtn");
var overlayContent = document.getElementById("overlayContent");
var overlay = document.getElementById("Entioverlay");
var sendRicercaBtn  = document.getElementById("sendRicercaBtn");

function initDataTableEnti() {
    $("#table_enti thead tr").addClass("filters").appendTo("#table_enti thead");
  
    var table = $("#table_enti").DataTable({
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
function loadTableEnti() {
     ricercaEnti(15);
    setTimeout(function () {ricercaEnti(25)} , 100);
    setTimeout(function () {ricercaEnti(100)}, 250);
    //setTimeout(function () {ricercaEnti(0) } , 750);
  }


  function setEnte(id) {
    $.ajax({
      type: "post",
      url: "php/functions/enti.php",
      dataType: 'json',
      cache: false,
      data: {
        function: "setEnte",
        id: id,
      },
      success: function (returnedData) {
        //console.log("gg")
        changeSubTab(2);
      },
      error: function () {
        alert('Error while request..! try again');
      }
    });
  }
//Populates the table with people from the DB
function getEnti(limit,id) {
    $.ajax({
      type: "post",
      url: "php/functions/enti.php",
      dataType: 'json',
      cache: false,
      data: {
        function: "getEnti",
        id: id,
        limit: limit,
      },
      success: function (returnedData) {
        var table = $('#table_enti').DataTable();
        table.clear();
  
        var myTableArray = [];
        var result = returnedData;
       for (var i = 0; i < result.length; i++) {
        //print(result[i]["nome"])
          myTableArray.push([result[i]["id"],result[i]["nome"], result[i]["SDI"], result[i]["citta"], result[i]["provincia"], result[i]["telefono"], result[i]["cellulare"], result[i]["pec"], result[i]["email"]],
          //modifica e rimuovi
          '<div style="text-align: center;"><i id="' + result[i]["id"] + '" class="fa-solid fa-pen" value = "Modifica" onClick="Javascript:console.log(this,' + i + ',0)" style="cursor:pointer; color:#00623b"></i></div>',
          '<div style="text-align: center;"><i class="fa-solid fa-user-minus" value = "Rimuovi"  onClick="Javascript:console.log(this,' + result[i]["id"] + ')" style="cursor:pointer; color:#D8000C;text-align: center;"></i></div>');
          
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
//multi riga mentre getEnti è usata solamente per  la ricerca singola
function ricercaEnti(limit) {
  $.ajax({
    type: "post",
    url: "php/functions/enti.php",
    dataType: 'json',
    cache: false,
    data: {
      function: "getEnti",
      id         : document.getElementById("entiRicerca_id").value,
      nome       : document.getElementById("entiRicerca_nome").value,
      pIva       : document.getElementById("entiRicerca_pIva").value,
      codFisc    : document.getElementById("entiRicerca_codFisc").value,
      SDI        : document.getElementById("entiRicerca_SDI").value,
      IBAN       : document.getElementById("entiRicerca_IBAN").value,
      telefono   : document.getElementById("entiRicerca_telefono").value,
      cellulare  : document.getElementById("entiRicerca_cellulare").value,
      email      : document.getElementById("entiRicerca_email").value,
      pec        : document.getElementById("entiRicerca_pec").value,
      citta      : document.getElementById("entiRicerca_citta").value,
      provincia  : document.getElementById("entiRicerca_provincia").value,
      via        : document.getElementById("entiRicerca_via").value,
      ncivico    : document.getElementById("entiRicerca_ncivico").value,
      cap        : document.getElementById("entiRicerca_cap").value,
      paese      : document.getElementById("entiRicerca_paese").value,
      fk_tipo    : document.getElementById("entiRicerca_fk_tipo").value,
      fk_tipoPagamento : document.getElementById("entiRicerca_fk_tipoPagamento").value,
      limit: limit,
    },
    success: function (returnedData) {
      var table = $('#table_enti').DataTable();
      table.clear();

      var myTableArray = [];
      var result = returnedData;
     for (var i = 0; i < result.length; i++) {
        //console.log(result[i])
        myTableArray.push([result[i]["nome"],result[i]["id"], result[i]["SDI"], result[i]["citta"], result[i]["provincia"], result[i]["telefono"], result[i]["cellulare"], result[i]["pec"], result[i]["email"]]);
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




function pulisciRicercaEnti(){
  document.getElementById("entiRicerca_id").value = "";
  document.getElementById("entiRicerca_nome").value = "";
  document.getElementById("entiRicerca_pIva").value = "";
  document.getElementById("entiRicerca_codFisc").value = "";
  document.getElementById("entiRicerca_SDI").value = "";
  document.getElementById("entiRicerca_IBAN").value = "";
  document.getElementById("entiRicerca_telefono").value = "";
  document.getElementById("entiRicerca_cellulare").value = "";
  document.getElementById("entiRicerca_email").value = "";
  document.getElementById("entiRicerca_pec").value = "";
  document.getElementById("entiRicerca_citta").value = "";
  document.getElementById("entiRicerca_provincia").value = "";
  document.getElementById("entiRicerca_via").value = "";
  document.getElementById("entiRicerca_ncivico").value = "";
  document.getElementById("entiRicerca_cap").value = "";
  document.getElementById("entiRicerca_paese").value = "";
  document.getElementById("entiRicerca_fk_tipo").value = "";
  document.getElementById("entiRicerca_fk_tipoPagamento").value = "";

}

//row
$(document).ready(function() {
  var table = $('#table_enti').DataTable();

  $('#table_enti tbody').on('click', 'tr', function() {
    var rowData = table.row(this).data();
    //console.log(rowData[1]);
    setEnte(rowData[1]);
  });
});

//nascondi mostra overlay
  closeOverlayBtn.addEventListener("click", function() {
    overlay.style.height = "0%";
  });

  sendRicercaBtn.addEventListener("click", function() {
    ricercaEnti(0);
    overlay.style.height = "0%";
  });

  clearOverlayBtn.addEventListener("click", function() {
    pulisciRicercaEnti();
    ricercaEnti(0);
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
