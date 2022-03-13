<?php $render('header'); ?>

<table>
    <tr>
        <th>Codigo</th>
        <th>Nome</th>
        <th>Administrador</th>
    </tr>
    <?php foreach($users as $user): ?>
        <tr>
            <td><?=$user->id;?></td>
            <td><?=$user->name;?></td>
            <td><?php if($user->admin){echo 'Sim';}else{echo 'Nao';}?></td>
            <td><a href="<?=$base;?>/painelAdm/editarUser/<?=$user->id;?>">Editar</a></td>
            <td><a href="<?=$base;?>/painelAdm/excluirUser/<?=$user->id;?>">Excluir</a></td>
        </tr>
    <?php endforeach; ?>
</table>

<?php $render('footer'); ?>