<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\HeroSlide;

class HeroSlideTest extends TestCase
{
    /** @test */
    public function it_checks_active_hero_slides()
    {
        $activeSlides = HeroSlide::active()->get();

        foreach ($activeSlides as $slide) {
            echo "Title: {$slide->title}, Image Path: {$slide->image_path}\n";
        }

        $this->assertNotEmpty($activeSlides, 'No active slides found.');
    }
}
