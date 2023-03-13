console.log('egag')
const formP = document.getElementById('formPedidos')

const divPedidos = document.getElementById('divPedidos')
function createPedidos() {
    formP.classList.add('d-block')
    formP.classList.remove('d-none')
    divPedidos.classList.add('d-none')
    divPedidos.classList.remove('d-block')

}

function viewPedidos() {
    divPedidos.classList.add('d-block')
    divPedidos.classList.remove('d-none')
    formP.classList.add('d-none')
    formP.classList.remove('d-block')
}
var rows = [];
var selectId;
var update = false;
//obtener html
const pagination = document.getElementById('pagination');
const table = document.getElementById('taula');
const divErrors = document.getElementById("errors");
divErrors.style.display = "none";
const producteNom = document.getElementById("producteNom");
const producteTipus = document.getElementById("producteTipus");
const producteStock = document.getElementById("producteStock");



const Url = {
    get: 'http://localhost:8000/api/pedido/get',
    save: 'http://localhost:8000/api/pedido/create',
    pagar: 'http://localhost:8000/api/pedido/pagar',
    delete: 'http://localhost:8000/api/pedido/delete',

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

async function getProducte(){
    console.log("has entrado")
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

async function saveProducte(event){
    let respostaDIV = document.getElementById('resposta')
    respostaDIV.innerHTML = "";
    respostaDIV.className = "alert alert-success"
    var newProducte = {
        "nom": producteNom.value,
        "tipus": producteTipus.value,
        "stock": producteStock.value
    }
    try{
        console.log(document.cookie)
        const response = await fetch(Url.save, {
            method: 'POST',
            headers: {
                'Content-type': 'application/json',
                'Accept': 'application/json',
                'Authorization': 'Bearer '+ getCookie('token'),
            },
            body: JSON.stringify(newProducte)
        })
        const data = await response.json();
        if (response.ok){

            respostaDIV.innerHTML = `Producte ${data.data.nom} creat correctament`
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
    getProducte()
    paginate()
}

function updateHTML(id,nom,tipus,stock){
    update = id
    producteNom.value=nom
    producteTipus.value=tipus
    producteStock.value=stock

}


    async function deleteProducte(id){
        let respostaDIV = document.getElementById('resposta')
        respostaDIV.innerHTML = "";
        respostaDIV.className = "alert alert-danger"
        try {
            const response = await fetch(Url.delete + '/' + id, {
                method: 'DELETE',
                headers: {
                    'Content-type': 'application/json',
                    'Accept': 'application/json',
                    'Authorization': 'Bearer '+ getCookie('token'),
                },
    
            })
            const data = await response.json();
            if(response.ok){
                paginate()
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

       function agregarCarrito(){
        

        
       }
        getProducte()
    
