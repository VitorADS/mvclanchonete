<?php $render('header'); ?>
    <button id="botaoV"><a href="<?=$base;?>/logout">Sair</a></button><br>
    <h3>Usuario logado: <?=$user->name;?></h3>
    <hr>
        <?php if($user->admin): ?>
        <button id="botaoV"><a href="<?=$base;?>/painelAdm">Painel Administrativo</a></button>
    <hr>
        <?php endif; ?>
    <button id="botaoV"><a href="<?=$base;?>/adicionarPedido">Adicionar Pedido</a></button><br><br>
    <table>
        <thead>
            <tr>
                <th>Cliente</th>
                <th>Numero do Pedido</th>
                <th>Status do Pedido</th>
                <th>Criado em</th>
                <th>Total</th>
                <th>Criado Por</th>
                <th>Acoes</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($pedidos as $pedido): ?>
                <tr>
                    <td><?=$pedido->nomeCliente; ?></td>
                    <td><?=$pedido->numeroPedido; ?></td>
                    <td><?=$pedido->statusPedido; ?></td>
                    <td><?=$pedido->data; ?></td>
                    <td>R$<?=$pedido->total; ?></td>
                    <td><?=$pedido->user; ?></td>
                    <td><a href="<?=$base;?>/verPedido/<?=$pedido->numeroPedido;?>">Ver Pedido</a> || 
                    <a href="<?=$base;?>/excluirPedido/<?=$pedido->numeroPedido;?>">Excluir Pedido</a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?=$_SESSION['flash'];?>
<?php $render('footer'); ?>