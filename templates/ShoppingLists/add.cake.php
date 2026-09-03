<?= $this->Form->create($shoppingList) ?>
<fieldset>
    <legend><?= __('Nova Lista de Compras') ?></legend>
    <?php
    echo $this->Form->control('name', ['label' => 'Nome da Lista']);

    $currentIconValue = isset($shoppingList->icon) ? $shoppingList->icon : '🛒';
    echo '<input type="hidden" name="icon" id="selected-icon-input" value="' . $currentIconValue . '">';
?>

    <!-- Seletor visual de emojis -->
    <div class="input text" style="margin-top: 15px;">
        <label>Escolha um Ícone:</label>
        <div class="emoji-selector" style="display: flex; gap: 10px; font-size: 24px; margin-top: 5px; cursor: pointer;">
            <span class="emoji-option" data-icon="🛒" onclick="selectEmoji(this)">🛒</span>
            <span class="emoji-option" data-icon="🥩" onclick="selectEmoji(this)">🥩</span>
            <span class="emoji-option" data-icon="💊" onclick="selectEmoji(this)">💊</span>
            <span class="emoji-option" data-icon="🍎" onclick="selectEmoji(this)">🍎</span>
            <span class="emoji-option" data-icon="🍺" onclick="selectEmoji(this)">🍺</span>
            <span class="emoji-option" data-icon="🧹" onclick="selectEmoji(this)">🧹</span>
            <span class="emoji-option" data-icon="📋" onclick="selectEmoji(this)">📋</span>
        </div>
    </div>
</fieldset>

<?= $this->Form->button(__('Salvar Lista'), ['class' => 'btn btn-primary', 'style' => 'margin-top: 20px;']) ?>
<?= $this->Form->end() ?>

<script>
function selectEmoji(element) {
    document.querySelectorAll('.emoji-option').forEach(el => {
        el.style.border = 'none';
        el.style.padding = '0';
    });
    element.style.border = '2px solid #5535c8';
    element.style.borderRadius = '5px';
    element.style.padding = '2px';
    document.getElementById('selected-icon-input').value = element.getAttribute('data-icon');
}
// Seleciona o primeiro por padrão ao carregar
document.querySelector('.emoji-option').click();
</script>