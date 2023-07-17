
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
        var tableBody = document.querySelector('#table_enti tbody');
        
        var result = returnedData;
        const keys = Object.keys(result[0]);
        for (var i = 0; i < keys.length; i++) {
          var newRow = document.createElement('tr');
          // Create and append cells to the row
          var nameCell = document.createElement('td');
          var valueCell = document.createElement('td');
          nameCell.textContent = keys[i]+":";
          valueCell.textContent = result[0][keys[i]];
          newRow.appendChild(nameCell);
          newRow.appendChild(valueCell);

          tableBody.appendChild(newRow);
        }
  
        

      },
      error: function () {
        alert('Error while request..! try again');
      }
    });
  }

  
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
      var tableBody = document.querySelector('#table_squadre tbody');
      
      var result = returnedData;
      const keys = Object.keys(result[0]);
      for (var i = 0; i < keys.length; i++) {
        var newRow = document.createElement('tr');
        // Create and append cells to the row
        var nameCell = document.createElement('td');
        var valueCell = document.createElement('td');
        nameCell.textContent = keys[i]+":";
        valueCell.textContent = result[0][keys[i]];
        newRow.appendChild(nameCell);
        newRow.appendChild(valueCell);

        tableBody.appendChild(newRow);
      }

      

    },
    error: function () {
      alert('Error while request..! try again');
    }
  });
}








