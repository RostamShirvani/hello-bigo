<?php

namespace App\Repositories\Site;

use App\Models\Page\Page;

class PageRepository extends BaseSiteRepository
{
    public function getPage($slug)
    {
        return Page::query()
            ->where('slug', $slug)
            ->select([
                'id',
                'title',
                'body',
            ])
            ->enabled()
            ->published()
            ->firstOrFail();
    }
}
