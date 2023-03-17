var rows = [];
var selectId;
var update = false;

const pagination = document.getElementById('pagination');
const table = document.getElementById('taula');
const divErrors = document.getElementById("errors");
divErrors.style.display = "none";
const dniT = document.getElementById("dniT");
const nomT = document.getElementById("nomT");
const genreT = document.getElementById("genreT");
const saveButton = document.getElementById('saveButton');
saveButton.addEventListener('click', onSave);

function getCookie(cname) {
    let name = cname + "=";
    let decodedCookie = decodeURIComponent(document.cookie);
    let ca = decodedCookie.split(';');
    for(let i = 0; i <ca.length; i++) {
      let c = ca[i];
      while (c.charAt(0) == ' ') {
        c = c.substring(1);
      }
      if (c.indexOf(name) == 0) {
        return c.substring(name.length, c.length);
      }
    }
    return "";
  }

const Url = {
    get: 'http://localhost:8000/api/treballador',
    save: 'http://localhost:8000/api/treballador/save',
    update: 'http://localhost:8000/api/treballador/update',
    delete: 'http://localhost:8000/api/treballador/delete',
}

function showErrors(errors) {

    divErrors.style.display = "block"
    divErrors.innerHTML = "";
    const ul = document.createElement("ul")
    for (const error of errors) {
        const li = document.createElement("li");
        li.textContent = error;
        ul.appendChild(li);
    }
    divErrors.appendChild(ul)
}

function onSave(event) {
    console.log(update)
    if (update === false) {
        saveTreballador();
    }
    if (update != false) {
        updateTreballador(update)
    }
}

function afegirFila(row) {
    console.log(row)
    let taula = document.getElementById('taula')
    taula.innerHTML += `
    <tr>
    <td id='${row.id}'>${row.id}</td>
    <td id='dni'>${row.dni}</td>
    <td id='nom'>${row.nom}</td>
    <td id='genere'>${row.genere}</td>
    <td><button id='delete-${row.id}'>Eliminar</button></td>
    <td><button id='update-${row.id}-${row.dni}-${row.nom}-${row.genere}'>Actualizar</button></td>
    </tr>
    `
}

async function getTreballador(){
console.log("has entrado")
    try{
        let taula = document.getElementById('taula');
        taula.innerHTML = ``;
        const response = await fetch(Url.get,{
            method: 'GET',
            headers:{
                'Accept':'aplication/json'
            }
        });
        const data = await response.json();
        console.log(data)
        console.log(response)
        if (response.ok) {
            // console.log(response.ok+"aaaaa")
            console.log('asdasda')
            let links = data.data.links;
            loadIntoTable(Url.get);
        } else {
            showErrors(data.data)
        }
    } catch (error) {
        errors.innerHTML = "An unexpected error has occurred"
    }
    
}

async function saveTreballador(event){

    let respostaDIV = document.getElementById('resposta')
    respostaDIV.innerHTML = ``;
    respostaDIV.className = "alert alert-success"
    var newTreballador = {
        "dni": dniT.value,
        "nom": nomT.value,
        "genere": genreT.value
    }
    console.log(newTreballador)
    try{
        const response = await fetch(Url.save, {
            method: 'POST',
            headers: {
                'Content-type': 'application/json',
                'Accept': 'application/json',
                'Authorization': 'Bearer '+ getCookie('token'),
            },
            body: JSON.stringify(newTreballador)
        })
        const data = await response.json();
        console.log(data+"weoeo")
        if(response.ok){
            
            respostaDIV.innerHTML = `Treballador ${data.data.nom} creat correctament`
            setTimeout(() => {
                respostaDIV.innerHTML = "";
                respostaDIV.className = ""
            }, "4000")
        }else{
            showErrors(data.data)
        }
        }catch(error){
            errors.innerHTML = "S'ha produit un error inesperat"
        }
        getTreballador()
        paginate()
}

function updateHTML(id,dni,nom,genere){
    update = id
    dniT.value=dni
    nomT.value = nom
    genreT.value = genere
}

