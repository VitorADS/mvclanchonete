<?php $render('header'); ?>
    <button><a href="<?=$base;?>/logout">Sair</a></button><br><br>
    <hr>
        <button><a href="<?=$base;?>/painelAdm">Painel Administrativo</a></button>
    <hr>
    <table border="1px solid">
        <tr>
            <th>Cliente</th>
            <th>Numero do Pedido</th>
            <th>Status do Pedido</th>
            <th>Data</th>
            <th>Total</th>
            <th>Criado Por</th>
        </tr>
        <?php foreach($pedidos as $pedido): ?>
            <tr>
                <td><?=$pedido->nomeCliente; ?></td>
                <td><?=$pedido->numeroPedido; ?></td>
                <td><?=$pedido->statusPedido; ?></td>
                <td><?=$pedido->data; ?></td>
                <td><?=$pedido->total; ?></td>
                <td><?=$pedido->user; ?></td>
                <td><a href="<?=$base;?>/verPedido/<?=$pedido->numeroPedido;?>">Ver Pedido</a></td>
                <td><a href="<?=$base;?>/excluirPedido/<?=$pedido->numeroPedido;?>">Excluir Pedido</a></td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php $render('footer'); ?>