<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Item> $items
 */
$this->assign('title', 'Gerenciar Itens — SkyGroceries');
?>

<div class="page-header">
    <div class="page-header-row">
        <h2>📦 Todos os Itens</h2>
        <div class="page-header-actions">
            <?= $this->Html->link('← Voltar para as Listas', ['controller' => 'ShoppingLists', 'action' => 'index'], ['class' => 'btn btn-secondary']) ?>
        </div>
    </div>
</div>

<div class="form-container" style="background: var(--card-bg); padding: 20px; border-radius: 8px; border: 1px solid var(--border-color); margin-top: 20px;">
    <?php if (empty($items)) : ?>
        <div style="text-align: center; padding: 30px; color: gray;">
            <p>Nenhum item cadastrado no sistema.</p>
        </div>
    <?php else : ?>
        <div style="display: flex; flex-direction: column; gap: 10px;">
            <?php foreach ($items as $item): ?>
                <div style="display: flex; justify-content: space-between; align-items: center; padding: 12px 15px; background: var(--bg-color, #f9f9f9); border: 1px solid var(--border-color); border-radius: 6px;">
                    <div>
                        <strong style="font-size: 16px; display: block;"><?= h($item->name) ?></strong>
                        <small style="color: gray;">
                            Categoria: <?= h($item->category) ?> 
                            <?php if ($item->hasValue('shopping_list')): ?>
                                | Lista: <?= h($item->shopping_list->name) ?>
                            <?php endif; ?>
                        </small>
                    </div>

                    <div style="display: flex; align-items: center; gap: 15px;">
                        <?php if ($item->price): ?>
                            <span style="font-weight: bold; color: var(--primary-color);">R$ <?= number_format($item->price, 2, ',', '.') ?></span>
                        <?php endif; ?>
                        
                        <?= $this->Html->link('Editar', ['action' => 'edit', $item->id], ['class' => 'btn btn-small btn-secondary', 'style' => 'text-decoration: none; padding: 6px 12px;']) ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<div style="margin-top: 20px;">
    <?= $this->Html->link('← Voltar para Listas', ['controller' => 'ShoppingLists', 'action' => 'index'], ['class' => 'btn btn-secondary']) ?>
</div>