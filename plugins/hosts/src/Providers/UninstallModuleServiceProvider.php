<?php namespace WebEd\Plugins\Hosts\Providers;

use Illuminate\Support\ServiceProvider;

class UninstallModuleServiceProvider extends ServiceProvider
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
        acl_permission()
        ->unsetPermissionByModule($this->moduleAlias);

        $this->dropSchema();
    }

    protected function dropSchema()
    {
        \Schema::dropIfExists('amenities_host');
        \Schema::dropIfExists('processes');
        \Schema::dropIfExists('locations_arounds');
        \Schema::dropIfExists('host_photos');
        \Schema::dropIfExists('place_host');
        \Schema::dropIfExists('host_settings');
        \Schema::dropIfExists('hosts');
    }
}
