<?php namespace WebEd\Plugins\Features\Providers;

use Illuminate\Support\ServiceProvider;
use Schema;
use Illuminate\Database\Schema\Blueprint;

class InstallModuleServiceProvider extends ServiceProvider
{
    protected $module = 'WebEd\Plugins\Features';

    protected $moduleAlias = 'features';

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
            ->registerPermission('View amenities', 'view-amenities', $this->moduleAlias)
            ->registerPermission('Create amenities', 'create-amenities', $this->moduleAlias)
            ->registerPermission('Update amenities', 'update-amenities', $this->moduleAlias)
            ->registerPermission('Delete amenities', 'delete-amenities', $this->moduleAlias)
            ->registerPermission('View assets', 'view-assets', $this->moduleAlias)
            ->registerPermission('Create assets', 'create-assets', $this->moduleAlias)
            ->registerPermission('Update assets', 'update-assets', $this->moduleAlias)
            ->registerPermission('Delete assets', 'delete-assets', $this->moduleAlias)
            ->registerPermission('View kinds', 'view-kinds', $this->moduleAlias)
            ->registerPermission('Create kinds', 'create-kinds', $this->moduleAlias)
            ->registerPermission('Update kinds', 'update-kinds', $this->moduleAlias)
            ->registerPermission('Delete kinds', 'delete-kinds', $this->moduleAlias);
    }

    protected function createSchema()
    {
        Schema::create('amenities', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name');
            $table->string('label');
            $table->string('slug');
            $table->string('description');
            $table->string('icon');
            $table->enum('types', ['safety', 'normal', 'space', 'bed']);
            $table->integer('created_by')->unsigned()->nullable();
            $table->integer('updated_by')->unsigned()->nullable();
            $table->foreign('created_by')->references('id')->on('users')->onDelete('set null');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('set null');
        });
        Schema::create('kinds', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name');
            $table->string('slug');
            $table->string('icon');
            $table->string('description');
            $table->integer('created_by')->unsigned()->nullable();
            $table->integer('updated_by')->unsigned()->nullable();
            $table->foreign('created_by')->references('id')->on('users')->onDelete('set null');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('set null');
        });
        Schema::create('assets', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name');
            $table->string('slug');
            $table->string('description');
            $table->integer('created_by')->unsigned()->nullable();
            $table->integer('updated_by')->unsigned()->nullable();
            $table->foreign('created_by')->references('id')->on('users')->onDelete('set null');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('set null');
        });
    }
}
