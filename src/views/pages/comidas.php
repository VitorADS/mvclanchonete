<?php $render('header'); ?>

<h1>Produtos</h1><hr>

<button id="botaoV"><a href="<?=$base;?>/painelAdm">Voltar</a></button>
<button id="botaoV"><a href="<?=$base;?>/painelAdm/adicionarComida">Adicionar Comida</a></button><hr>
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
                <td><button id="botaoP"><a href="<?=$base;?>/painelAdm/editarComida/<?=$comida->id;?>">Editar</a></button>    
                <button id="botaoP"><a href="<?=$base;?>/painelAdm/excluirComida/<?=$comida->id;?>">Excluir</a></button></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php $render('footer'); ?>