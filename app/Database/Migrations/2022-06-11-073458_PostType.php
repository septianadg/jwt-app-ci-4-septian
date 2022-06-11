<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class PostType extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'=> [
                'type' =>'INT',
                'constraint' => 5,
                'auto_increment' => true
            ],
            'jenis'=> [
                'type' =>'VARCHAR',
                'constraint' => 50
            ],
            'type'=> [
                'type' =>'VARCHAR',
                'constraint' => 50
            ]
        ]);
        $this->forge->addKey('id',true);
        $this->forge->createTable('posttypes');
    }

    public function down()
    {
        //
    }
}
