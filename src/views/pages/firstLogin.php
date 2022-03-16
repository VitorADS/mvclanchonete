<?php $render('header'); ?>
    <h1>Primeiro Acesso - Criar Senha</h1><hr>
    <form action="<?=$base;?>/firstLoginAction" method="POST">
        <label>
            Senha:
            <input type="password" name="password" />
        </label><br><br>
        <label>
            Confirme a senha:
            <input type="password" name="password2" />
        </label><br><br>
        <input type="hidden" name="id" value="<?=$user->id;?>" />
        <input type="submit" value="Enviar" />
    </form>
<?php $render('footer'); ?>