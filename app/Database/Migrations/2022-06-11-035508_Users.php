<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Users extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'=> [
                'type' =>'INT',
                'constraint' => 5,
                'auto_increment' => true
            ],
            'fullname'=> [
                'type' =>'VARCHAR',
                'constraint' => 50
            ],
            'email'=> [
                'type' =>'VARCHAR',
                'constraint' => 50
            ],
            'phone'=> [
                'type' =>'VARCHAR',
                'constraint' => 13
            ],
            'password'=> [
                'type' =>'VARCHAR',
                'constraint' => 200
            ]
        ]);
        $this->forge->addKey('id',true);
        $this->forge->createTable('users');
    }

    public function down()
    {
        //
    }
}
