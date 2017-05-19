<?php namespace WebEd\Base\Elfinder\Providers;

use Illuminate\Support\ServiceProvider;

class InstallModuleServiceProvider extends ServiceProvider
{
    protected $module = 'webed-elfinder';

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
            ->registerPermission('View files', 'elfinder-view-files', $this->module)
            ->registerPermission('Upload files', 'elfinder-upload-files', $this->module)
            ->registerPermission('Edit files', 'elfinder-edit-files', $this->module)
            ->registerPermission('Delete files', 'elfinder-delete-files', $this->module);
    }
}
