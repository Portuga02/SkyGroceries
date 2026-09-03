<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Item $item
 */
$this->assign('title', h($item->name) . ' — SkyGroceries');
?>

<div class="page-header">
    <div class="page-header-row">
        <h2><?= $item->is_purchased ? '✅' : '⬜' ?> <?= h($item->name) ?></h2>
        <div class="page-header-actions">
            <?= $this->Html->link('Editar', ['action' => 'edit', $item->id], ['class' => 'btn btn-secondary']) ?>
            <?= $this->Form->postLink(
                'Excluir Item',
                ['action' => 'delete', $item->id],
                ['class' => 'btn btn-danger', 'confirm' => 'Tem certeza que deseja remover este item?']
            ) ?>
        </div>
    </div>
</div>

<div class="form-container" style="background: var(--card-bg); padding: 20px; border-radius: 8px; border: 1px solid var(--border-color); margin-top: 20px;">
    <div style="display: flex; flex-direction: column; gap: 12px;">
        <div><strong>Categoria:</strong> <?= h($item->category ?: '📦 Outros') ?></div>
        <div><strong>Quantidade:</strong> <?= h($item->quantity ?? 1) ?></div>
        <?php if ($item->price) : ?>
            <div><strong>Preço:</strong> R$ <?= number_format((float)$item->price, 2, ',', '.') ?></div>
        <?php endif; ?>
        <?php if ($item->hasValue('shopping_list')) : ?>
            <div>
                <strong>Lista:</strong>
                <?= $this->Html->link(h($item->shopping_list->name), ['controller' => 'ShoppingLists', 'action' => 'view', $item->shopping_list_id]) ?>
            </div>
        <?php endif; ?>
        <div><strong>Status:</strong> <?= $item->is_purchased ? 'Comprado ✅' : 'Pendente ⬜' ?></div>
    </div>
</div>

<div class="back-link" style="margin-top: 20px;">
    <?= $this->Html->link('← Voltar', ['controller' => 'ShoppingLists', 'action' => 'view', $item->shopping_list_id]) ?>
</div>
