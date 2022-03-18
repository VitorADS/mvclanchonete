function verificaQuantidade(){
    if(document.querySelector('#quantidadePedido').value <= 0){
        alert('Quantidade tem que ser maior que 0!');
    }
}