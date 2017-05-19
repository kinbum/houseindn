<?php namespace WebEd\Plugins\Hosts\Providers;

use Illuminate\Support\ServiceProvider;
use Schema;
use Illuminate\Database\Schema\Blueprint;

class InstallModuleServiceProvider extends ServiceProvider
{
    protected $module = 'WebEd\Plugins\Hosts';

    protected $moduleAlias = 'hosts';

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        app()->booted(function () {
            $this->booted();
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {

    }

    protected function booted()
    {
        $this->createSchema();

        acl_permission()
            ->registerPermission('View hosts', 'view-hosts', $this->moduleAlias)
            ->registerPermission('Create hosts', 'create-hosts', $this->moduleAlias)
            ->registerPermission('Update hosts', 'update-hosts', $this->moduleAlias)
            ->registerPermission('Delete hosts', 'delete-hosts', $this->moduleAlias);
    }

    protected function createSchema()
    {
        Schema::create('hosts', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');

            $table->string('title')->nullable()->default(null);
            $table->string('slug')->nullable()->default(null);
            $table->text('description')->nullable()->default(null);
            $table->text('content')->nullable()->default(null);

            $table->integer('kind_id')->unsigned();
            $table->foreign('kind_id')
                ->references('id')
                ->on('kinds')
                ->onDelete('set null');

            $table->integer('created_by')->unsigned();
            $table->foreign('created_by')
                ->references('id')
                ->on('users')
                ->onDelete('set null');

            $table->integer('asset_id')->unsigned()->nullable();
            $table->foreign('asset_id')
                ->references('id')
                ->on('assets')
                ->onDelete('set null');
            
            $table->string('space_special')->nullable()->default(null);

            $table->smallInteger('bedroom_count')->nullable();;
            $table->smallInteger('count_bed')->default(0);
            $table->smallInteger('count_guest')->default(0);
            $table->smallInteger('bathroom_count')->default(0);

            $table->enum('status', ['activated', 'disabled'])->default('activated');
            $table->boolean('publish')->default(0);
            $table->boolean('slideshow')->default(0);
            $table->timestamps();
        });

        // Host setting generate
        Schema::create('host_settings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('host_id')->unsigned();
            $table->foreign('host_id')
                ->references('id')
                ->on('hosts')
                ->onDelete('set null');

            $table->text('calendar')->nullable()->default(null);
            $table->unsignedTinyInteger('min_trip_length')->nullable()->default(0);
            $table->unsignedTinyInteger('max_trip_length')->nullable()->default(0);
            $table->float('base_price')->nullable()->default(null);
            $table->char('currency')->nullable()->default('vn');
            $table->text('rules')->nullable()->default(null);
        });

        // Place of host
        Schema::create('place_host', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            
            $table->integer('host_id')->unsigned();

            $table->foreign('host_id')
                ->references('id')
                ->on('hosts')
                ->onDelete('set null');
            
            $table->string('street_number');
            $table->string('route');
            $table->string('street');
            $table->string('city');
            $table->string('locality');
            $table->string('state');
            $table->string('country');
            $table->string('latitude', 50);
            $table->string('longitude', 50);
            $table->string('zipcode', 50)->nullable();
        });

        // Image of host
        Schema::create('host_photos', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('host_id')->unsigned();
            $table->foreign('host_id')
                ->references('id')
                ->on('host')
                ->onDelete('set null');
            
            $table->string('name')->nullable()->default(null);
            $table->string('caption')->nullable()->default(null);
            $table->boolean('cover')->default(0);
        });

        // Location around of host
        Schema::create('locations_arounds', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('host_id')->unsigned();
            $table->foreign('host_id')
                ->references('id')
                ->on('host')
                ->onDelete('set null');
            
            $table->string('location_name');
            $table->string('street_number');
            $table->string('route')->nullable()->default(null);
            $table->string('street')->nullable()->default(null);
            $table->string('city')->nullable()->default(null);
            $table->string('locality')->nullable()->default(null);
            $table->string('state')->nullable()->default(null);
            $table->string('country')->nullable()->default(null);
            $table->string('latitude', 50)->nullable()->default(null);
            $table->string('longitude', 50)->nullable()->default(null);
            $table->string('zipcode', 50)->nullable()->default(null);
            $table->string('marker_icon')->nullable()->default(null);
        });

        // Host processes
        Schema::create('processes', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('host_id')->unsigned();
            $table->foreign('host_id')
                ->references('id')
                ->on('host')
                ->onDelete('set null');

            $table->integer('created_by')->unsigned();
            $table->foreign('created_by')
                ->references('id')
                ->on('users')
                ->onDelete('set null');

            $table->string('step_one')->nullable();
            $table->string('step_two')->nullable();
            $table->string('step_three')->nullable();
            $table->string('completed')->nullable();
        });

        // Relationship amenities with host
        Schema::create('amenities_host', function (Blueprint $table) {
            $table->integer('amenities_id')->unsigned();

            $table->foreign('amenities_id')
                ->references('id')
                ->on('amenities')
                ->onDelete('set null');

            $table->integer('host_id')->unsigned();
            $table->foreign('host_id')
                ->references('id')
                ->on('host')
                ->onDelete('set null');
        });
    }
}
