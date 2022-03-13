<?php $render('header'); ?>
    <form action="<?=$base;?>/painelAdm/comidaAction" method="POST">
        <label>
            Nome: 
            <input type="text" name="name" />
        </label><br>
        <label><br>
            Preco: 
            <input type="number" min="0.00" max="100000.00" step="0.01" name="price">
        </label><br><br>
        <input type="submit" />
    </form>
<?php $render('footer'); ?>