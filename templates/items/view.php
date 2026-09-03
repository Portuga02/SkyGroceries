<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Item $item
 */
$this->assign('title', 'Editar Item — SkyGroceries');
?>

<div class="page-header">
    <div class="page-header-row">
        <h2>✏️ Editar Item</h2>
        <div class="page-header-actions">
            <?= $this->Form->postLink(
                'Excluir Item',
                ['action' => 'delete', $item->id],
                ['class' => 'btn btn-danger', 'confirm' => 'Tem certeza que deseja remover este item?']
            ) ?>
        </div>
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
                    'class' => 'form-input',
                    'style' => 'width: 100%; padding: 10px;'
                ]) ?>
            </div>

            <div>
                <label style="display: block; margin-bottom: 5px; font-weight: bold;">Quantidade</label>
                <?= $this->Form->control('quantity', [
                    'label' => false,
                    'type' => 'number',
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

            <div style="display: flex; align-items: center; gap: 10px;">
                <?= $this->Form->control('is_purchased', [
                    'label' => 'Item já comprado',
                    'type' => 'checkbox'
                ]) ?>
            </div>

            <div style="display: flex; gap: 10px; margin-top: 10px;">
                <?= $this->Form->button('Salvar Alterações', ['class' => 'btn btn-primary']) ?>
                <?= $this->Html->link('Cancelar', ['controller' => 'ShoppingLists', 'action' => 'view', $item->shopping_list_id], ['class' => 'btn btn-secondary', 'style' => 'text-decoration: none; display: inline-flex; align-items: center; justify-content: center;']) ?>
            </div>
        </div>
    <?= $this->Form->end() ?>
</div>