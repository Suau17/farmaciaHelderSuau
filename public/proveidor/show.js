var URLactual = window.location.href;
let url =URLactual.split('/')
let id = url[5]

alert(id)

async function getProveidor() {
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
            
            let links = data.data.links;
            loadIntoTable(Url.get);
        } else {
            showErrors(data.data)
        }
    } catch (error) {
        error.innerHTML = "An unexpected error has occurred"
    }
}