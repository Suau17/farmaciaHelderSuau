@extends('plantilla')
@section('content')

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Producte</title>
</head>

<body>
    <h1>CRUD PRODUCTOS</h1>
    <div>
        <input type="text" name="producteNom" id="producteNom">
        <input type="text" name="producteTipus" id="producteTipus">
        <button id="saveButton">save</button>
    </div>
    <div id="resposta" role="alert"></div>
    <div id="errors" role="alert"></div>
    <button onClick="getProducte()">Mostrar Productos</button>
    <table>
        <thead>
            <tr>
                <th>id</th>
                <th>nom</th>
                <th>tipus</th>
                <th>Operacions</th>
            </tr>
        </thead>
        <tbody id="taula">

        </tbody>
    </table>
    <nav class = "mt-2">
        <ul id = 'pagination' class = 'pagination'>

        </ul>
    </nav>

    </form>
</body>

</html>
<script type="text/javascript">

    const pagination = document.getElementById('pagination');
    var rows = [];

    var operation = "interesting";
    var selectId;

    const table = document.getElementById('taula');
    const divErrors = document.getElementById("errors");
    divErrors.style.display = "none";

    const producteNom = document.getElementById("producteNom");
    const producteTipus = document.getElementById("producteTipus");
    const saveButton = document.getElementById('saveButton')
    saveButton.addEventListener('click', onSave)
    console.log(saveButton)

    const url = 'http://localhost:8000/api/producte/save';
    const urlGetProductes = 'http://localhost:8000/api/producte/get';
    const urlDelete = 'http://localhost:8000/api/producte/delete';

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
    }

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
                data.data.data.forEach(element => {
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
        <td>${row.nom}</td>
        <td>${row.tipus}</td>
        <td><button id='delete-${row.id}'>Eliminar</button></td>
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

    async function loadIntoTable(url){
        try{

            const response = await fetch(url);
			const json = await response.json();
			rows = json.data.data;
			
			var i =0
			for(const row of rows) {				
				afegirFila(row)
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

    function agefirLinks(links){
        console.log(links)
        for (const link of links){
            afegirBoto(link)
        }
    }
</script>
@endsection