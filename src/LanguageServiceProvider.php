<?php

namespace CeddyG\ClaraLanguage;

use Illuminate\Support\ServiceProvider;

/**
 * Description of ClaraLanguageServiceProvider
 *
 * @author Ceddyg
 */
class LanguageServiceProvider extends ServiceProvider
{	
	/**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
		$this->publishesConfig();
		$this->publishesTranslations();
        $this->loadRoutesFrom(__DIR__.'/routes.php');
		$this->publishesView();
    }
	
	/**
	 * Publish config file.
	 * 
	 * @return void
	 */
	private function publishesConfig()
	{
		$sConfigPath = __DIR__ . '/../config/clara.lang.php';
        if (function_exists('config_path')) 
		{
            $sPublishPath = config_path('clara.lang.php');
        } 
		else 
		{
            $sPublishPath = base_path('config/clara.lang.php');
        }
		
        $this->publishes([$sConfigPath => $sPublishPath], 'clara.lang.config');
	}
	
	private function publishesTranslations()
	{
		$sTransPath = __DIR__.'/../resources/lang';
		$this->loadTranslationsFrom($sTransPath, 'clara-lang');

		$this->publishes([
			$sTransPath => resource_path('lang/vendor/clara-lang'),
			'clara.lang.trans'
		]);
	}

	private function publishesView()
	{
        $sResources = __DIR__.'/../resources/views';

        $this->publishes([
            $sResources => resource_path('views/vendor/clara-lang'),
        ], 'clara.lang.views');
        
        $this->loadViewsFrom($sResources, 'clara-lang');
	}

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('clara.lang', function ($app) 
		{
            return new ClaraLang();
        });
    }
}
