<?php

use Phinx\Migration\AbstractMigration;

class SeedPagesTable extends AbstractMigration
{
    public function up()
    {
        $this->execute("
            insert into pages (browser_title, page_content)
            values
            ('About Acme', 'About text')
        ");
    }

    public function down()
    {

    }
}
