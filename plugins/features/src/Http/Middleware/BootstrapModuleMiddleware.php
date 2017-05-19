<?php namespace WebEd\Plugins\Features\Http\Middleware;

use \Closure;

class BootstrapModuleMiddleware
{
    public function __construct()
    {

    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        admin_bar()->registerLink(trans('features::base.amenities'), route('amenities.create.get'), 'add-new');

        /**
         * Register to dashboard menu
         */
        dashboard_menu()->registerItem([
            'id' => 'features',
            'priority' => 2,
            'parent_id' => null,
            'heading' => trans('features::base.features'),
            'title' => trans('features::base.amenities'),
            'font_icon' => 'icon-list',
            'link' => route('amenities.index.get'),
            'css_class' => null,
            'permissions' => ['view-amenites'],
        ])->registerItem([
            'id' => 'features-assets',
            'priority' => 2.1,
            'parent_id' => null,
            'title' => trans('features::base.assets'),
            'font_icon' => 'icon-bulb',
            'link' => route('assets.create.get'),
            'css_class' => null,
            'permissions' => ['view-assets'],
        ])->registerItem([
            'id' => 'features-kinds',
            'priority' => 2.2,
            'parent_id' => null,
            'title' => trans('features::base.kind'),
            'font_icon' => 'icon-energy',
            'link' => route('kinds.index.get'),
            'css_class' => null,
            'permissions' => ['view-kinds'],
        ]);

        return $next($request);
    }
}
