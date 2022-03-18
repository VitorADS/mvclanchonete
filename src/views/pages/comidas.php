<?php $render('header'); ?>

<h1>Produtos</h1><hr>

<button><a href="<?=$base;?>/painelAdm">Voltar</a></button>
<button><a href="<?=$base;?>/painelAdm/adicionarComida">Adicionar Comida</a></button><hr>
<table>
    <thead>
        <tr>
            <th>Nome</th>
            <th>Preco</th>
            <th>Acoes</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($comidas as $comida): ?>
            <tr>
                <td><?=$comida->name;?></td>
                <td>R$<?=$comida->price;?></td>
                <td><a href="<?=$base;?>/painelAdm/editarComida/<?=$comida->id;?>">Editar</a></td>
                <td><a href="<?=$base;?>/painelAdm/excluirComida/<?=$comida->id;?>">Excluir</a></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php $render('footer'); ?>