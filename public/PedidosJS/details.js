let URLactual = window.location;
console.log(URLactual);

let urlSplit = URLactual.pathname.split('/');
console.log(urlSplit);

let idURL = urlSplit[(urlSplit.length-1)];

console.log(idURL);

const showProd = document.querySelector(".productos");

let urlGet = 'http://localhost:8000/api/pedido/get/' + idURL;

const divErrors = document.getElementById("errors");
divErrors.style.display = "none";



const Url = {
    getProducto: 'http://localhost:8000/api/pedido/get',
    getPedido: 'http://localhost:8000/api/pedido/get/' + idURL,
    pagar: 'http://localhost:8000/api/pedido/pagar',
    delete: 'http://localhost:8000/api/pedido/delete',
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

function afegirFila(row) {
    console.log(row)
    let taula = document.getElementById('taula')
    taula.innerHTML += `
    <tr class='rowDataTD'>
    <td id='${row.id}'>${row.id}</td>
    <td id='nom'>${row.client_id}</td>
    <td id='nom'>${row.preuTotal}</td>
    <td id='tipus'>${row.created_at}</td>
    <td id='tipus'>${row.updated_at}</td>
    <td id='stock'>${(row.estado == 1) ? 'Pagado' : 'Sin pagar'}</td>
    ${(row.estado == 1) ? '' : '<td><button onClick="pagar(${row.id})">Pagar</button></td>'}
    
    <td><button id='info-${row.id}'>Detalles</button></td>
    </tr>
    `
}

async function getPedido(){
    console.log("has entrado")
    try{
        
        const response = await fetch(Url.getPedido,{
            method: 'GET',
            headers:{
                'Accept':'aplication/json'
            }
        });
        const data = await response.json();
        console.log(data)
        console.log(response)
        if (response.ok) {
            
            
        } else {
            showErrors(data.data)
        }
    } catch (error) {
        error.innerHTML = "An unexpected error has occurred"
    }


        
   
}

async function getProducte(){
    console.log("has entrado")
    try{
        let taula = document.getElementById('taula')
        taula.innerHTML = ``;
        const response = await fetch(Url.getProducto,{
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
            loadIntoTable(Url.getProducte);
        } else {
            showErrors(data.data)
        }
    } catch (error) {
        errors.innerHTML = "An unexpected error has occurred"
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
                deleteProducte(id)
                getProducte()
            });
        }
        for (let button of buttonsUpdate) {

            button.addEventListener("click", function () {
                const id = this.id.split("-")[1];
                const nom = this.id.split("-")[2];
                const tipus = this.id.split("-")[3];
                const stock = this.id.split("-")[4];
                updateHTML(id, nom,tipus,stock)
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


getProducte();

getPedido();