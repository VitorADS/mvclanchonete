<?php $render('header'); ?>

<form action="<?=$base;?>/painelAdm/editarUserAction" method="POST">
    <label >
    <input type="text" value="<?=$user->name;?>" name="name" />
    </label><br>

    <label >
    <input type="checkbox" name="admin" /> Administrador?
    </label><br><br>

    <input type="submit">
</form>

<?php $render('footer'); ?>