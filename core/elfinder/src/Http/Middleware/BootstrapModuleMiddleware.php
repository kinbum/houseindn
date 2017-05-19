<?php namespace WebEd\Base\Elfinder\Http\Middleware;

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
     * @param  array|string $params
     * @return mixed
     */
    public function handle($request, Closure $next, ...$params)
    {
        /**
         * Register to dashboard menu
         */
        dashboard_menu()->registerItem([
            'id' => 'webed-elfinder',
            'priority' => 999.1,
            'parent_id' => null,
            'heading' => null,
            'title' => trans('webed-elfinder::base.admin_menu.title'),
            'font_icon' => 'icon-doc',
            'link' => route('admin::elfinder.index.get'),
            'css_class' => null,
            'permissions' => ['elfinder-view-files', 'elfinder-upload-files', 'elfinder-edit-files', 'elfinder-delete-files'],
        ]);

        return $next($request);
    }
}
