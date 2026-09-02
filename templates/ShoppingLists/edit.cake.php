<div class="row">
    <div class="column column-50 column-offset-25">
        <div class="items form content">
            <?= $this->Form->create($item) ?>
            <fieldset>
                <legend><?= __('Editar Item') ?></legend>
                <?php
                    echo $this->Form->control('name', [
                        'label' => 'Nome',
                        'class' => 'form-control'
                    ]);
                    echo $this->Form->control('quantity', [
                        'label' => 'Quantidade',
                        'class' => 'form-control'
                    ]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Salvar'), ['class' => 'button-primary']) ?>
            <?= $this->Html->link(__('Cancelar'), ['controller' => 'ShoppingLists', 'action' => 'index'], ['class' => 'button button-outline']) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>