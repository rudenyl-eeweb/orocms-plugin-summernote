<?php
namespace Plugins\SummerNote\Hooks;

use OroCMS\Admin\Stub;

class ArticlesAdminOnAfterRenderItem
{
    public function handle($view)
    {
        $buffer = (new Stub(__DIR__ . '/../Stubs/admin.summernote.stub', []))->render();
        $view->getFactory()->startPush('header', $buffer);
    }   
}
