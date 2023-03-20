//Pegando o valor do select para passar o url
const selectCountry = country.addEventListener("change", async () => {

    let country = document.getElementById("country").value
    let url = `/api/save/${country}`
    let lastResult = '/api/last-acess'
   

    //Fazendo o retorno da API para mostrar na aplicação
    let result = await fetch(url)
        .then((response) => response.json())
    
    let lastAcess = await fetch(lastResult)
    .then((lastAcess)=> lastAcess.json())
    //Transformando API objeto em array para mapear 
    let transformeApi = Object.keys(result).map((item) => {

    })
    
    function gerar() {

        const lastCountry = document.getElementById('lastCountry')
        const lastData = document.getElementById('lastData')
        lastCountry.innerHTML = lastAcess.country + " - "
        lastData.innerHTML = lastAcess.date
        const table = document.getElementById('tbody');
        table.innerText = ''
        const colum = document.createElement('thead')

        const headStates = document.createElement('th')
        const headConfirmed = document.createElement('th')
        const headDeaths = document.createElement('th')

        headStates.innerText = "Estados"
        headConfirmed.innerText = "Confirmados"
        headDeaths.innerText = "Mortos"

        colum.appendChild(headStates)
        colum.appendChild(headConfirmed)
        colum.appendChild(headDeaths)

        table.appendChild(colum)


        // Interação com a array para criar uma nova row e colum
        for (let i = 0; i < transformeApi.length; i++) {
            const row = document.createElement('tr');


            //Criando uma nova celula 
            const nameCell = document.createElement('td');
            const ageCell = document.createElement('td');
            const ageCell1 = document.createElement('td');

            // Populando as celulas com a informações da API
            nameCell.innerText = result[i].ProvinciaEstado;
            ageCell.innerText = result[i].Confirmados;
            ageCell1.innerText = result[i].Mortos;

            // Anexando cada celula a linha
            row.appendChild(nameCell);
            row.appendChild(ageCell);
            row.appendChild(ageCell1);

            // Anexando a row na table
            table.appendChild(row);

        }

        // Anexando a tabela na pagina
        const container = document.getElementById('table');
        container.appendChild(table);
    }
    return gerar()
})
