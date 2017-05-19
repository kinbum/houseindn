<?php namespace WebEd\Plugins\Features\Providers;

use Illuminate\Support\ServiceProvider;

class UninstallModuleServiceProvider extends ServiceProvider
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
        acl_permission()
        ->unsetPermissionByModule($this->moduleAlias);

        $this->dropSchema();
    }

    protected function dropSchema()
    {
        \Schema::dropIfExists('amenities');
        \Schema::dropIfExists('kinds');
        \Schema::dropIfExists('assets');
    }
}