async function updateTreballador(id){
    let respostaDIV = document.getElementById('resposta')
    respostaDIV.innerHTML = "";
    respostaDIV.className = "alert alert-success"
    update = false;
    var updateTreballador = {
        "dni": dniT.value,
        "nom": nomT.value,
        "genere": genreT.value
    }
    console.log(updateTreballador)
    try{
        const response = await fetch(Url.update + '/' + id, {
            method: 'PUT',
            headers: {
                'Content-type': 'application/json',
                'Accept': 'application/json',
                'Authorization': 'Bearer '+ getCookie('token'),
            },
            body: JSON.stringify(updateTreballador) //   "{ 'name' : 'mart'}"
        })

        const data = await response.json(); 
        dniT.value = ""
        nomT.value = ""
        genreT.value= ""
        if (response.ok) {
            //afegirFila(data.data)
            respostaDIV.innerHTML = `Treballador amb DNI: ${data.data.dni} actualitzat correctament`
            setTimeout(() => {
                respostaDIV.innerHTML = "";
                respostaDIV.className = ""
            }, "4000")
            paginate()
            getTreballador()
        } else {
            showErrors(data.data)
        }
    }catch (error) {
        errors.innerHTML = "S'ha produit un error inesperat"
        operation = "inserting";
    }
}

async function deletTreballador(id){
    let respostaDIV = document.getElementById('resposta')
        respostaDIV.innerHTML = "";
        respostaDIV.className = "alert alert-danger"
        try {
            const response = await fetch(Url.delete + '/' + id, {
                method: 'DELETE',
                headers: {
                    'Content-type': 'application/json',
                    'Accept': 'application/json',
                    'Authorization': 'Bearer '+ getCookie('token'),
                },
    
            })
            const data = await response.json();
            if(response.ok){
                paginate()
                respostaDIV.innerHTML = `Treballador ${data.data.nom} eliminat correctament`
                setTimeout(() => {
                    respostaDIV.innerHTML = "";
                    respostaDIV.className = ""
                }, "4000")
            }else {
                showErrors(data.data)
            }
        } catch (error) {
            errors.innerHTML = "S'ha produit un error inesperat"
        }
}

async function loadIntoTable(url){
    try{
        const response = await fetch(url);
        const json = await response.json();
        rows = json.data.data;
        for (const row of rows){
            console.log('row')
            afegirFila(row)
            const buttons = document.querySelectorAll('button[id^="delete-"]');
            const buttonsUpdate = document.querySelectorAll('button[id^="update-"]');
            for(let button of buttons){
                console.log('botones');
                button.addEventListener("click", function () {
                    const id = this.id.split("-")[1];
                    deletTreballador(id)
                    getTreballador()
                });
            }
            for(let button of buttonsUpdate){
                button.addEventListener("click",function () {
                    const id = this.id.split("-")[1];
                    const dni = this.id.split("-")[2];
                    const nom = this.id.split("-")[3];
                    const genere = this.id.split("-")[4];
                    updateHTML(id, dni,nom,genere)
                });
            }
        }
        const links = json.data.links;
        console.log(links)
        afegirLinks(links)
    } catch(error) {
        errors.innerHTML = "No es pot accedir a la base de dades"
    }
}

function paginate(url){
    pagination.innerHTML = "";
    taula.innerHTML = "";
    loadIntoTable(url);
}
function afegirLinks(links){
    for (const link of links){
        console.log(link)
        afegirBoto(link)
        
    }
}

function afegirBoto(link){

    const pagLi = document.createElement("li");
    pagLi.classList.add('page-item');
console.log(1)
    const pagAnchor = document.createElement("a");
    pagAnchor.innerHTML = link.label;
    pagAnchor.addEventListener('click', function(event) {paginate(link.url)});
    console.log(2)
    pagAnchor.classList.add('page-link');
    pagAnchor.setAttribute('href', "#");
    console.log(3)
    console.log(pagAnchor)

    pagLi.appendChild(pagAnchor);
    pagination.appendChild(pagLi);
    console.log(4)

     pagLi.appendChild(pagAnchor);
     pagination.appendChild(pagLi);
     console.log(5)
}
getTreballador()
