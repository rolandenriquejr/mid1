function addRow(tableID) {
  var table = document.getElementById(tableID);
  var rowCount = table.rows.length;
  if(rowCount < 8){                            // limit the user from creating fields more than your limits
    var row = table.insertRow(rowCount);
    var colCount = table.rows[0].cells.length;
    for(var i=0; i <colCount; i++) {
      var newcell = row.insertCell(i);
      newcell.innerHTML = table.rows[1].cells[i].innerHTML;
    }
  }else{
     alert("Maximum number of Items is 8");
         
  }
}

function deleteRow(tableID) {
  var table = document.getElementById(tableID);
  var rowCount = table.rows.length;
  if (rowCount > 2) {
    table.deleteRow(rowCount - 1);
  }
  
} 