<?php $render('header'); ?>
<h1 align="center">Login  ||  Sistema de controle vendas</h1><hr/>
<?=$_SESSION['flash'];?>
<div id="login">
    <form action="<?=$base;?>/login" method="POST">
        <label>
            <input type="text" name="user" id="user" placeholder="Codigo"/><br/><br/>
        </label><br/><br/>
        <label>
            <input type="password" name="password" id="user" placeholder="Senha"/><br/><br/>
        </label>
            <input type="submit" value="Entrar" id="btnlogin"/>
    </form>
</div>
<?php $_SESSION['flash'] = '';?>
<?php $render('footer'); ?>