<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddCatagoryIdToTasks extends Migration
{
    public function up()
    {
        $fields = [
            'category_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => true,
                'after' => 'id' // id sütunundan hemen sonra ekle 
            ]
        ];

        $this->forge->addColumn('tasks', $fields); // task tablosuna category_id kolonunu ekliyoruz
    }

    public function down()
    {
        //
    }
}
