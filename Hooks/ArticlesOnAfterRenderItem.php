<?php
namespace Plugins\SummerNote\Hooks;

use OroCMS\Admin\Stub;

class ArticlesOnAfterRenderItem
{
    public function handle($view)
    {
        $buffer = (new Stub(__DIR__ . '/../Stubs/summernote.stub', []))->render();
        $view->snippets[] = $buffer;
    }   
}
