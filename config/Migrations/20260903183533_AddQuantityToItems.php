<?php
declare(strict_types=1);

use Migrations\BaseMigration;

class AddQuantityToItems extends BaseMigration
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
        $table = $this->table('items');
        
        if (!$table->hasColumn('quantity')) {
            $table->addColumn('quantity', 'integer', [
                'default' => 1,
                'null' => false,
            ]);
            $table->update();
        }
    }
}
