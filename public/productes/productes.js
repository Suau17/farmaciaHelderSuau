console.log("Has entrat")
const pagination = document.getElementById('pagination');
var rows = [];

var operation = "interesting";
var selectId;

const table = document.getElementById('taula');
const divErrors = document.getElementById("errors");
divErrors.style.display = "none";

const producteNom = document.getElementById("producteNom");
const producteTipus = document.getElementById("producteTipus");
const saveButton = document.getElementById('saveButton');
saveButton.addEventListener('click', onSave);
// updateButton.addEventListener('click',updateP);
const inputNom = document.getElementById("producteNom");
const inputTip = document.getElementById("producteTipus");
console.log(saveButton)

const url = 'http://localhost:8000/api/producte/save';
const urlGetProductes = 'http://localhost:8000/api/producte/get';
const urlDelete = 'http://localhost:8000/api/producte/delete';
const urlUpdate = 'http://localhost:8000/api/producte/update'

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
    console.log("ei!!!")
    saveProducte();
    updateProducte();
    
}
// function updateP(event){
//     console.log('eeeeeeeeei')
//     updateProducte();
// }


async function getProducte() {
    try {
        let taula = document.getElementById('taula')
    taula.innerHTML = ``;
        const response = await fetch(urlGetProductes, {
            method: 'GET',
            headers: {
                'Accept': 'application/json'
            }
        });
        const data = await response.json();

        

        if (response.ok) {
            console.log('asdasda')
            let links = data.data.links;
            loadIntoTable(urlGetProductes);
            /*data.data.data.forEach(element => {
                afegirFila(element)
                const buttons = document.querySelectorAll('button[id^="delete-"]');
                for (let button of buttons) {

                    button.addEventListener("click", function() {
                        const id = this.id.split("-")[1];
                        deleteProducte(id)
                        getProducte()
                    });
                }

                
            });
            */
        } else {
            showErrors(data.data)
        }
    } catch (error) {
        errors.innerHTML = "An unexpected error has occurred"
    }
}

function añadirUp(producteNom,producteTipus){
    console.log("isdvorbvo");
     inputNom.value = producteNom;
     inputTip.value = producteTipus;
}
async function updateProducte(event) {
    console.log('has updateado');
    var newProducte = {
        "nom": producteNom.value,
        "tipus": producteTipus.value
    }
    try {
        const response = await fetch(url + '/' + selectdId, {
            method: 'PUT',
            headers: {
                'Content-type': 'application/json',
                'Accept': 'application/json'
            },
            body: JSON.stringify(newProducte) //   "{ 'name' : 'mart'}"
        })

        const data = await response.json();
        console.log(data);
        if (response.ok) {
            //afegirFila(data.data)
            
            const nameid = document.getElementById('producteNom' + data.data.id)
            const nameTip = document.getElementById('producteTipus' + data.data.id)
            const rowid = document.getElementById(data.data.id)
            nameid.innerHTML = data.data.nom;
            nameTip.innerHTML = data.data.tipus;
            rowid.setAttribute('nom', data.data.nom)
            rowid.setAttribute('tipus', data.data.tipus);
            producteNom.value = "";
            operation = "inserting";
        } else {
            showErrors(data.data)
        }
    } catch (error) {
        errors.innerHTML = "S'ha produit un error inesperat";
        operation = "inserting";
    }
}

async function saveProducte(event) {
    let respostaDIV = document.getElementById('resposta')
    respostaDIV.innerHTML = "";
    respostaDIV.className = "alert alert-success"
    var newProducte = {
        "nom": producteNom.value,
        "tipus": producteTipus.value
    }
    try {
        const response = await fetch(url, {
            method: 'POST',
            headers: {
                'Content-type': 'application/json',
                'Accept': 'application/json'
            },
            body: JSON.stringify(newProducte)
        })
        const data = await response.json();
        if (response.ok) {
            console.log(data.data.nom)
            producteNom.innerHTML = "";
            producteTipus.innerHTML = "";
            respostaDIV.innerHTML = `Producte ${data.data.nom} Creat Correctament`
            setTimeout(() => {
                respostaDIV.innerHTML = "";
                respostaDIV.className = "";
            }, "4000")

            //	afegirFila(data.data)
        } else {
            showErrors(data.data)
        }

    } catch (error) {
        errors.innerHTML = "S'ha produit un error inesperat"
    }
}

