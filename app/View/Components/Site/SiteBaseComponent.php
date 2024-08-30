<?php

namespace App\View\Components\Site;

use Illuminate\View\Component;

abstract class SiteBaseComponent extends Component
{
    public $viewName = 'default';

    public function render()
    {
    }

    protected function getViewName($directory, $viewName)
    {
        if (empty($viewName)) {
            $viewName = $this->viewName;
        }
        return "site.components.$directory.$viewName";
    }
}
