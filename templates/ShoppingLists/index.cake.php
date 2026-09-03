<?php
$this->assign('title', 'Minhas Listas — SkyGroceries');
?>

<div class="page-header">
    <div class="page-header-row">
        <div>
            <h2>📋 Minhas Listas de Compras</h2>
            <p><?= !empty($shoppingLists) ? count($shoppingLists) : 0 ?> lista(s) cadastrada(s)</p>
        </div>
      
    </div>
</div>

<?php if (empty($shoppingLists) || count($shoppingLists) === 0) : ?>
    <div class="empty-state">
        <div class="empty-icon">📝</div>
        <h3>Nenhuma lista ainda</h3>
        <p>Crie sua primeira lista de compras e comece a organizar suas idas ao mercado.</p>
        <?= $this->Html->link('Criar Lista', ['action' => 'add'], ['class' => 'btn btn-primary']) ?>
    </div>
<?php else : ?>
    <div class="list-grid">
        <?php foreach ($shoppingLists as $list) : ?>
            <a href="<?= $this->Url->build(['action' => 'view', $list->id]) ?>" class="list-card">
                <div class="list-card-header">
                    <!-- O ícone foi adicionado nesta linha abaixo -->
                    <h3><span style="margin-right: 8px;"><?= h($list->icon) ?></span> <?= h($list->name) ?></h3>
                    <span class="chevron">→</span>
                </div>
                <div class="list-card-footer">
                    <span class="badge">Criada em <?= h($list->created?->format('d/m/Y') ?? 'Recente') ?></span>
                </div>
            </a>
        <?php endforeach; ?>
    </div>
<?php endif; ?>