var rows = [];
var selectId;
var update = false;
// obtener html
let table = document.getElementById('taula');
let divErrors = document.getElementById("errors");
divErrors.style.display = "none";
let proveidorNom = document.getElementById("inputNom");
let proveidorPais = document.getElementById("inputPais");
let saveButton = document.getElementById('saveButton')
saveButton.addEventListener('click', onSave)


let Url = {
    get: 'http://localhost:8000/api/proveidor/',
    save: 'http://localhost:8000/api/proveidor/save',
    update: 'http://localhost:8000/api/proveidor/update',
    delete: 'http://localhost:8000/api/proveidor/delete',
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
        saveProducte();
    }
    if (update != false) {
        updateProducte(update)
    }
}

function afegirFila(row) {
    console.log(row)
    let taula = document.getElementById('taula')
    taula.innerHTML += `
    <tr class='rowDataTD' onClick='verInfo(${row.id})'>
    <td id='${row.id}'>${row.id}</td>
    <td id='tdNom'>${row.nomE}</td>
    <td id='tdPais'>${row.pais}</td>
    <td><button id='info'>Informacion</button></td>
    <td><button id='update-${row.id}-${row.nomE}-${row.pais}'>Actualizar</button></td>
    <td><button id='delete-${row.id}'>Eliminar</button></td>
    </tr>
    `
}
console.log('FUNCIONA ESTA MIERDA??????')
function verInfo(id){
    console.log(id)
}
async function getProducte() {
    try {
        let taula = document.getElementById('taula')
        taula.innerHTML = ``;
        const response = await fetch(Url.get, {
            method: 'GET',
            headers: {
                'Accept': 'application/json'
            }
        });
        const data = await response.json();
        if (response.ok) {
            console.log('asdasda')
            data.data.forEach(element => {
                afegirFila(element)
                const buttons = document.querySelectorAll('button[id^="delete-"]');
                const buttonsUpdate = document.querySelectorAll('button[id^="update-"]');
                for (let button of buttons) {

                    button.addEventListener("click", function () {
                        const id = this.id.split("-")[1];
                        deleteProducte(id)
                        getProducte()
                    });
                }
                for (let button of buttonsUpdate) {

                    button.addEventListener("click", function () {
                        const id = this.id.split("-")[1];
                        const nomE = this.id.split("-")[2];
                        const pais = this.id.split("-")[3];
                        updateHTML(id, nomE,pais)
                    });
                }
            });

        } else {
            showErrors(data.data)
        }
    } catch (error) {
        errors.innerHTML = "An unexpected error has occurred"
    }
}

async function saveProducte(event) {
    let respostaDIV = document.getElementById('resposta')
    respostaDIV.innerHTML = "";
    respostaDIV.className = "alert alert-success"
    var newProveidor = {
        "nomE": proveidorNom.value,
        "pais": proveidorPais.value
    }
    try {
        const response = await fetch(Url.save, {
            method: 'POST',
            headers: {
                'Content-type': 'application/json',
                'Accept': 'application/json'
            },
            body: JSON.stringify(newProveidor)
        })
        const data = await response.json();
        if (response.ok) {
            console.log(data.data.nom)
            respostaDIV.innerHTML = `Producte ${data.data.nom} Creat Correctament`
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

function updateHTML(id, nomE, pais) {
    console.log(id, nomE, pais)
    update = id
    proveidorNom.value = nomE
    proveidorPais.value = pais
}

async function updateProducte(id) {
    update = false
    var updateProducte = {
        "nomE": proveidorNom.value,
        "pais": proveidorPais.value
    }
    console.log(updateProducte)
    try {
        const response = await fetch(Url.update + '/' + id, {
            method: 'PUT',
            headers: {
                'Content-type': 'application/json',
                'Accept': 'application/json'
            },
            body: JSON.stringify(updateProducte) //   "{ 'name' : 'mart'}"
        })

        const data = await response.json();
        proveidorNom.value = ""
        proveidorPais.value = ""
        if (response.ok) {
            //afegirFila(data.data)
            getProducte()
        } else {
            showErrors(data.data)
        }
    } catch (error) {
        errors.innerHTML = "S'ha produit un error inesperat"
        operation = "inserting";
    }
}

async function deleteProducte(id) {
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
        error.innerHTML = "S'ha produit un error inesperat"
    }
}

