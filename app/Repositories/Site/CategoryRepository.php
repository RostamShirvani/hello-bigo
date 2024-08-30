<?php

namespace App\Repositories\Site;

use App\Models\Category\Category;
use App\Models\Service\Service;

class CategoryRepository extends BaseSiteRepository
{
    public function getCategory($categoryId)
    {
        return Category::query()
            ->where('id', $categoryId)
            ->select([
                'id',
                'title',
            ])
            ->enabled()
            ->firstOrFail();
    }

    public function getServices($categoryId)
    {
        return Service::query()
            ->where('category_id', $categoryId)
            ->whereNull(['parent_id'])
            ->enabled()
            ->with([
                'children' => function ($query) {
                    $query->select(['id', 'title', 'parent_id']);
                    $query->enabled();
                }
            ])
            ->select([
                'id',
                'title',
                'featured_image',
            ])
            ->get();
    }
}
