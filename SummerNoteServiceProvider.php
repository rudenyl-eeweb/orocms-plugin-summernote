<?php 
namespace Plugins\SummerNote;

use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;

class SummerNoteServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $config = [
            'prefix' => 'summernote',
            'namespace' => 'Plugins\SummerNote'
        ];

        $this->app['router']->group($config, function($router) {
            $router->get('assets.css', [
                'uses' => 'SummerNoteController@getStyles',
                'as' => 'summernote.assets.css',
            ]);

            $router->get('assets.js', [
                'uses' => 'SummerNoteController@getJS',
                'as' => 'summernote.assets.js',
            ]);
        });
    }
}
