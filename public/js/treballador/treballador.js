var rows = [];
var selectId;
var update = false;

const pagination = document.getElementById('pagination');
const table = document.getElementById('taula');
const divErrors = document.getElementById("errors");
divErrors.style.display = "none";
const dni = document.getElementById("dni");
const nom = document.getElementById("nomT");
const genre = document.getElementById("genre");
const saveButton = document.getElementById('saveButton');
saveButton.addEventListener('click', onSave);

const Url = {
    get: 'http://localhost:8000/api/treballador/',
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
    <td id='nomT'>${row.nom}</td>
    <td id='tipus'>${row.genre}</td>
    <td><button id='delete-${row.id}'>Eliminar</button></td>
    <td><button id='update-${row.id}-${row.dni}-${row.nom}-${row.tipus}'>Actualizar</button></td>
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
        if (response.ok) {
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
        "dni": dni.value,
        "nomT": nomT.value,
        "genre": genre.value
    }
    try{
        const response = await fetch(Url.save, {
            method: 'POST',
            headers: {
                'Content-type': 'application/json',
                'Accept': 'application/json'
            },
            body: JSON.stringify(newProducte)
        })
        const data = await response.json();
        if(response.ok){
            paginate();
            respostaDIV.innerHTML = `Treballador${data.data.nomT} creat correctament`
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
}

function updateHTML(id,dni,nomT,genre){
    update = id
    dni.value=dni
    nomT.value = nomT
    genre.value = genre
}

async function updateTreballador(id){
    update = false;
    var updateTreballador = {
        "dni": dni.value,
        "nomT": nomT.value,
        "genre": genre.value
    }
    try{
        const response = await fetch(Url.update + '/' + id, {
            method: 'PUT',
            headers: {
                'Content-type': 'application/json',
                'Accept': 'application/json'
            },
            body: JSON.stringify(updateTreballador) //   "{ 'name' : 'mart'}"
        })

        const data = await response.json(); 
        dni.value = ""
        nomT.value = ""
        genre.value = ""
        if (response.ok) {
            //afegirFila(data.data)
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
                    'Accept': 'application/json'
                },
    
            })
            const data = await response.json();
            if(response.ok){
                paginate();
                respostaDIV.innerHTML = `Treballador ${data.data.nomT} eliminat correctament`
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
            afegirFila(row)
            const buttons = document.querySelectorAll('button[id^="delete-"]')
            const buttonsUpdate = document.querySelectorAll('button[id^="update-"]');
            for(let button of button){
                button.addEventListener("click", function () {
                    const id = this.id.split("-")[1];
                    deletTreballador()
                    getTreballador()
                });
            }
            for(let button of buttonsUpdate){
                button.addEventListener("click",function () {
                    const id = this.id.split("-")[1];
                    const dni = this.id.split("-")[2];
                    const nomT = this.id.split("-")[3];
                    const genre = this.id.split("-")[4];
                    updateHTML(id,dni,nomT,genre)
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
}
getTreballador()
