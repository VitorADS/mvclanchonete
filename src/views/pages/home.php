<?php $render('header'); ?>
<h1>Login  ||  Sistema de controle vendas</h1><hr/>
<?=$_SESSION['flash'];?>
<form action="<?=$base;?>/login" method="POST">
    <label>
        Usuario: <br/>
        <input type="text" name="user" /><br/><br/>
    </label>
    <label>
        Senha: <br/>
        <input type="password" name="password" /><br/><br/>
    </label>
        <input type="submit" value="Entrar" />
</form>
<?php $_SESSION['flash'] = '';?>
<?php $render('footer'); ?>