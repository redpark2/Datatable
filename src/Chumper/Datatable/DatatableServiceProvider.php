<?php namespace Chumper\Datatable;

use Illuminate\Support\ServiceProvider;
use View;

class DatatableServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

    // public function boot()
    // {
    //     $this->package('chumper/datatable');
    // }
    public function boot()
    {
        $viewPath = __DIR__.'/../../views/';
        $this->loadViewsFrom($viewPath, 'Chumper');
        //$this->package('chumper/datatable');
        $this->publishes([
             $viewPath => base_path('resources/views/vendor/Chumper'),
        ]);
    }

    /**
	 * Register the service provider.
	 *
	 * @return void
	 */
    // public function register()
    // {
    //     $this->app['datatable'] = $this->app->share(function($app)
    //     {
    //         return new Datatable;
    //     });
    // }
    public function register()
    {
      
        $configPath = __DIR__.'/../../config/config.php';
        $this->publishes([$configPath => config_path('chumper_datatable.php'),]);
        $this->mergeConfigFrom($configPath, 'chumper_datatable');

        $this->app['datatable'] = $this->app->share(function($app)
        {
            return new Datatable;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array('datatable');
    }

}