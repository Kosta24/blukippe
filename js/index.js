var container = document.getElementById('tabs');
var items = container.getElementsByClassName('tab');

var selectedIndex = 0;
if (items[items.length-1].tagName === "SELECT") selectedIndex = 1;
// Aggiungi l'evento click a ciascun elemento
for (var i = 0; i < items.length-selectedIndex; i++) {
   
  items[i].addEventListener('click', function() {
   
    // Rimuovi la classe "active" da tutti gli elementi
    for (var j = 0; j < items.length; j++) {
      items[j].classList.remove('active');
    }
    
    // Aggiungi la classe "active" all'elemento cliccato
    this.classList.add('active');
  });
}
if (selectedIndex != 0){
   items[items.length-1].addEventListener('change', function() {
      // Rimuovi la classe "active" da tutti gli elementi
      for (var j = 0; j < items.length; j++) {
         items[j].classList.remove('active');
      }
      
      // Aggiungi la classe "active" all'elemento cliccato
      this.classList.add('active');
   });
}

//dopo aver ricaricato seleziona la pagina selezionata
function setSelectedTab(tab){
   // Rimuovi la classe "active" da tutti gli elementi
   for (var j = 0; j < items.length; j++) {
     items[j].classList.remove('active');
   }
    
    // Aggiungi la classe "active" all'elemento cliccato
   items[tab.charAt(tab.length - 1)-1].classList.add('active');

}


function changeTab(pagina) {
    current_tab = pagina;
    $.ajax({
       type: "post",
       url: "php/pages.php",
       dataType: 'html',
       cache: false,
       data: {
          tab: pagina,
       },
       success: function (data) {
          if (data != "") {
             $('#bodyDiv').html("");
             $('#bodyDiv').html(data);
          }
 
       },
       error: function () {
          alert('Error while request..! try again');
       }
    });
    return false;
 }

 function changeSubTab(pagina) {
   current_tab = pagina;
   $.ajax({
      type: "post",
      url: "php/pages.php",
      dataType: 'html',
      cache: false,
      data: {
         subTab: pagina,
      },
      success: function (data) {
         if (data != "") {
            $('#bodyDiv').html("");
            $('#bodyDiv').html(data);
         }

      },
      error: function () {
         alert('Error while request..! try again');
      }
   });
   return false;
}

function updateSelectedOption(selectElement) {
   var selectedOption = selectElement.options[selectElement.selectedIndex].text;
   var selectedOptionElement = document.querySelector('.selected-option');
   selectedOptionElement.textContent = selectedOption;
 }









