<?php $render('header'); ?>
    <button><a href="<?=$base;?>/logout">Sair</a></button><br>
    <h3>Usuario logado: <?=$user->name;?></h3>
    <hr>
        <button><a href="<?=$base;?>/painelAdm">Painel Administrativo</a></button>
    <hr>
    <button><a href="<?=$base;?>/adicionarPedido">Adicionar Pedido</a></button><br><br>
    <table border="1px solid">
        <tr>
            <th>Cliente</th>
            <th>Numero do Pedido</th>
            <th>Status do Pedido</th>
            <th>Criado em</th>
            <th>Total</th>
            <th>Criado Por</th>
            <th>Acoes</th>
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