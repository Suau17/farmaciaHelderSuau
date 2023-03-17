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
