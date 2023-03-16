
var rows = [];
var selectId;
var update = false;
//obtener html
const divErrors = document.getElementById("errors");
divErrors.style.display = "none";
let URLactual = window.location;
let urlSplit = URLactual.pathname.split('/');
let idURL = urlSplit[(urlSplit.length-1)];

const producteNom = document.getElementById("buscador");

const Url = {
    getProducto: 'http://localhost:8000/api/producte',
    getPedido: 'http://localhost:8000/api/pedido/get/' + idURL,
    addProducte: 'http://localhost:8000/api/pedido/agregar',
    list: 'http://localhost:8000/api/producte/list',
}
console.log(Url.get)

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
    <td id='nom'>${row.client.nom}</td>
    <td id='nom'>${row.client.tarja_sanitaria}</td>
    <td id='tipus'>${row.preuTotal}</td>
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
            
            let links = data.data.links;
            //loadIntoTable(Url.getPedido);
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
            // loadIntoTable(Url.getProducto);
        } else {
            showErrors(data.data)
        }
    } catch (error) {
        errors.innerHTML = "An unexpected error has occurred"
    }
        
   
}

function updateHTML(id,nom,tipus,stock){
    update = id
    producteNom.value=nom
    producteTipus.value=tipus
    producteStock.value=stock

}

async function agregar(){

    let taula = document.getElementById('taula')
    taula.innerHTML = ``;

    let prod ={
        "idPedido": idURL,
        "nom": producteNom.value
    }
    try{
        const response = await fetch(Url.addProducte,{
            method: 'POST',
            headers:{
                'Content-type': 'application/json',
                'Accept': 'application/json',
                'Authorization': 'Bearer '+ getCookie('token'),
            },
            body: JSON.stringify(prod)
        })
        console.log("ey2")
        const data = await response.json();
        if (response.ok) {
            console.log(data)
            afegirTaula()
        } else {
            showErrors(data.data)
        }
    } catch (error) {
        errors.innerHTML = "An unexpected error has occurred"
    }
    console.log("ey")
}

async function llista(){
    console.log("has entrado")
    try{
        let taula = document.getElementById('taula')
        taula.innerHTML = ``;
        const response = await fetch(Url.list,{
            method: 'GET',
            headers:{
                'Accept':'aplication/json'
            }
        });
        const data = await response.json();
        console.log(data)
        console.log(response)
        if (response.ok) {
            
            let list = document.getElementById("listProductes");
            console.log("llista")
            console.log(data.data.data)
            let lista = data.data
            lista.forEach(element => {
                list.innerHTML += `<option value="${element.nom}">`
            });
            //data.data.data.forEach(e=>console.log(e))
        } else {
            showErrors(data.data)
        }
    } catch (error) {
        errors.innerHTML = "An unexpected error has occurred"
    }
        
   
}

async function afegirTaula(){
    console.log("has entrado")
    try{
        let taula = document.getElementById('taula')
        taula.innerHTML = ``;
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
            
            let links = data.data.links;
            loadIntoTable(Url.getProducto);
        } else {
            showErrors(data.data)
        }
    } catch (error) {
        error.innerHTML = "An unexpected error has occurred"
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
                getPedido()
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
    


    getPedido()
    getProducte()
    llista()