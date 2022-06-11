<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Postingan extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'=> [
                'type' =>'INT',
                'constraint' => 5,
                'auto_increment' => true
            ],
            'title'=> [
                'type' =>'VARCHAR',
                'constraint' => 50
            ],
            'description'=> [
                'type' =>'VARCHAR',
                'constraint' => 200
            ],
            'posttypes_id'=> [
                'type' =>'INT',
                'constraint' => 5
            ],
            'users_id'=> [
                'type' =>'INT',
                'constraint' => 5
            ]
        ]);
        $this->forge->addKey('id',true);
        $this->forge->addForeignKey('posttypes_id','posttypes','id');
        $this->forge->addForeignKey('users_id','users','id');
        $this->forge->createTable('postingans');
    }

    public function down()
    {
        $this->forge->dropTable('postingans');
    }
}
