var showOverlayBtn2 = document.getElementById("showOverlayButton2");
var closeOverlayBtn2 = document.getElementById("closeOverlayBtn2");
var clearOverlayBtn2 = document.getElementById("clearOverlayBtn2");
var overlayContent2 = document.getElementById("overlayContent2");
var overlay2 = document.getElementById("Eventioverlay2");

var overlayContent3 = document.getElementById("overlayContent3");
var overlay3 = document.getElementById("Eventioverlay3");


var sendRicercaBtn  = document.getElementById("sendRicercaBtn");
var sendAggiungiBtn  = document.getElementById("sendAggiungiBtn");

var repeatCheck = document.getElementById("event-repeatable");
var dateSelect  = document.getElementById("event-date");
var hourSelect  = document.getElementById("event-hour");
var slotsSelect  = document.getElementById("oreOccupazione");
var fullDCheck  = document.getElementById("full-day");
var localiSelect = document.getElementById("event-locali");
var disciplineSelect = document.getElementById("event-discipline");
var attivitaSelect = document.getElementById("event-attivita");
var arbitroCheck = document.getElementById("event-arbitro-check");
var pubblicoCheck = document.getElementById("event-pubblico-check");
var respSicurezzaCheck = document.getElementById("event-resp-sicurezza-check");
var noteText = document.getElementById("note-text-area");

var inputlistEnte1 = document.getElementById("ente1");
var itemslistEnte1 = document.getElementById("items-list-Ente1");
var inputlistEnte2 = document.getElementById("ente2");
var itemslistEnte2 = document.getElementById("items-list-Ente2");

var squadra1Select = document.getElementById("squadra1-Select");
var squadra2Select = document.getElementById("squadra2-Select");

var calendar = initCalendarEventi()
var calendarEl = document.getElementById('calendar');

window.onresize = adjustCalendarWidth;

if (inputlistEnte1)
    inputlistEnte1.addEventListener("keyup", (e) => {
    send_suggestionsEnteSC(1);
  });
if (inputlistEnte2)
  inputlistEnte2.addEventListener("keyup", (e) => {
  send_suggestionsEnteSC(2);
});




//AGGIUNTA

//nascondi mostra overlay
closeOverlayBtn2.addEventListener("click", function() {
  overlay2.style.height = "0%";
});

sendAggiungiBtn.addEventListener("click", function() {
  aggiungiEvento()//aggiungiSquadra(0);
  
  //pulisciAggiuntaSquadre();
  //overlay2.style.height = "0%";
});

