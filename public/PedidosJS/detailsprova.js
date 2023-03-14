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
    delete: 'http://localhost:8000/api/producte/delete',
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

function agregar(){

    let prod ={
        "idPedido": idURL,
        "nom": producteNom.value
    }
    try{
        const response = fetch(Url.addProducte,{
            method: 'POST',
            headers:{
                'Accept':'aplication/json'
            },
            body: JSON.stringify(prod)
        });

        const data = response.json();
        if (response.ok) {
            console.log(data)
            
        } else {
            showErrors(data.data)
        }
    } catch (error) {
        errors.innerHTML = "An unexpected error has occurred"
    }
    
}
    


    getPedido()
    getProducte()