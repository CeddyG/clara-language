<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTextLangTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'text_lang';

    /**
     * Run the migrations.
     * @table text_lang
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id_text_lang');
            $table->integer('fk_lang');
            $table->integer('fk_traduction');
            $table->string('name_lang', 45)->nullable();

            $table->index(["fk_traduction"], 'fk_text_lang_lang1_idx');

            $table->index(["fk_lang"], 'fk_text_lang_lang_idx');


            $table->foreign('fk_lang', 'fk_text_lang_lang_idx')
                ->references('id_lang')->on('lang')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('fk_traduction', 'fk_text_lang_lang1_idx')
                ->references('id_lang')->on('lang')
                ->onDelete('no action')
                ->onUpdate('no action');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
     public function down()
     {
       Schema::dropIfExists($this->set_schema_table);
     }
}