async function deleteProducte(id) {
    let respostaDIV = document.getElementById('resposta')
    respostaDIV.innerHTML = "";
    respostaDIV.className = "alert alert-danger"
    var newProducte = {
        "id": producteNom.value,
        "tipus": producteTipus.value
    }
    try {
        const response = await fetch(urlDelete+ '/' + id, {
            method: 'DELETE',
            headers: {
                'Content-type': 'application/json',
                'Accept': 'application/json'
            },
            
        })
        const data = await response.json();
        if (response.ok) {
            console.log(data.data.nom)
            respostaDIV.innerHTML = `Producte ${data.data.nom} eliminat Correctament`
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


function afegirFila(row) {
    console.log(row)
    let taula = document.getElementById('taula')
    taula.innerHTML += `
    <tr>
    <td id='${row.id}'>${row.id}</td>
    <td id="inputNom">${row.nom}</td>
    <td id="inputTip">${row.tipus}</td>
    <td><button id='delete-${row.id}'>Eliminar</button></td>
    <td><button id='update-${row.id}'>Update</button></td>
    </tr>
    `

    // const rowElement = document.createElement("tr");
    // rowElement.setAttribute('id', row.id);
    // rowElement.setAtribute('nom', row.nom);
    // rowElement.setAtribute('tipus', row.tipus);

    // const idCell = document.createElement("td");
    // idCell.textContent = row.id;

    // const nomCell = document.createElement("td");
    // nomCell.setAttribute('nom', 'tipus' + row.id);
    // nomCell.textContent = row.nom;
    // nomCell.textContent = row.tipus;

    // const operaciones = document.createElement("td");
    // const deletButton = document.createElement("button");
    // deletButton.innerHTML = "esborrar";
    // deleteButton.addEventListener('click', deletProducte);
    // operaciones.appendChild(deletButton);

    // const updateButton = document.createElement("button");
    // updateButton.innerHTML = "Actualizar";
    // updateButton.addEventListener('click', function(event) {
    //     editProducte(event, row)
    // });
    // operaciones.appendChild(updateButton);

    // rowElement.appendChild(idCell);
    // rowElement.appendChild(nomCell);
    // rowElement.appendChild(operaciones);

    // taula.appendChild(rowElement);
}

function afegirBoto(link){
    const pagLi = document.createElement("li");
    pagLi.classList.add('page-item');

    const pagAnchor = document.createElement("a");
    pagAnchor.innerHTML = link.label;
    pagAnchor.addEventListener('click', function(event) {paginate(link.url)});
    pagAnchor.classList.add('page-link');
    pagAnchor.setAttribute('href', "#");

    pagLi.appendChild(pagAnchor);
    pagination.appendChild(pagLi);
}

function afegirLinks(links){
    console.log("has entrat")
    for (const link of links){
        
        afegirBoto(link)
        
    }
}

async function loadIntoTable(url){
    try{

        const response = await fetch(url);
        const json = await response.json();
        rows = json.data.data;
        
        var i =0
        for(const row of rows) {				
            afegirFila(row)
                
                
                const buttons = document.querySelectorAll('button[id^="delete-"]');
                for (let button of buttons) {

                    button.addEventListener("click", function() {
                        const id = this.id.split("-")[1];
                        deleteProducte(id)
                    });
                }
                const buttons2 = document.querySelectorAll('button[id^="update-"]');
                for (let button of buttons2) {

                    button.addEventListener("click", function() {
                        const id = this.id.split("-")[1];
                        añadirUp(inputNom,inputTip);
                        // updateProducte(id)
                    });
                }

                
            
        }

        const links = json.data.links;
        
        console.log(links)
        afegirLinks(links)
    }
    catch(error) {
        errors.innerHTML = "No es pot accedir a la base de dades"
    }
    
}

function paginate(url){
    pagination.innerHTML = "";
    taula.innerHTML = "";
    loadIntoTable(url);
}