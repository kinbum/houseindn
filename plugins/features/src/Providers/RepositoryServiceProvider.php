<?php namespace WebEd\Plugins\Features\Providers;

use Illuminate\Support\ServiceProvider;
use WebEd\Plugins\Features\Repositories\Contracts\AmenitiesRepositoryContract;
use WebEd\Plugins\Features\Repositories\AmenitiesRepository;
use WebEd\Plugins\Features\Repositories\AmenitiesRepositoryCacheDecorator;
use WebEd\Plugins\Features\Models\Amenities;
use WebEd\Plugins\Features\Repositories\Contracts\AssetRepositoryContract;
use WebEd\Plugins\Features\Repositories\AssetRepository;
use WebEd\Plugins\Features\Repositories\AssetRepositoryCacheDecorator;
use WebEd\Plugins\Features\Models\Asset;
use WebEd\Plugins\Features\Repositories\Contracts\KindRepositoryContract;
use WebEd\Plugins\Features\Repositories\KindRepository;
use WebEd\Plugins\Features\Repositories\KindRepositoryCacheDecorator;
use WebEd\Plugins\Features\Models\Kind;

class RepositoryServiceProvider extends ServiceProvider
{
    protected $module = 'WebEd\Plugins\Features';

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        // Bind amenities
        $this->app->bind(AmenitiesRepositoryContract::class, function() {
            $repository = new AmenitiesRepository(new Amenities());

            if(config('webed-caching.repository.enabled')) {
                return new AmenitiesRepositoryCacheDecorator($repository);
            }

            return $repository;
        });
        
        // Bind assets
        $this->app->bind(AssetRepositoryContract::class, function () {
            $repository = new AssetRepository(new Asset());
            
            if(config('webed-caching.repository.enable'))
                return new AssetRepositoryCacheDecorator($repository);

            return $repository;
        });
        
        // Bind Kind
        $this->app->bind(KindRepositoryContract::class, function() {
            $repository = new KindRepository(new Kind());

            if(config('webed-caching.repository.enable'))
                return KindRepositoryCacheDecorator($repository);
                
            return $repository;
        });
    }
}
