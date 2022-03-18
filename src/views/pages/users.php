<?php $render('header'); ?>

<h1>Usuarios</h1><hr>

<button><a href="<?=$base;?>/painelAdm">Voltar</a></button>
<button><a href="<?=$base;?>/painelAdm/adicionarUsuario">Adicionar Usuario</a></button>
<hr>
<table>
    <thead>
        <tr>
            <th>Codigo</th>
            <th>Nome</th>
            <th>Administrador</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($users as $user): ?>
            <tr>
                <td><?=$user->id;?></td>
                <td><?=$user->name;?></td>
                <td><?php if($user->admin){echo 'Sim';}else{echo 'Nao';}?></td>
                <td><a href="<?=$base;?>/painelAdm/editarUser/<?=$user->id;?>">Editar</a></td>
                <td><a href="<?=$base;?>/painelAdm/excluirUser/<?=$user->id;?>">Excluir</a></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?=$_SESSION['flash'];?>

<?php $render('footer'); ?>