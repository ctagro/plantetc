const DataMenorHoje = document.querySelector('#date')

date.addEventListener('blur', (evento) => {
  
   validaDataMenorHoje(evento.target)
})

function validaDataMenorHoje(input) {
    const dataRecebida = new Date(input.value)
    const dataAtual = new Date()
    const dataFutura = dataRecebida > dataAtual
    let mensagem = ''

    if(dataFutura){
        const mensagem = "Data inválida - maior que data atual"
    }
    
    input.setCustomValidity(mensagem)
}

