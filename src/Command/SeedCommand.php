<?php
declare(strict_types=1);

namespace App\Command;

use Cake\Command\Command;
use Cake\Console\Arguments;
use Cake\Console\ConsoleIo;

class SeedCommand extends Command
{
    public function execute(Arguments $args, ConsoleIo $io): ?int
    {
        $io->info('Plantando dados iniciais no banco...');

        $shoppingLists = $this->fetchTable('ShoppingLists');

        // Trava de segurança para não duplicar dados se você rodar 2 vezes
        if ($shoppingLists->find()->count() > 0) {
            $io->warning('A tabela já possui registros. Seeder abortado.');
            return static::CODE_SUCCESS;
        }

        $dados = [
            ['name' => '🛒 Feira do Mês'],
            ['name' => '🥩 Churrasco de Domingo']
        ];

        // O newEntities já ativa o TimestampBehavior automaticamente
        $entidades = $shoppingLists->newEntities($dados);

        foreach ($entidades as $entidade) {
            $shoppingLists->save($entidade);
        }

        $io->success('Banco de dados populado com sucesso!');
        
        return static::CODE_SUCCESS;
    }
}