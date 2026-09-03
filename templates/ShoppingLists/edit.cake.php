<?php
$this->assign('title', 'Editar Lista — SkyGroceries');
?>

<div class="form-container">
    <div class="page-header">
        <h2>✏️ Editar Lista</h2>
        <p>Altere o nome da sua lista de mercado.</p>
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
        <?= $this->Form->button('Salvar Alterações', ['class' => 'btn btn-primary']) ?>
        <?= $this->Html->link('Cancelar', ['action' => 'index'], ['class' => 'btn btn-secondary']) ?>
    </div>
    <?= $this->Form->end() ?>
</div>