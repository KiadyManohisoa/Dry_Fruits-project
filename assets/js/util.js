function getXhr () {
    var xhr;
    try {
      xhr = new ActiveXObject('Msxml2.XMLHTTP');   }
    catch (e)
    {
        try {
          xhr = new ActiveXObject('Microsoft.XMLHTTP'); }
        catch (e2)
        {
           try {
             xhr = new XMLHttpRequest();  }
           catch (e3) {
             xhr = false;   }
         }
    }
    return xhr;
}

function displayInTable (retour,idTable) {
  var table = document.getElementById(idTable); 
  table.innerHTML=null;

  var thead = document.createElement('thead');
  var tr  = document.createElement('tr');
  for(var key in retour[0]) {
      var th = document.createElement('th');
      th.textContent = key;
      tr.appendChild(th);
  }
  thead.appendChild(tr);

  var tbody = document.createElement('tbody');
  for(var i=0;i<retour.length;i++) {
      var tr = document.createElement('tr');
      for(var key in retour[i]) {
          var td = document.createElement('td');
          td.textContent = retour[i][key];
          tr.appendChild(td);
      }
      tbody.appendChild(tr);
  }
  table.appendChild(thead);
  table.appendChild(tbody);
}