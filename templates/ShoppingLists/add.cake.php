<?php
$this->assign('title', 'Nova Lista — SkyGroceries');
?>

<div class="form-container">
    <div class="page-header">
        <h2>+ Nova Lista de Compras</h2>
        <p>Dê um nome para a sua nova lista de mercado.</p>
    </div>

    <?= $this->Form->create($shoppingList) ?>
    <fieldset>
        <div class="form-group">
            <?= $this->Form->control('name', [
                'label' => 'Nome da Lista',
                'placeholder' => 'Ex: Compras da Semana, Feira do Mês...',
                'class' => 'form-input',
                'required' => true,
                'autofocus' => true
            ]) ?>
        </div>
    </fieldset>
    <div class="form-actions">
        <?= $this->Form->button('Salvar Lista', ['class' => 'btn btn-primary']) ?>
        <?= $this->Html->link('Cancelar', ['action' => 'index'], ['class' => 'btn btn-secondary']) ?>
    </div>
    <?= $this->Form->end() ?>
</div>