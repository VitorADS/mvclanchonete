<?php $render('header'); ?>
    <button><a href="<?=$base;?>/logout">Sair</a></button><br><br>

    <table border="1px solid">
        <tr>
            <th>Cliente</th>
            <th>Numero do Pedido</th>
            <th>Status do Pedido</th>
            <th>Data</th>
            <th>Total</th>
            <th>Criado Por</th>
            <th>Editar</th>
            <th>Excluir</th>
        </tr>
        <?php foreach($pedidos as $pedido): ?>
            <tr>
                <td><?=$pedido->nomeCliente; ?></td>
                <td><?=$pedido->numeroPedido; ?></td>
                <td><?=$pedido->statusPedido; ?></td>
                <td><?=$pedido->data; ?></td>
                <td><?=$pedido->total; ?></td>
                <td><?=$pedido->userPedido; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php $render('footer'); ?>