clearOverlayBtn2.addEventListener("click", function() {
  clearAggiungiEvento()
  //pulisciAggiuntaSquadre();
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


//controlla se viene selezionato un elemento dentro a loverlay content
overlayContent3.addEventListener('click', e => {
  if(e.target !== e.currentTarget) ;//console.log("child clicked") 
  else overlay3.style.height = "0%";
})
//controlla se viene selezionato un elemento dentro l'overlay
overlay3.addEventListener('click', e => {
  if(e.target !== e.currentTarget) ;//console.log("child clicked") 
  else overlay3.style.height = "0%";
})

//ELEMENTI AGGIUNTA
dateSelect.addEventListener("change", function() {
  getHour();
  // Esegui l'azione desiderata con l'opzione selezionata
});




//SMART SEARCH
//check if it text is unfocussed and if item list isnt clicked
$(document).click(function (e) {
  if (!inputlistEnte1.contains(e.target) && !itemslistEnte1.contains(e.target)) {
    removeElementsEnteSC();
  }
});

//aggiungi suggestions
$(document).on("click", "#ente1", function () {
  if ($(this).is(":focus")) {
    send_suggestionsEnteSC(1);
  }
});

//check if it text is unfocussed and if item list isnt clicked
$(document).click(function (e) {
  if (!inputlistEnte2.contains(e.target) && !itemslistEnte2.contains(e.target)) {
    removeElementsEnteSC();
  }
});

//aggiungi suggestions
$(document).on("click", "#ente2", function () {
  if ($(this).is(":focus")) {
    send_suggestionsEnteSC(2);
  }
});






function initDataTableEventi() {
  $("#table_eventi thead tr").addClass("filters").appendTo("#table_eventi thead");

  var table = $("#table_eventi").DataTable({
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
function loadTableEventi() {
  getEventiCalendario(15);
 setTimeout(function () {getEventiCalendario(25)} , 100);
 setTimeout(function () {getEventiCalendario(100)}, 250);
 //setTimeout(function () {getEventiCalendario(0) } , 750);
}


function getEventiCalendario(limit) {
  $.ajax({
    type: "post",
    url: "php/functions/eventi.php",
    dataType: 'json',
    cache: false,
    data: {
      function: "getEventiCalendario",
      limit: limit,
    },
    success: function (returnedData) {
      var calendar = initCalendarEventi()
 
      //console.log(returnedData)
      var myTableArray = [];
      var events = [];
      var result = returnedData;
     for (var i = 0; i < result.length; i++) {
        //console.log(result[i])
        if (returnedData[i]["arbitro"])       var arbitro = "si";
        else                                  var arbitro = "no";
        if (returnedData[i]["pubblico"])      var pubblico = "si";
        else                                  var pubblico = "no";
        if (returnedData[i]["respSicurezza"]) var respSicurezza = "si";
        else                                  var respSicurezza = "no";
        if (returnedData[i]["note"] == "")    var note = "Nessuna Nota";
        else                                  var note = returnedData[i]["note"] ;
        if (returnedData[i]["ente11"] == returnedData[i]["ente21"])returnedData[i]["ente21"] = "";

        myTableArray.push([returnedData[i]["id"],returnedData[i]["giorno"],
                           returnedData[i]["slots"],returnedData[i]["nomeLocale"],
                           returnedData[i]["attivita1"],returnedData[i]["disciplina"],
                           returnedData[i]["ente11"],returnedData[i]["ente21"],
                          pubblico,arbitro,respSicurezza,note]);

        var description = "";
        description += "Locale       : "+returnedData[i]["nomeLocale"]+"\n";
        description += "Disciplina   : "+returnedData[i]["disciplina"]+"\n";
        description += "Ente1: "+returnedData[i]["ente11"]+"\n";
        if(returnedData[i]["ente21"])description += "Ente2: "+returnedData[i]["ente21"]+"\n";
        if(pubblico) description += "Pubblico     : Si \n";
        if(arbitro) description += "Arbitro      : Si \n";
        if(respSicurezza) description += "respSicurezza: Si \n";
        description += "Note         : "+note+"\n";

        var event = {
          title: returnedData[i]["ente11"]+" - "+returnedData[i]["attivita1"],
          start: returnedData[i]["giorno"],
          end:   returnedData[i]["slots"],
          backgroundColor: generateRandomColorCode(), // Adjust the background color here
          textColor: 'white',
          description: description
        };
        events.push(event);
        calendar.addEvent(events[i]);

      }
      // Aggiungi un evento al calendario
      calendar.render();
    },
    error: function () {
      alert('Error while request..! try again');
    }
  });
}

function controlliAggiunta()
  {
    var errorFlag = 0;
    if (dateSelect.value.trim() == ""){ 
        errorFlag = 1;
        dateSelect.classList.add("is-invalid");
    }
    else dateSelect.classList.remove("is-invalid");
    
    if (hourSelect.value.trim() == ""){ 
      errorFlag = 1;
      hourSelect.classList.add("is-invalid");
    }
    else hourSelect.classList.remove("is-invalid");
    
    if (ente1.value.trim() == ""){ 
      errorFlag = 1;
      ente1.classList.add("is-invalid");
    }
    else ente1.classList.remove("is-invalid");

    if (squadra1Select.value.trim() == ""){ 
      errorFlag = 1;
      squadra1Select.classList.add("is-invalid");
    }
    else squadra1Select.classList.remove("is-invalid");
  return errorFlag;
  }

function clearAggiungiEvento(){
  dateSelect.value = "";
  while (hourSelect.options.length > 0) {
    hourSelect.remove(0);
  }
  fullDCheck.checked = false;
  localiSelect.value = 1;
  disciplineSelect.value = "Ginnastica Ritmica/artistica";
  attivitaSelect.value = 1;
  ente1.value = "";
  while (squadra1Select.options.length > 0) {
    squadra1Select.remove(0);
  }

  ente2.value = "";
  while (squadra2Select.options.length > 0) {
    squadra2Select.remove(0);
  }
  arbitroCheck.checked = false;
  pubblicoCheck.checked = false;
  respSicurezzaCheck.checked = false;
}

function aggiungiEvento(){
  var errorFlag = controlliAggiunta();
  if (errorFlag == 1){
    //dconsole.log("Completare tutti i campi per proseguire");
    return -1;
  }
  /*
  console.log("repeatCheck     : "+repeatCheck.checked)
  console.log("dateSelect      : "+dateSelect.value);
  console.log("hourSelect      : "+hourSelect.value);
  console.log("slotsSelect     : "+slotsSelect.value);
  console.log("fullDCheck      : "+fullDCheck.checked);
  console.log("localiSelect    : "+localiSelect.value);
  console.log("disciplineSelect: "+disciplineSelect.value);
  console.log("attivitaSelect  : "+attivitaSelect.value);
  console.log("arbitroCheck    : "+arbitroCheck.checked);
  console.log("pubblicoCheck   : "+pubblicoCheck.checked);
  console.log("respSicurezzaCheck: "+respSicurezzaCheck.checked);
  console.log("squadra1Select: "+squadra1Select.value);
  console.log("squadra2Select: "+squadra2Select.value);
  console.log("noteText: "+noteText.value)
  */
 else{
  $.ajax({
    type: "post",
    url: "php/functions/eventi.php",
    dataType: 'json',
    cache: false,
    data: {
      function: "addEvent",
      repeatCheck     : repeatCheck.checked,
      dateSelect      : dateSelect.value,
      hourSelect      : hourSelect.value,
      slotsSelect     : slotsSelect.value,
      fullDCheck      : fullDCheck.checked,
      localiSelect    : localiSelect.value,
      disciplineSelect: disciplineSelect.value,
      attivitaSelect  : attivitaSelect.value,
      arbitroCheck    : arbitroCheck.checked,
      pubblicoCheck   : pubblicoCheck.checked,
      respSicurezzaCheck : respSicurezzaCheck.checked,
      squadra1Select  : squadra1Select.value,
      squadra2Select  : squadra2Select.value,
      noteText        : noteText.value,
    },
    success: function (returnedData) {
      console.log(returnedData)
      if (returnedData == -1){
        document.getElementById("add-return").innerHTML="Errore: -1"
        document.getElementById("add-return").style="color:#ED4337";
      }
      if (returnedData == -2){
        document.getElementById("add-return").innerHTML="Errore: Palestra Occupata Val:-2"
        document.getElementById("add-return").style="color:#ED4337";
      }
      if (returnedData == -3){
        document.getElementById("add-return").innerHTML="Errore: Palestra Occupata Val:-3"
        document.getElementById("add-return").style="color:#ED4337";
      }
      if (returnedData == 0){
        document.getElementById("add-return").innerHTML="Evento aggiunto Correttamente"
        document.getElementById("add-return").style="color:#08a34f";
        setTimeout(function(){loadTableEventi();overlay2.style.height = "0%";},2500)
        setTimeout(function(){
          document.getElementById("add-return").innerHTML="Aggiungi Evento";
          document.getElementById("add-return").style="color:#000000";
          clearAggiungiEvento(0)
          },3000)
        
      }
    },
    error: function () {
      alert('Error while request..! try again');
    }
  });
}

  
}

function getHour(){
  $.ajax({
    type: "post",
    url: "php/functions/eventi.php",
    dataType: 'json',
    cache: false,
    data: {
      function: "getFreeHours",
      inputDate: dateSelect.value,
    },
    success: function (returnedData) {
      //console.log(returnedData)
      while (hourSelect.options.length > 0) {
        hourSelect.remove(0);
      }
      for (var i = 0; i < returnedData.length; i++){
        var hour = returnedData[i]["hour"].substring(11,16);
        var optionElement = document.createElement("option");
        optionElement.text = hour;
        hourSelect.add(optionElement);
        
      }
    },
    error: function () {
      alert('Error while request..! try again');
    }
  });
}



function getDiscipline(){
  $.ajax({
    type: "post",
    url: "php/functions/eventi.php",
    dataType: 'json',
    cache: false,
    data: {
      function: "getDiscipline",
    },
    success: function (returnedData) {
      while (disciplineSelect.options.length > 0) {
        disciplineSelect.remove(0);
      }
      for (var i = 0; i < returnedData.length; i++){
        var optionElement = document.createElement("option");
        optionElement.value  = returnedData[i]["nome"];
        optionElement.text = returnedData[i]["nome"];
        disciplineSelect.add(optionElement);
        
      }
    },
    error: function () {
      alert('Error while request..! try again');
    }
  });
}

function getLocali(){
  $.ajax({
    type: "post",
    url: "php/functions/eventi.php",
    dataType: 'json',
    cache: false,
    data: {
      function: "getLocali",
    },
    success: function (returnedData) {
      while (localiSelect.options.length > 0) {
        localiSelect.remove(0);
      }
      for (var i = 0; i < returnedData.length; i++){
        var optionElement = document.createElement("option");
        optionElement.value  = returnedData[i]["id"];
        optionElement.text = returnedData[i]["nome"];
        localiSelect.add(optionElement);
        
      }
    },
    error: function () {
      alert('Error while request..! try again');
    }
  });
}

function getAttivita(){
  $.ajax({
    type: "post",
    url: "php/functions/eventi.php",
    dataType: 'json',
    cache: false,
    data: {
      function: "getAttivita",
    },
    success: function (returnedData) {
      while (attivitaSelect.options.length > 0) {
        attivitaSelect.remove(0);
      }
      for (var i = 0; i < returnedData.length; i++){
        var optionElement = document.createElement("option");
        optionElement.value  = returnedData[i]["id"];
        optionElement.text = returnedData[i]["nome"];
        attivitaSelect.add(optionElement);
        
      }
    },
    error: function () {
      alert('Error while request..! try again');
    }
  });
}



//takes suggestions from the server
function send_suggestionsEnteSC(select) {
  if ((inputlistEnte1.value != "" && select==1) || (inputlistEnte2.value != "" && select==2)){
    if (select == 1) var inputlistEnte = inputlistEnte1.value;
    if (select == 2) var inputlistEnte = inputlistEnte2.value;
    $.ajax({
      type: "post",
      url: "php/functions/eventi.php",
      dataType: 'json',
      cache: false,
      data: {
        function: "smartSearch",
        written: inputlistEnte,
        limit: 10,
      },
      success: function (returnedData) {
        removeElementsEnteSC();
        if (returnedData != "") {
          var options = [];
          //console.log(returnedData);
          for (var i = 0; i < returnedData.length; i++) options.push([returnedData[i]["id"],returnedData[i]["nome"]]);
          //console.log(options);
          addElementsEnteSC(select,options);//makes the smartsearch results visible
        }
      },
      error: function () {
        alert('Error while request..! try again');
      }
    });
  }else
    removeElementsEnteSC();
}

function addElementsEnteSC(select,array) {

  for (let i of array) {
    //convert input to lowercase and compare with each string
    //i.toLowerCase().startsWith(input.value.toLowerCase()) && 
    if ((inputlistEnte1!= "" && select == 1)||(inputlistEnte2!= "" && select == 2)) {
        //create li element
        let listItem = document.createElement("li");
        //One common class name
        listItem.style.cursor = "pointer";
        listItem.classList.add("list-items");
  
        //listItem.classList.add("img-clck");
        listItem.setAttribute("id", "list-items");
        //Display matched part in bold
        var word = "";
        if (inputlistEnte1.value != "" && select == 1) {
          word = "<b>" + i[1].substr(0, inputlistEnte1.value.length) + "</b>";
          word += i[1].substr(inputlistEnte1.value.length);
        }
        if (inputlistEnte2.value != "" && select == 2) {
          word = "<b>" + i[1].substr(0, inputlistEnte2.value.length) + "</b>";
          word += i[1].substr(inputlistEnte2.value.length);
        }
        //display the value in array
        listItem.innerHTML = word;
        document.getElementById("items-list-Ente1").appendChild(listItem);
        listItem.addEventListener("click", (e) => {
          displayNamesEnteSC(select,i[0],i[1]);
        });
      } else
        removeElementsEnteSC();
    }
};


function getSquadreSC(select,value) {
  if (select==1) var selectmenu = squadra1Select;
  if (select==2) var selectmenu = squadra2Select;
    $.ajax({
      type: "post",
      url: "php/functions/eventi.php",
      dataType: 'json',
      cache: false,
      data: {
        function: "getSquadre",
        value: value
      },
      success: function (returnedData) {
        while (selectmenu.options.length > 0) {
          selectmenu.remove(0);
        }
        for (var i = 0; i < returnedData.length; i++){
          var optionElement = document.createElement("option");
          optionElement.value  = returnedData[i]["id"];
          optionElement.text = returnedData[i]["nome"];
          selectmenu.add(optionElement);
          
        }
      },
      error: function () {
        alert('Error while request..! try again');
      }
    });
  
}


function displayNamesEnteSC(select,value,text) {
  if(select == 1) inputlistEnte1.value = text;
  if(select == 2) inputlistEnte2.value = text;
  getSquadreSC(select,value);
  //console.log(value);  //al posto di console log qui manderai una chiamata all'app che aggiunge le cose alle opzioni di squadra
  removeElementsEnteSC();
}

function removeElementsEnteSC() {
  //clear all the item
  let items = document.querySelectorAll(".list-items");
  items.forEach((item) => {
    item.remove();
  });
}

function generateRandomColorCode() {
  var letters = '0123456789ABCDEF';
  var colorCode = '#';

  for (var i = 0; i < 6; i++) {
    colorCode += letters[Math.floor(Math.random() * 16)];
  }

  return colorCode;
}

function initCalendarEventi(){
  
const element = document.getElementById("calendar");
var modal = document.getElementById('eventModal');
  var modalTitle = document.getElementById('modalTitle');
  var modalStart = document.getElementById('modalStart');
  var modalEnd = document.getElementById('modalEnd');
  var modalDescription = document.getElementById('modalDescription');

// Get the current date and time in Italy
var currentDate = new Date();
var currentHour = currentDate.getHours();
var currentMinute = currentDate.getMinutes();

// Format the current time
var currentTime = ("0" + currentHour).slice(-2) + ":" + ("0" + currentMinute).slice(-2) + ":00";

var todayDate = moment().startOf("day");
var YM = todayDate.format("YYYY-MM");
var YESTERDAY = todayDate.clone().subtract(1, "day").format("YYYY-MM-DD");
var TODAY = todayDate.format("YYYY-MM-DD");
var TOMORROW = todayDate.clone().add(1, "day").format("YYYY-MM-DD");

var weekdays = ['Domenica', 'Lunedì', 'Martedì', 'Mercoledì', 'Giovedì', 'Venerdì', 'Sabato'];
var weekdaysShort = ['Dom', 'Lun', 'Mar', 'Mer', 'Gio', 'Ven', 'Sab'];
          

var calendarEl = document.getElementById("calendar");
var calendar = new FullCalendar.Calendar(calendarEl, {
    headerToolbar: {
        left: "prev,next today",
        center: "title",
        right: "dayGridMonth,timeGridWeek,timeGridDay,listMonth"
    },

    height: 800,
    contentHeight: 780,
    aspectRatio: 3,  // see: https://fullcalendar.io/docs/aspectRatio

    nowIndicator: true,
    now: moment().format("YYYY-MM-DD") + "T" + currentTime, // just for demo

    views: {
        dayGridMonth: { 
          titleFormat: { month: 'long', year:'numeric',omitCommas: true },//Cambia il titolo
          dayHeaderContent: function(arg) {//Permette di cambiare gli heaer delle colonne
            var weekdayIndex = arg.date.getDay();
            var headerContent = weekdaysShort[weekdayIndex];
            return headerContent;
          },
          eventTimeFormat: {
            hour: 'numeric',
            minute: '2-digit',
            meridiem: false
          },
          buttonText: "month" },
        timeGridWeek: { 
          titleFormat: {day: 'numeric', month: 'short', omitCommas: true },
          dayHeaderContent: function(arg) {
            var dayNumber = arg.date.getDate();
            var weekdayIndex = arg.date.getDay();
            var headerContent = weekdaysShort[weekdayIndex] + ' ' + dayNumber;
            return headerContent;
          },
          buttonText: "week" },
        timeGridDay: { 
          titleFormat: {weekday: 'long',day: 'numeric'},
          dayHeaderContent: function(arg) {
            var weekdayIndex = arg.date.getDay();
            var headerContent = weekdays[weekdayIndex];
            return headerContent;
          },
          buttonText: "day" }
    },
   
    
    initialView: "dayGridMonth",
    
    initialDate: TODAY,

    editable: false,
    dayMaxEvents: true, // allow "more" link when too many events
    navLinks: true,
    events: [],
    eventClick: function(info) {
      var event = info.event;
      var title = event.title;
      var start = event.start;
      var end = event.end;
      var description = event.extendedProps.description;

      modalTitle.textContent = title;
      modalStart.textContent = 'Start: ' + start;
      modalEnd.textContent = 'End: ' + end;
      modalDescription.textContent = 'Description: ' + description;
      modalStart.innerHTML       = modalStart.innerHTML.replace(" GMT+0200 (Ora legale dell’Europa centrale)","")
      modalEnd.innerHTML         = modalEnd.innerHTML.replace(" GMT+0200 (Ora legale dell’Europa centrale)","")
      modalDescription.innerHTML = modalDescription.innerHTML.replace(/\n/g, '<br>');

      modal.style.display = 'block';
      overlay3.style.height = "100%";
    }
   
});

calendar.render();
var closeModal = document.getElementsByClassName('close')[0];
  closeModal.onclick = function() {
    overlay3.style.height = "0%";
  };
return calendar;
}

// Function to adjust the calendar width based on the container size
function adjustCalendarWidth() {
  var containerHeight = calendarEl.parentElement.offsetHeight;
  calendar.setOption('height', containerHeight);
}








