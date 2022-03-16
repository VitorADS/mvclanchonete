<?php $render('header'); ?>
    <h1>Adicionar Comida</h1>
    <button><a href="<?=$base;?>/painelAdm/comidas">Voltar</a></button><hr>
    <form action="<?=$base;?>/painelAdm/comidaAction" method="POST">
        <label>
            Nome: 
            <input type="text" name="name" />
        </label><br>
        <label><br>
            Preco: 
            <input type="number" min="0.00" max="100000.00" step="0.01" name="price">
        </label><br><br>
        <input type="submit" value ="Adicionar"/>
    </form>
<?php $render('footer'); ?>