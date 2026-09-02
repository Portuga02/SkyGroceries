<?php
$this->assign('title', h($list->name) . ' — skyGroceries');
?>

<div class="page-header">
    <div class="page-header-row">
        <h2> <?= h($list->name) ?></h2>
        <div class="page-header-actions">
            <?= $this->Html->link('Editar Lista', ['action' => 'edit', $list->id], ['class' => 'btn btn-secondary']) ?>
            <?= $this->Form->postLink(
                'Excluir Lista',
                ['action' => 'delete', $list->id],
                ['class' => 'btn btn-danger', 'confirm' => 'Tem certeza que deseja excluir esta lista e todos os itens?']
            ) ?>
        </div>
    </div>
    <p><?= $purchasedCount ?> de <?= $totalCount ?> itens comprados</p>

    <?php if ($totalCount > 0) : ?>
        <div class="progress-bar progress-bar-large">
            <div class="progress-fill" style="width: <?= round(($purchasedCount / $totalCount) * 100) ?>%">
                <?php if ($purchasedCount > 0) : ?>
                    <?= round(($purchasedCount / $totalCount) * 100) ?>%
                <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>
</div>

<?php if ($list->items && count($list->items) > 0) : ?>
    <table class="items-table">
        <thead>
            <tr>
                <th width="50"></th>
                <th>Item</th>
                <th width="80">Qtd</th>
                <th width="120"></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($list->items as $item) : ?>
                <tr class="<?= $item->purchased ? 'item-purchased' : '' ?>">
                    <td>
                        <?= $this->Form->postLink(
                            $item->purchased ? '✅' : '⬜',
                            ['controller' => 'Items', 'action' => 'toggle', $item->id],
                            ['escape' => false, 'class' => 'toggle-btn', 'title' => $item->purchased ? 'Desmarcar' : 'Marcar como comprado']
                        ) ?>
                    </td>
                    <td class="<?= $item->purchased ? 'text-risked' : '' ?>">
                        <?= h($item->name) ?>
                    </td>
                    <td>
                        <span class="quantity-badge"><?= h($item->quantity) ?></span>
                    </td>
                    <td class="actions-cell">
                        <?= $this->Html->link('Editar', ['controller' => 'Items', 'action' => 'edit', $item->id], ['class' => 'btn btn-small btn-secondary']) ?>
                        <?= $this->Form->postLink(
                            'Remover',
                            ['controller' => 'Items', 'action' => 'delete', $item->id],
                            ['class' => 'btn btn-small btn-danger', 'confirm' => 'Remover este item?']
                        ) ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php else : ?>
    <div class="empty-state">
        <div class="empty-icon">📝</div>
        <h3>Lista vazia</h3>
        <p>Adicione itens à sua lista de compras.</p>
    </div>
<?php endif; ?>

<div class="add-item-section">
    <h3>+ Adicionar Item</h3>
    <?= $this->Form->create(null, ['url' => ['controller' => 'Items', 'action' => 'add', $list->id]]) ?>
        <div class="form-row">
            <?= $this->Form->control('name', [
                'label' => false,
                'placeholder' => 'Nome do item (ex: Arroz, Leite...)',
                'class' => 'form-input',
                'required' => true
            ]) ?>
            <?= $this->Form->control('quantity', [
                'label' => false,
                'type' => 'number',
                'value' => 1,
                'min' => 1,
                'max' => 99,
                'class' => 'form-input form-input-small'
            ]) ?>
            <?= $this->Form->button('Adicionar', ['class' => 'btn btn-primary']) ?>
        </div>
    <?= $this->Form->end() ?>
</div>

<div class="back-link">
    <?= $this->Html->link('← Voltar para listas', ['action' => 'index']) ?>
</div>
