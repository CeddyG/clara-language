<?php

namespace CeddyG\ClaraLanguage;

use Illuminate\Support\ServiceProvider;

use CeddyG\ClaraLanguage\Repositories\LangRepository;

/**
 * Description of ClaraLanguageServiceProvider
 *
 * @author Ceddyg
 */
class ClaraLanguageServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;
	
	/**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
		$this->publishesConfig();
		$this->publishesMigrations();
		$this->publishesTranslations();
    }
	
	/**
	 * Publish config file.
	 * 
	 * @return void
	 */
	private function publishesConfig()
	{
		$sConfigPath = __DIR__ . '/../config/clara-lang.php';
        if (function_exists('config_path')) 
		{
            $sPublishPath = config_path('clara-lang.php');
        } 
		else 
		{
            $sPublishPath = base_path('config/clara-lang.php');
        }
		
        $this->publishes([$sConfigPath => $sPublishPath], 'clara-lang.config');
	}
	
	private function publishesMigrations()
	{
		$sMigrationsPath	= __DIR__ . '/../database/migrations';
        $sPublishPath		= $this->app->databasePath().'/migrations';
		
        $this->publishes([$sMigrationsPath => $sPublishPath], 'clara-lang.migrations');
	}
	
	private function publishesTranslations()
	{
		$sTransPath = __DIR__.'/../resources/lang';
		$this->loadTranslationsFrom($sTransPath, 'clara-lang');

		$this->publishes([
			$sTransPath => resource_path('lang/vendor/clara-lang'),
			'clara-lang.trans'
		]);
	}

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('clara-lang', function ($app) 
		{
            return new LangRepository();
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['clara-lang'];
    }
}
