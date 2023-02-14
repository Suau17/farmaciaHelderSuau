var rows = [];
var {imprime} = '/;
var selectId;


// obtener html
const table = document.getElementById('taula');
const divErrors = document.getElementById("errors");
divErrors.style.display = "none";
const proveidorNom = document.getElementById("inputNom");
const proveidorPais = document.getElementById("inputPais");
const saveButton = document.getElementById('saveButton')
saveButton.addEventListener('click', onSave)


const Url = {
    get: 'http://localhost:8000/api/proveidor/',
    save: 'http://localhost:8000/api/proveidor/save',
    update: '',
    delete: '',
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
    saveProducte();
}

function afegirFila(row) {
    console.log(row)
    let taula = document.getElementById('taula')
    taula.innerHTML += `
    <tr>
    <td id='${row.id}'>${row.id}</td>
    <td>${row.nomE}</td>
    <td>${row.pais}</td>
    <td><button id='delete-${row.id}'>Eliminar</button></td>
    </tr>
    `
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
                for (let button of buttons) {

                    button.addEventListener("click", function() {
                        const id = this.id.split("-")[1];
                        deleteProducte(id)
                        getProducte()
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

async function updateProducte(event) {
    var newProducte = {
        "nom": producteNom.value,
        "tipus": producteTipus.value
    }
    try {
        const response = await fetch(url + '/' + selectedId, {
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

            const nameid = document.getElementById('nom' + data.data.id)
            const nameTip = document.getElementById('tipus' + data.data.id)
            const rowid = document.getElementById(data.data.id)
            nameid.innerHTML = data.data.name;
            rowid.setAttribute('nom', data.data.name);
            producteNom.value = "";
            operation = "inserting";
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

