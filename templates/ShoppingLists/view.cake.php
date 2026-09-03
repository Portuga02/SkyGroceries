<?php
$this->assign('title', h($list->name) . ' — SkyGroceries');
?>

<div class="page-header">
    <div class="page-header-row">
        <h2><?= h($list->name) ?></h2>
        <div class="page-header-actions">
            <?= $this->Html->link('Editar Lista', ['action' => 'edit', $list->id], ['class' => 'btn btn-secondary']) ?>
            <?= $this->Form->postLink(
                'Excluir Lista',
                ['action' => 'delete', $list->id],
                ['class' => 'btn btn-danger', 'confirm' => 'Tem certeza que deseja excluir esta lista e todos os itens?']
            ) ?>
        </div>
    </div>
    <p><span id="purchased-count"><?= $purchasedCount ?></span> de <span id="total-count"><?= $totalCount ?></span> itens comprados</p>

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

<?php if (!empty($groupedItems)) : ?>
    <?php foreach ($groupedItems as $category => $items) : ?>
        <h3 class="category-title" style="margin-top: 25px; margin-bottom: 10px;"><?= h($category) ?></h3>
        <table class="items-table">
            <thead>
                <tr>
                    <th width="40">#</th>
                    <th width="50"></th>
                    <th>Item</th>
                    <th width="100">Qtd</th>
                    <th width="140" style="text-align: right;">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php $counter = 1; foreach ($items as $item) : ?>
                    <tr class="<?= $item->is_purchased ? 'item-purchased' : '' ?>">
                        <td>
                            <span style="color: gray; font-size: 13px; font-weight: bold;"><?= $counter++ ?></span>
                        </td>
                        <td>
                            <?= $this->Form->postLink(
                                $item->is_purchased ? '✅' : '⬜',
                                ['controller' => 'Items', 'action' => 'toggle', $item->id],
                                [
                                    'class' => 'toggle-btn ajax-toggle',
                                    'data-item-id' => $item->id,
                                    'escape' => false,
                                    'style' => 'text-decoration: none; font-size: 18px;'
                                ]
                            ) ?>
                        </td>
                        <td class="item-name-cell <?= $item->is_purchased ? 'text-risked' : '' ?>">
                            <strong><?= h($item->name) ?></strong>
                            <?php if (!empty($item->price) && $item->price > 0): ?>
                                <small style="display: block; color: var(--primary-color, #6b46c1); font-weight: 600;">
                                    R$ <?= number_format((float)$item->price, 2, ',', '.') ?>
                                </small>
                            <?php endif; ?>
                        </td>
                        <td>
                            <!-- Garante que se vier nulo ou zero, mostra pelo menos 1 -->
                            <span class="quantity-badge" style="display: inline-block; padding: 3px 8px; border-radius: 12px; background: #e2e8f0; font-weight: bold; font-size: 13px; color: #333;">
                                <?= (int)($item->quantity ?: 1) ?> un
                            </span>
                        </td>
                        <td class="actions-cell" style="text-align: right;">
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
    <?php endforeach; ?>
<?php else : ?>
    <div class="empty-state">
        <div class="empty-icon">📝</div>
        <h3>Lista vazia</h3>
        <p>Adicione itens à sua lista de compras.</p>
    </div>
<?php endif; ?>

<div class="add-item-section">
    <h3>+ Adicionar Item</h3>
    <?= $this->Form->create(null, [
        'url' => ['controller' => 'Items', 'action' => 'add', $list->id]
    ]) ?>
        <div class="form-row" style="display: flex; gap: 10px; align-items: center; flex-wrap: nowrap;">
            <div style="flex: 3; min-width: 180px;">
                <?= $this->Form->control('name', [
                    'label' => false,
                    'placeholder' => 'Nome do item (ex: Arroz, Maçã...)',
                    'class' => 'form-input',
                    'required' => true,
                    'templates' => ['inputContainer' => '{{content}}'],
                    'style' => 'width: 100%; height: 40px; margin: 0; padding: 0 12px; box-sizing: border-box; line-height: 40px;'
                ]) ?>
            </div>

            <div style="flex: 2; min-width: 140px;">
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
                    'templates' => ['inputContainer' => '{{content}}'],
                    'style' => 'width: 100%; height: 40px; margin: 0; padding: 0 10px; box-sizing: border-box;'
                ]) ?>
            </div>

            <div style="width: 70px; flex-shrink: 0;">
                <?= $this->Form->control('quantity', [
                    'label' => false,
                    'type' => 'number',
                    'value' => 1,
                    'min' => 1,
                    'max' => 99,
                    'class' => 'form-input form-input-small',
                    'templates' => ['inputContainer' => '{{content}}'],
                    'style' => 'width: 100%; height: 40px; margin: 0; text-align: center; padding: 0 8px; box-sizing: border-box;'
                ]) ?>
            </div>

            <div style="flex-shrink: 0;">
                <?= $this->Form->button('Adicionar', [
                    'class' => 'btn btn-primary',
                    'style' => 'height: 40px; margin: 0; padding: 0 18px; display: inline-flex; align-items: center; justify-content: center; box-sizing: border-box; white-space: nowrap;'
                ]) ?>
            </div>
        </div>
    <?= $this->Form->end() ?>
</div>
<div class="back-link">
    <?= $this->Html->link('← Voltar para listas', ['action' => 'index']) ?>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.ajax-toggle').forEach(btn => {
        btn.addEventListener('click', async (e) => {
            e.preventDefault();

            let form = null;
            const formName = btn.getAttribute('data-confirm-form');
            if (formName) {
                form = document.querySelector(`form[name="${formName}"]`);
            }
            if (!form) {
                form = btn.closest('form') || btn.nextElementSibling;
                while (form && form.tagName !== 'FORM') {
                    form = form.nextElementSibling;
                }
            }

            const url = form ? form.action : btn.getAttribute('href');
            let token = '';
            if (form) {
                const tokenInput = form.querySelector('input[name="_csrfToken"]');
                if (tokenInput) token = tokenInput.value;
            }

            try {
                const response = await fetch(url, {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-Token': token
                    }
                });

                if (response.ok) {
                    const data = await response.json();

                    btn.textContent = data.purchased ? '✅' : '⬜';

                    const row = btn.closest('tr');
                    if (row) {
                        row.classList.toggle('item-purchased', data.purchased);
                        const nameCell = row.querySelector('.item-name-cell');
                        if (nameCell) {
                            nameCell.classList.toggle('text-risked', data.purchased);
                        }
                    }

                    const purchasedEl = document.getElementById('purchased-count');
                    const totalEl = document.getElementById('total-count');
                    if (purchasedEl) purchasedEl.textContent = data.bought;
                    if (totalEl) totalEl.textContent = data.total;

                    const fill = document.querySelector('.progress-fill');
                    if (fill) {
                        fill.style.width = `${data.percent}%`;
                        fill.textContent = data.percent > 0 ? `${data.percent}%` : '';
                    }
                }
            } catch (err) {
                console.error('Erro ao alternar o item:', err);
            }
        });
    });
});
</script>