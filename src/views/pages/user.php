<?php $render('header'); ?>

<h1>Editar Usuario</h1>
<button><a href="<?=$base;?>/painelAdm/users">Voltar</a></button><hr>

<form action="<?=$base;?>/painelAdm/editarUserAction" method="POST">
    <label >
    <input type="text" value="<?=$user->name;?>" name="name" />
    </label><br>
    <label><br>
    <input type="checkbox" name="admin" value="<?php echo true;?>" /> Administrador?
    <input type="hidden" name="id" value="<?=$user->id;?>" />
    </label><br><br>

    <input type="submit" value="Editar">
</form>

<?php $render('footer'); ?>