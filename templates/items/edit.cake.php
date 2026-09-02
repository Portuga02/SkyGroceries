<div class="items form content">
    <?= $this->Form->create($item) ?>
    <fieldset>
        <legend><?= __('Editar Item') ?></legend>
        <?php
            echo $this->Form->control('name', ['label' => 'Nome']);
            echo $this->Form->control('quantity', ['label' => 'Quantidade']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Salvar')) ?>
    <?= $this->Form->end() ?>
</div>