<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('fileuploads', function (Blueprint $table) {
            $table->text('contents')->nullable();
            $table->string('contents_filename')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('fileuploads', function (Blueprint $table) {
            $table->dropColumn('contents');
            $table->dropColumn('contents_filename');
            //
        });
    }
};
