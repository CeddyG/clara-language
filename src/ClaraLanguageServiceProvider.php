<?php

namespace CeddyG\ClaraLanguage;

use Illuminate\Support\ServiceProvider;

/**
 * Description of ClaraLanguageServiceProvider
 *
 * @author Ceddyg
 */
class ClaraLanguageServiceProvider extends ServiceProvider
{
	/**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
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
		
        $this->publishes([$sConfigPath => $sPublishPath], 'clara-lang');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
