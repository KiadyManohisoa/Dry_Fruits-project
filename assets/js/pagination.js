/*
const personnes = [
    {'nom' : 'Tsaramirana', 'age': 18},
    {'nom':"Jean", 'age': 15},
    {'nom': "Koto", 'age':20},
    {'nom': "Hermione", 'age':18},
    {'nom': "Harry", 'age':17},
    {'nom': "Ron", 'age':19},
    {'nom': "Luna", 'age':16},
    {'nom': "Neville", 'age':17},
    {'nom': "Lol", 'age':5},
    {'nom': "bcvuiaz", 'age':16},
    {'nom': "ianina", 'age':19},
    {'nom': "Claudia", 'age':78},
    {'nom': "Kal", 'age':3},
    {'nom': "Joba", 'age':56},
    {'nom': "Zefania", 'age':115},
    {'nom': "Malakia", 'age':1000},
    {'nom': "Truc", 'age':14},
    {'nom': "Luc", 'age':18},
    {'nom': "Matio", 'age':78},
    {'nom': "Marc", 'age':30},
    {'nom': "Jaona", 'age':23},
    {'nom': "Ezekiela", 'age':23},
    {'nom': "Solo", 'age':-20}
];
const personnesParPage = 5;
const tableContainer = document.getElementById('tableContainer');
const pagination = document.getElementsByClassName('pagination pagination-lg');
const prev = document.getElementById("prev");

function afficherPersonnes(page) {
    //bouton previous
    if(page==1){
        prev.setAttribute("class", "disabled");
    }
    else{
        prev.removeAttribute("class");
    }
    //organiser la repartrition des personnes par tableau
    const debut = (page -1) * personnesParPage;
    const fin = Math.min(debut + personnesParPage, personnes.length);
    const personnesAffichees = personnes.slice(debut, fin);

    //création de la table
    const table = document.createElement('table');
    const thead  = document.createElement('thead');
    const tbody = document.createElement('tbody');

    //création des entêtes
    const entetes = ['Nom', 'Âge'];
    const trHead = document.createElement('tr');

    for (let i = 0; i < entetes.length; i++) {
        const entete = entetes[i];
        const th = document.createElement('th');
        //création input pour filtrage
        th.setAttribute("scope", "col");
        const input = document.createElement("input");
        input.setAttribute("type", "search");
        input.setAttribute("placeholder", entete);
        input.addEventListener("keyup", function(){
            const value = input.value.toLowerCase();
            filterRows((i+1), value);
        });
        th.appendChild(input);
        trHead.appendChild(th);
    }
    thead.appendChild(trHead);
    table.appendChild(thead);

    //mise en place contenu du tableau
    personnesAffichees.forEach( personne => {
        const tr = document.createElement('tr');
        let keys = Object.keys(personne);
        for (let key of keys) {
            const td = document.createElement('td');
            td.textContent =personne[key];
            tr.appendChild(td);
        }        
        tbody.appendChild(tr);
    });

    table.appendChild(tbody);
    table.setAttribute("class", "table table-hover");
    tableContainer.innerHTML = '';
    tableContainer.appendChild(table);
}

function afficherPagination(){
    const totalPages  =Math.ceil(personnes.length / personnesParPage)+1;

    for (let index = 1; index < totalPages; index++) {
        const li = document.createElement('li');
        const link = document.createElement('a');
        link.textContent = index;
        li.appendChild(link);
        li.addEventListener('click', ()=> {
            afficherPersonnes(index);
        });
        pagination[0].appendChild(li);
    }
    const li2 = document.createElement('li');
    li2.innerHTML="<a href=\"#\" aria-label=\"Next\"><span aria-hidden=\"true\">&raquo;</span></a>";
    pagination[0].appendChild(li2);
}

function filterRows(index, value){
    const table = document.querySelector('table');
    const rows = table.tBodies[0].rows;
    for (let i= 0; i< rows.length; i++) {
        const cell = rows[i].cells[index-1];
        if(cell.textContent.toLowerCase().includes(value)){
            rows[i].style.display ="";
        }
        else{
            rows[i].style.display  ="none";
        }  
    }
}
afficherPersonnes(1);
afficherPagination();*/

const platPerPage = 6;
    function paginateTable(tableId, currentPage) {
        // Example: Hide all rows, then show rows for the current page
        var table = document.getElementById(tableId);
        var rows = table.getElementsByTagName('tr');

        for (var i = 1; i < rows.length; i++) {
            rows[i].style.display = 'none';
        }

        var startIndex = (currentPage - 1) * platPerPage;
        var endIndex = Math.min(startIndex + platPerPage, rows.length);

        for (var i = startIndex + 1; i < endIndex + 1 && i < rows.length; i++) {
            rows[i].style.display = '';
        }
    }
    function afficherPagination(tableId){
        var table = document.getElementById(tableId);
        var rows = table.getElementsByTagName('tr');
        const pagination = document.getElementsByClassName('pagination pagination-lg');

        const totalPages  =Math.ceil(rows.length / platPerPage)+1;
    
        for (let index = 1; index <=platPerPage; index++) {
            const li = document.createElement('li');
            const link = document.createElement('a');
            link.textContent = index;
            li.appendChild(link);
            li.addEventListener('click', ()=> {
                paginateTable("myTable",index, platPerPage);
            });
            pagination[0].appendChild(li);
        }
        const li2 = document.createElement('li');
    }
    paginateTable("myTable",1);
    afficherPagination("myTable");
    
    
