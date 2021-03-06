<?php namespace WebEd\Plugins\Hosts\Http\Middleware;

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
        /**
         * Register to dashboard menu
         */
        dashboard_menu()->registerItem([
            'id' => 'hosts',
            'priority' => 3,
            'parent_id' => null,
            'heading' => trans('hosts::base.hosts'),
            'title' => trans('hosts::base.hosts'),
            'font_icon' => 'icon-puzzle',
            'link' => '',
            'css_class' => null,
            'permissions' => [],
        ]);

        return $next($request);
    }
}
