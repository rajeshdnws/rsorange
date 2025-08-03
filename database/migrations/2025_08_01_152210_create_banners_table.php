<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBannersTable extends Migration
{
    public function up()
    {
        Schema::create('banners', function (Blueprint $table) {
            $table->id();

            $table->enum('type', ['banner', 'slider'])->default('banner');
            $table->string('slug'); // for grouping sliders or identifying single banner
            $table->string('title')->nullable(); // image-specific title
            $table->text('description')->nullable(); // image-specific description
            $table->string('image')->nullable(); // image filename
            $table->boolean('is_active')->default(true);

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('banners');
    }
}
