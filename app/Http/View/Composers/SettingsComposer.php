<?php

namespace App\Http\View\Composers;

use App\Models\Setting;
use Illuminate\View\View;

class SettingsComposer
{
    /**
     * Bind data to the view.
     *
     * @param  \Illuminate\View\View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $settings = Setting::all()->pluck('value', 'key');
        $view->with('settings', $settings);
    }
}
