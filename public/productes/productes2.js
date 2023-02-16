var rows = [];
var { imprime } = '/';
var selectId;
var update = false;

// obtener html
const table = document.getElementById('taula');
const divErrors = document.getElementById("errors");
divErrors.style.display = "none";
const Pnom = document.getElementById("producteNom");
const tdNom = document.getElementById('tdNom');
const tdtipus = document.getElementById('tdtipus')
const Ptipus = document.getElementById("producteTipus");
const saveButton = document.getElementById('saveButton')
saveButton.addEventListener('click', onSave)


const Url = {
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
    <tr>
    <td id='${row.id}'>${row.id}</td>
    <td id='tdNom'>${row.nom}</td>
    <td id='tdPais'>${row.tipus}</td>
    <td><button id='delete-${row.id}'>Eliminar</button></td>
    <td><button id='update-${row.id}'>Actualizar</button></td>
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
                        updateHTML(id, element.nomE, element.pais)
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
    var newProducte= {
        "nom": Pnom.value,
        "tipus": Ptipus.value
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

function updateHTML(id, nom, tipus) {
    console.log('dafaf')
    update = id
    proveidorNom.value = nom
    proveidorPais.value = tipus
}

async function updateProducte(id) {
    update = false
    var updateProducte = {
        "nom": Pnom.value,
        "tipus": Ptipus.value
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
        Pnom.value = ""
        Ptipus.value = ""
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
        errors.innerHTML = "S'ha produit un error inesperat"
    }
}
