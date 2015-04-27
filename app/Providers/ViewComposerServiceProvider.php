<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Articles;

class ViewComposerServiceProvider extends ServiceProvider {

	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot()
	{
        $this->composeNavigation();
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

    /**
     * Compose the main template
     */
    private function composeNavigation()
    {
        view()->composer('app', function($view) {
            $view->with('latest', Articles::latest()->first());
        });
    }

}
