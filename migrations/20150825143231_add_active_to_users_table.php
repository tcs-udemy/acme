<?php

use Phinx\Migration\AbstractMigration;

class AddActiveToUsersTable extends AbstractMigration
{

    public function change()
    {
        $table = $this->table('users');
        $table->addColumn('active', 'integer', ['default' => '0'])
            ->save();
    }
}
