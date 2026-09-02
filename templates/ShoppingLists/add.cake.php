<?php
$this->assign('title', 'Nova Lista — skyGroceries');
?>

<div class="page-header">
    <h2>📝 Nova Lista de Compras</h2>
</div>

<div class="form-container">
    <?= $this->Form->create($list) ?>
        <?= $this->Form->control('name', [
            'label' => 'Nome da Lista',
            'placeholder' => 'Ex: Compras da Semana, Feira, Mercado do Mês...',
            'class' => 'form-input',
            'required' => true,
            'autofocus' => true
        ]) ?>
        <div class="form-actions">
            <?= $this->Form->button('Criar Lista', ['class' => 'btn btn-primary']) ?>
            <?= $this->Html->link('Cancelar', ['action' => 'index'], ['class' => 'btn btn-secondary']) ?>
        </div>
    <?= $this->Form->end() ?>
</div>
