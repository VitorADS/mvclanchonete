<?php $render('header'); ?>

<h1>Pedido de <?=$pedido->nomeCliente;?></h1>
<button><a href="<?=$base;?>/pedidos">Voltar</a></button><hr/>

<form action="<?=$base;?>/adicionarItem" method="POST">
    <select name="produto">
        <?php foreach($comidasSelect as $select): ?>
            <option value="<?=$select->id;?>"><?=$select->name;?> || R$<?=$select->price;?></option>
        <?php endforeach; ?>
    </select>
    <input type="number" name="quantidade" placeholder="Quantidade" id="quantidadePedido" />
    <input type="hidden" name="numeroPedido" value="<?=$pedido->numeroPedido;?>" />
    <input onclick="verificaQuantidade()" type="submit" value="Adicionar" />
</form><br>
<button><a href="<?=$base;?>/finalizarPedido?id=<?=$pedido->numeroPedido;?>">Finalizar Pedido</a></button><hr>

<table>
    <thead>
        <tr>
            <th>Produto</th>
            <th>Quantidade</th>
            <th>Valor</th>
            <th>Acoes</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($comidas as $comida): ?>
            <tr>
                <td><?=$comida->name;?></td>
                <td><?=$comida->quantidade;?></td>
                <td>R$ <?=$comida->price;?></td>
                <td><a href="<?=$base;?>/excluirItem/<?=$comida->id;?>">Excluir</a></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
    <tr>
        <td><strong>Total R$ <?=$pedido->total;?></strong></td>
    </tr>
</table>
    
<?php $render('footer'); ?>