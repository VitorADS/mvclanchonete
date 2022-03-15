<?php $render('header'); ?>
<h1>Adicionar Usuario</h1><hr>

<button><a href="<?=$base;?>/painelAdm/users">Voltar</a></button><hr>

<form action="<?=$base;?>/painelAdm/adicionarUsuarioAction" method="POST">
    <label>
        Nome:
        <input type="text" name="name" />
    </label><br>
    <label><br>
        <input type="checkbox" name="admin" value="<?php echo true;?>" /> Administrador?
    </label><br><br>
    <input type="submit" value="Adicionar" />
</form>
<?php $render('footer'); ?>