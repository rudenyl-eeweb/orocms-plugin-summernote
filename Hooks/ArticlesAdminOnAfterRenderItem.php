<?php
namespace Plugins\SummerNote\Hooks;

use OroCMS\Admin\Stub;

class ArticlesAdminOnAfterRenderItem
{
    public function handle($view)
    {
        $buffer = (new Stub(__DIR__ . '/../Stubs/admin.markdown.stub', []))->render();
        $view->getFactory()->startSection('header', $buffer);
    }   
}