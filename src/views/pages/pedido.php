<?php $render('header'); ?>

<h1>Pedido de <?=$pedido->name;?></h1><hr/>

<table border="1px solid">
    <tr>
        <th>Produto</th>
        <th>Quantidade</th>
        <th>Valor</th>
    </tr>
    
</table>
    
<?php $render('footer'); ?>