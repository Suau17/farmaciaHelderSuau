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
    <h1>hola</h1>
    <div >
        <input type="text" name="producteNom" id="producteNom">
        <input type="text" name="producteTipus" id="producteTipus">
        <button id="saveButton" >save</button>
    </div>
    <div id="errors"  role="alert"></div>
    <table>
        <thead>
            <tr>
                <th>id</th>
                <th>nom</th>
                <th>tipus</th>
            </tr>
        </thead>
        <tbody id="taula">

        </tbody>
    </table>
 
</form>
</body>
</html>
<script type="text/javascript">
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

    function showErrors(errors) {
		
		divErrors.style.display = "block"
		divErrors.innerHTML = "";
		const ul = document.createElement("ul")
		for(const error of errors) {				
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


    async function updateProducte(event){
        var newProducte = {
            "nom": producteNom.value,
            "tipus": producteTipus.value
        }
        try {
			const response = await fetch(url+'/'+selectedId,
					{
						method: 'PUT',
						headers: {
							'Content-type': 'application/json',
							'Accept': 'application/json'
						},
						body: JSON.stringify(newProducte) //   "{ 'name' : 'mart'}"
					}
			)
			
			const data = await response.json();
            console.log(data);
			if(response.ok) {
				//afegirFila(data.data)
				
				const nameid = document.getElementById('nom'+data.data.id)
                const nameTip = document.getElementById('tipus'+data.data.id)
				const rowid = document.getElementById(data.data.id)
				nameid.innerHTML = data.data.name;
				rowid.setAttribute('nom',data.data.name);
				producteNom.value = "";
				operation = "inserting";
			}
			else {
				showErrors(data.data)
			}
		} 
		catch(error) {
			errors.innerHTML = "S'ha produit un error inesperat"
			operation = "inserting";
		}
    }

    async function saveProducte(event){

        var newProducte = {
            "nom": producteNom.value,
            "tipus": producteTipus.value
        }
        try{
            const response = await fetch(url,
            {
                method: 'POST',
                headers : {
                    'Content-type': 'application/json',
					'Accept': 'application/json'
                },
                body: JSON.stringify(newProducte)
            })
            const data = await response.json();
			if(response.ok) {
                console.log(data.data)
				//afegirFila(data.data)
			}
			else {
				showErrors(data.data)
			}

        } catch(error) {
			errors.innerHTML = "S'ha produit un error inesperat"
		}
    }


    function afegirFila(row){
        const rowElement = document.createElement("tr");
        rowElement.setAttribute('id',row.id);
        rowElement.setAtribute('nom',row.nom);
        rowElement.setAtribute('tipus',row.tipus);

        const idCell = document.createElement("td");
        idCell.textContent = row.id;
        
        const nomCell = document.createElement("td");
        nomCell.setAttribute('nom','tipus'+row.id);
        nomCell.textContent = row.nom;
        nomCell.textContent = row.tipus;

        const operaciones = document.createElement("td");
        const deletButton = document.createElement("button");
        deletButton.innerHTML = "esborrar";
        deleteButton.addEventListener('click',deletProducte);
        operaciones.appendChild(deletButton);

        const updateButton = document.createElement("button");
        updateButton.innerHTML = "Actualizar";
        updateButton.addEventListener('click',function(event){editProducte(event, row)});
        operaciones.appendChild(updateButton);

        rowElement.appendChild(idCell);
        rowElement.appendChild(nomCell);
        rowElement.appendChild(operaciones);

        taula.appendChild(rowElement);
    }


    </script>
    @endsection
