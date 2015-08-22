<?php

use Phinx\Migration\AbstractMigration;

class SeedTestimonialTable extends AbstractMigration
{
    public function up()
    {
        $this->execute("
            insert into testimonials (title, testimonial, user_id)
            values
            ('Testimonial Title', 'Testimonial text', 1)
        ");
    }

    public function down()
    {

    }
}
