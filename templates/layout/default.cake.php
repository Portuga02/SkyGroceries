<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $this->fetch('title') ?></title>
    <?= $this->Html->meta('icon') ?>

    <!-- Configurações PWA -->
    <link rel="manifest" href="/manifest.json">
    <meta name="theme-color" content="#5535c8">
    <link rel="apple-touch-icon" href="/img/icon.svg">

    <!-- Carrega o seu style.css de webroot/css/ -->
    <?= $this->Html->css(['style']) ?>

    <!-- OBRIGATÓRIO: Sem o fetch('css'), o CakePHP não imprime as tags <link> na tela -->
    <?= $this->fetch('css') ?>

    <!-- Registra o Service Worker do PWA -->
    <script>
        if ('serviceWorker' in navigator) {
            window.addEventListener('load', () => {
                navigator.serviceWorker.register('/sw.js');
            });
        }
    </script>
</head>
<body>
    <header class="header">
        <div class="container">
            <h1 class="logo">
                <!-- Emojis colocados dentro do helper para serem clicáveis junto com o nome -->
                <?= $this->Html->link('☁️ SkyGroceries 🛒', '/') ?>
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
            <p>SkyGroceries &mdash; Sua lista de compras sempre à mão</p>
        </div>
    </footer>
</body>
</html>