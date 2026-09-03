<?php

declare(strict_types=1);

use Migrations\BaseMigration;

class InicialSchema extends BaseMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/migrations/5/guides/writing-migrations/migration-methods.html#the-change-method
     *
     * @return void
     */
    public function change(): void
    {
        // 1. Cria a tabela de Listas de Compras
        $table = $this->table('shopping_lists');
        $table->addColumn('name', 'string', ['limit' => 255, 'null' => false])
              ->addColumn('created', 'datetime', ['null' => true])
              ->addColumn('modified', 'datetime', ['null' => true])
              ->create();

        // 2. Cria a tabela de Itens
        $table = $this->table('items');
        $table->addColumn('shopping_list_id', 'integer', ['null' => false])
              ->addColumn('name', 'string', ['limit' => 255, 'null' => false])
              ->addColumn('category', 'string', ['limit' => 100, 'null' => true])
              ->addColumn('price', 'decimal', ['precision' => 10, 'scale' => 2, 'null' => true])
              ->addColumn('is_purchased', 'boolean', ['default' => false, 'null' => false])
              ->addColumn('created', 'datetime', ['null' => true])
              ->addColumn('modified', 'datetime', ['null' => true])
              ->addForeignKey('shopping_list_id', 'shopping_lists', 'id', ['delete' => 'CASCADE', 'update' => 'CASCADE'])
              ->create();
    }
}
