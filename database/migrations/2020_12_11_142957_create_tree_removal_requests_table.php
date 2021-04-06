<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTreeRemovalRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tree_removal_requests', function (Blueprint $table) {
            $table->id();
            $table->integer('created_by_user_id');
            $table->string('description');
            $table->json('images');
            $table->double('land_size', 12,4);
            $table->integer('no_of_trees');
            $table->integer('no_of_tree_species');
            $table->integer('no_of_mammal_species');
            $table->integer('no_of_amphibian_species');
            $table->integer('no_of_reptile_species');
            $table->integer('no_of_avian_species');
            $table->text('species_special_notes');
            $table->integer('no_of_flora_species');
            $table->json('tree_details');
            $table->timestampsTz(); //time stamp with timezone in UTC
            $table->softDeletesTz('deleted_at', 0);

            $table->unsignedBigInteger('organization_id')->nullable(); 
            $table->foreign('organization_id')->references('id')->on('organizations')->onDelete('cascade');   

            $table->unsignedBigInteger('land_parcel_id')->nullable();  
            $table->foreign('land_parcel_id')->references('id')->on('land_parcels')->onDelete('cascade');   

            $table->unsignedBigInteger('status_id')->nullable();
            $table->foreign('status_id')->references('id')->on('status')->onDelete('cascade');

            $table->unsignedBigInteger('district_id')->nullable();
            $table->foreign('district_id')->references('id')->on('districts')->onDelete('cascade');

            $table->unsignedBigInteger('gs_division_id')->nullable();
            $table->foreign('gs_division_id')->references('id')->on('gs_divisions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tree_removal_requests');
    }
}
