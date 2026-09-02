<?php
declare(strict_types=1);

namespace App\View;

use Cake\View\View;

class AppView extends View
{
    public function initialize(): void
    {
        parent::initialize();
    }

    /**
     * Resolve templates (.cake.php primeiro, senão .php) sem disparar exceções internas
     */
    protected function _getTemplateFileName(?string $name = null): string
    {
        $this->_ext = '.cake.php';
        try {
            return parent::_getTemplateFileName($name);
        } catch (\Cake\View\Exception\MissingTemplateException $e) {
            $this->_ext = '.php';
            $file = parent::_getTemplateFileName($name);
            $this->_ext = '.cake.php';
            return $file;
        }
    }

    /**
     * Resolve layouts (.cake.php primeiro, senão .php)
     */
    protected function _getLayoutFileName(?string $name = null): string
    {
        $this->_ext = '.cake.php';
        try {
            return parent::_getLayoutFileName($name);
        } catch (\Cake\View\Exception\MissingLayoutException $e) {
            $this->_ext = '.php';
            $file = parent::_getLayoutFileName($name);
            $this->_ext = '.cake.php';
            return $file;
        }
    }

    /**
     * Deixa os elements e mensagens de Flash sempre com a extensão padrão .php
     * Isso impede qualquer colapso de memória ao exibir alertas na tela
     */
    public function element(string $name, array $data = [], array $options = []): string
    {
        $currentExt = $this->_ext;
        $this->_ext = '.php';
        $content = parent::element($name, $data, $options);
        $this->_ext = $currentExt;

        return $content;
    }
}