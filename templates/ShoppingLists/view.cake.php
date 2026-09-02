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
        <h3 class="category-title"><?= h($category) ?></h3>
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
                <?php foreach ($items as $item) : ?>
                    <tr class="<?= $item->purchased ? 'item-purchased' : '' ?>">
                        <td>
                            <?= $this->Form->postLink(
                                $item->purchased ? '✅' : '⬜',
                                ['controller' => 'Items', 'action' => 'toggle', $item->id],
                                [
                                    'class' => 'toggle-btn ajax-toggle',
                                    'data-item-id' => $item->id,
                                    'escape' => false
                                ]
                            ) ?>
                        </td>
                        <td class="item-name-cell <?= $item->purchased ? 'text-risked' : '' ?>">
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
    <?= $this->Form->create(null, ['url' => ['controller' => 'Items', 'action' => 'add', $list->id]]) ?>
        <div class="form-row">
            <?= $this->Form->control('name', [
                'label' => false,
                'placeholder' => 'Nome do item (ex: Arroz, Maçã...)',
                'class' => 'form-input',
                'required' => true
            ]) ?>
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
                'class' => 'form-input'
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