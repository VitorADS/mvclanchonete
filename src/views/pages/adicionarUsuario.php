<?php $render('header'); ?>
<h1>Adicionar Usuario</h1><hr>

<button id="botaoV"><a href="<?=$base;?>/painelAdm/users">Voltar</a></button><hr>

<form action="<?=$base;?>/painelAdm/adicionarUsuarioAction" method="POST">
    <label>
        Nome:
        <input type="text" name="name" id="name" />
    </label><br>
    <label><br>
        <input type="checkbox" id="checkboxU" name="admin" value="<?php echo true;?>" /> Administrador?
    </label><br><br>
    <input type="submit" id="botaoU" value="Adicionar" />
</form>
<?php $render('footer'); ?>