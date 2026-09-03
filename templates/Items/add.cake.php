<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Item $item
 * @var string|null $shoppingListId
 */
$this->assign('title', 'Adicionar Item — SkyGroceries');
?>

<div class="page-header">
    <div class="page-header-row">
        <h2>➕ Adicionar Item</h2>
    </div>
</div>

<div class="form-container" style="background: var(--card-bg); padding: 20px; border-radius: 8px; border: 1px solid var(--border-color); margin-top: 20px;">
    <?= $this->Form->create($item) ?>
        <div style="display: flex; flex-direction: column; gap: 15px;">
            <div>
                <label style="display: block; margin-bottom: 5px; font-weight: bold;">Nome do Item</label>
                <?= $this->Form->control('name', [
                    'label' => false,
                    'class' => 'form-input',
                    'style' => 'width: 100%; padding: 10px;',
                    'required' => true
                ]) ?>
            </div>

            <div>
                <label style="display: block; margin-bottom: 5px; font-weight: bold;">Categoria</label>
                <?= $this->Form->control('category', [
                    'label' => false,
                    'type' => 'select',
                    'options' => [
                        '🥬 Hortifrúti' => '🥬 Hortifrúti',
                        '🥩 Açougue'    => '🥩 Açougue',
                        '🧀 Laticínios' => '🧀 Laticínios',
                        '🥖 Padaria'    => '🥖 Padaria',
                        '🥤 Bebidas'    => '🥤 Bebidas',
                        '🧹 Limpeza'    => '🧹 Limpeza',
                        '🧴 Higiene'    => '🧴 Higiene',
                        '📦 Outros'     => '📦 Outros'
                    ],
                    'default' => '📦 Outros',
                    'class' => 'form-input',
                    'style' => 'width: 100%; padding: 10px;'
                ]) ?>
            </div>

            <div>
                <label style="display: block; margin-bottom: 5px; font-weight: bold;">Quantidade</label>
                <?= $this->Form->control('quantity', [
                    'label' => false,
                    'type' => 'number',
                    'value' => 1,
                    'min' => 1,
                    'max' => 99,
                    'class' => 'form-input',
                    'style' => 'width: 100%; padding: 10px;'
                ]) ?>
            </div>

            <div>
                <label style="display: block; margin-bottom: 5px; font-weight: bold;">Preço (R$)</label>
                <?= $this->Form->control('price', [
                    'label' => false,
                    'type' => 'number',
                    'step' => '0.01',
                    'class' => 'form-input',
                    'style' => 'width: 100%; padding: 10px;'
                ]) ?>
            </div>

            <div style="display: flex; gap: 10px; margin-top: 5px;">
                <?= $this->Form->button('Adicionar Item', ['class' => 'btn btn-primary']) ?>
                <?= $this->Html->link('Cancelar', ['controller' => 'ShoppingLists', 'action' => 'view', $shoppingListId], ['class' => 'btn btn-secondary', 'style' => 'text-decoration: none; display: inline-flex; align-items: center; justify-content: center;']) ?>
            </div>
        </div>
    <?= $this->Form->end() ?>
</div>
