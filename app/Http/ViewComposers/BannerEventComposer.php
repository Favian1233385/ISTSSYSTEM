<?php
namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Models\Event;

class BannerEventComposer
{
    public function compose(View $view)
    {
        $bannerEvent = Event::where('status', 'published')
            ->whereNotNull('banner_path')
            ->orderByDesc('date')
            ->first();
        $view->with('bannerEvent', $bannerEvent);
    }
}
