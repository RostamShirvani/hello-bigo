<?php

namespace App\Repositories\Site;

class HomeRepository extends BaseSiteRepository
{
    public function getSlides()
    {
        $files = [
            '/uploads/sliders/main/slide (3).jpg',
            '/uploads/sliders/main/slide (5).jpg',
            '/uploads/sliders/main/slide (2).jpg',
            '/uploads/sliders/main/slide (4).jpg',
            '/uploads/sliders/main/slide (6).jpg',
        ];
        return $files;
    }
}
