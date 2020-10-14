<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserIdToMailcoachTable extends Migration
{

    protected array $tableNeedAddForeignKeys = [
        'mailcoach_email_lists',
        'mailcoach_templates',
        'mailcoach_campaigns',
    ];

    public function up()
    {
        foreach ($this->tableNeedAddForeignKeys as $tableName) {
            Schema::table($tableName, function (Blueprint $table) {
                $table->foreignId('user_id')->index();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        foreach ($this->tableNeedAddForeignKeys as $tableName) {
            Schema::table($tableName, function (Blueprint $table) {
                $table->dropColumn('user_id');
            });
        }
    }
}
