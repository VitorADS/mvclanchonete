<?php $render('header'); ?>
    <h1>Adicionar Pedido</h1>
    <button><a href="<?=$base;?>/pedidos">Voltar</a></button><hr>
    <form action="<?=$base;?>/adicionarPedidoAction" method="POST">
        <label>
            <input type="text" name="name" placeholder="Nome do Cliente" />
        </label><br><br>
        <input type="submit" value="Adicionar" />
    </form>
<?php $render('footer'); ?>