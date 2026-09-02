<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $this->fetch('title') ?></title>
    <?= $this->Html->meta('icon') ?>

    <!-- Carrega o seu style.css de webroot/css/ -->
    <?= $this->Html->css(['style']) ?>

    <!-- OBRIGATÓRIO: Sem o fetch('css'), o CakePHP não imprime as tags <link> na tela -->
    <?= $this->fetch('css') ?>
</head>
<body>
    <header class="header">
        <div class="container">
            <h1 class="logo">
                <?= $this->Html->link(' skyGroceries', '/') ?>
            </h1>
            <nav class="nav">
                <?= $this->Html->link('+ Nova Lista', ['controller' => 'ShoppingLists', 'action' => 'add'], ['class' => 'btn btn-primary']) ?>
            </nav>
        </div>
    </header>

    <main class="main">
        <div class="container">
            <?= $this->Flash->render() ?>
            <?= $this->fetch('content') ?>
        </div>
    </main>

    <footer class="footer">
        <div class="container">
            <p>skyGroceries &mdash; Sua lista de compras sempre à mão</p>
        </div>
    </footer>
</body>
</html>
