<?php
$this->assign('title', 'Minhas Listas — skyGroceries');
?>

<div class="page-header">
    <h2>📋 Minhas Listas de Compras</h2>
    <p><?= count($lists) ?> lista(s) cadastrada(s)</p>
</div>

<?php if ($lists->isEmpty()) : ?>
    <div class="empty-state">
        <div class="empty-icon"></div>
        <h3>Nenhuma lista ainda</h3>
        <p>Crie sua primeira lista de compras e comece a organizar suas idas ao mercado.</p>
        <?= $this->Html->link('+ Criar Primeira Lista', ['action' => 'add'], ['class' => 'btn btn-primary']) ?>
    </div>
<?php else : ?>
    <div class="list-grid">
        <?php foreach ($lists as $list) : ?>
            <a href="<?= $this->Url->build(['action' => 'view', $list->id]) ?>" class="list-card">
                <div class="list-card-header">
                    <h3><?= h($list->name) ?></h3>
                </div>
                <div class="list-card-body">
                    <?php
                        $total = count($list->items);
                        $comprados = count(array_filter($list->items, fn($i) => $i->purchased));
                    ?>
                    <span class="badge">
                        <?= $comprados ?>/<?= $total ?> itens
                    </span>
                    <?php if ($total > 0) : ?>
                        <div class="progress-bar">
                            <div class="progress-fill" style="width: <?= $total > 0 ? round(($comprados / $total) * 100) : 0 ?>%"></div>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="list-card-foter">
                    
                </div>
            </a>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
