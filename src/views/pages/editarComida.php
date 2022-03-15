<?php $render('header'); ?>
    <form action="<?=$base;?>/painelAdm/editarComidaAction" method="POST">
        <label>
            Nome: 
            <input type="text" name="name" value="<?=$comida->name;?>" />
        </label><br>
        <label><br>
            Preco: 
            <input type="number" min="0.00" max="100000.00" step="0.01" name="price" value="<?=$comida->price;?>" />
        </label><br><br>
        <input type="hidden" name="id" value="<?=$comida->id;?>" />
        <input type="submit" value="Editar" />
    </form>
<?php $render('footer'); ?>