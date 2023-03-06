var rows = [];
var selectId;
var update = false;
//obtener html
const pagination = document.getElementById('pagination');
const table = document.getElementById('taula');
const divErrors = document.getElementById("errors");
divErrors.style.display = "none";

const clientDni = document.getElementById("clientDni");
const clientNom = document.getElementById("clientName");
const clientGenre = document.getElementById("clientGender");
const clientTarja = document.getElementById("clientTarja");
const saveButton = document.getElementById('saveButton')
saveButton.addEventListener('click', onSave)

const Url = {
    get: 'http://localhost:8000/api/client',
    save: 'http://localhost:8000/api/client/save',
    update: 'http://localhost:8000/api/client/update',
    delete: 'http://localhost:8000/api/client/delete',
}
console.log(Url.get)
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
        saveClient();
    }
    if (update != false) {
        updateClient(update)
    }
}

function afegirFila(row) {
    console.log(row)
    let taula = document.getElementById('taula')
    taula.innerHTML += `
    <tr>
        <td id='${row.id}'>${row.id}</td>
        <td id='${row.dni}'>${row.dni}</td>
        <td id='nom'>${row.nom}</td>
        <td id='genere'>${row.genere}</td>
        <td id='tarja_sanitaria'>${row.tarja_sanitaria}</td>
        <td><button id='delete-${row.id}'>Eliminar</button></td>
        <td><button id='update-${row.id}-${row.dni}-${row.nom}-${row.genere}-${row.tarja_sanitaria}'>Actualizar</button></td>
    </tr>
    `
}

async function getClient(){
    try{
        let taula = document.getElementById('taula')
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
            
            let links = data.data.links;
            loadIntoTable(Url.get);
        } else {
            showErrors(data.data)
        }
    } catch (error) {
        errors.innerHTML = "An unexpected error has occurred"
    }
        
   
}

async function saveClient(event){
    let respostaDIV = document.getElementById('resposta')
    respostaDIV.innerHTML = "";
    respostaDIV.className = "alert alert-success"
    var newClient = {
        "dni": clientDni.value,
        "nom": clientNom.value,
        "genere": clientGenre.value,
        "tarja_sanitaria": clientTarja.value,
        
    }
    try{
        const response = await fetch(Url.save, {
            method: 'POST',
            headers: {
                'Content-type': 'application/json',
                'Accept': 'application/json'
            },
            body: JSON.stringify(newClient)
        })
        const data = await response.json();
        if (response.ok){

            respostaDIV.innerHTML = `Client ${data.data.nom} creat correctament`
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
    getClient()
}

function updateHTML(id, dni, nom, genere, tarja_sanitaria){
    update = id
    clientDni.value = dni
    clientNom.value = nom
    clientGenre.value = genere
    clientTarja.value = tarja_sanitaria
}

async function updateClient(id){
    update = false;
    var updateClient = {
        "dni": clientDni.value,
        "nom": clientNom.value,
        "genere": clientGenre.value,
        "tarja_sanitaria": clientTarja.value
    }
    try{
        const response = await fetch(Url.update + '/' + id, {
            method: 'PUT',
            headers: {
                'Content-type': 'application/json',
                'Accept': 'application/json'
            },
            body: JSON.stringify(updateClient) //   "{ 'name' : 'mart'}"
        })

        const data = await response.json(); 
        clientDni.value = ""
        clientNom.value = ""
        clientGenre.value = ""
        clientTarja.value = ""
        if (response.ok) {
            //afegirFila(data.data)
            getClient()
        } else {
            showErrors(data.data)
        }
    } catch (error) {
        errors.innerHTML = "S'ha produit un error inesperat"
        operation = "inserting";
    }
    }

    async function deleteClient(id){
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
                paginate()
                respostaDIV.innerHTML = `Client ${data.data.nom} eliminat Correctament`
                setTimeout(() => {
                    respostaDIV.innerHTML = "";
                    respostaDIV.className = ""
                }, "4000")
    
                //	afegirFila(data.data)
            } else {
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
            const buttons = document.querySelectorAll('button[id^="delete-"]');
            const buttonsUpdate = document.querySelectorAll('button[id^="update-"]');
            for (let button of buttons) {

                button.addEventListener("click", function () {
                    const id = this.id.split("-")[1];
                    deleteClient(id)
                    getClient()
                });
            }
            for (let button of buttonsUpdate) {

                button.addEventListener("click", function () {
                    const id = this.id.split("-")[1];
                    const dni = this.id.split("-")[2];
                    const nom = this.id.split("-")[3];
                    const genere = this.id.split("-")[4];
                    const tarja_sanitaria = this.id.split("-")[5];
                    updateHTML(id, dni, nom, genere, tarja_sanitaria)
                });
            }
        }
        const links = json.data.links;
        console.log(links)
        afegirLinks(links)
        }  catch(error) {
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
        getClient()
    
