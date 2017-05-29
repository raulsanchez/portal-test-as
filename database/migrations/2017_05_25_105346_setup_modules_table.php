<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SetupModulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('modules', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parent_id')->default('0')->nullable()->comment('Relacion con un menu superior');
            $table->integer('order')->nullable()->comment('Si tiene algun orden en especifico');
            $table->string('name', 30)->comment('Nombre de enlace o menu');
            $table->text('link')->comment('Se especifica el link');
            $table->string('icon', 30)->nullable()->comment('Icono que se mostrará con el menu');
            $table->enum('visualize', ['si', 'no'])->comment('Si se visualiza el enlace o menu');
            $table->enum('status', ['activo', 'inactivo'])->comment('Si se encuentra activado o desactivado');
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::create('module_role', function (Blueprint $table) {
            $table->integer('module_id')->unsigned();
            $table->integer('role_id')->unsigned();

            $table->foreign('module_id')->references('id')->on('modules')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('role_id')->references('id')->on('roles')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->primary(['module_id', 'role_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('modules');
        Schema::dropIfExists('module_role');
    }
}
