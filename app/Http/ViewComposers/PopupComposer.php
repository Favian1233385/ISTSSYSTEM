<?php
namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Models\Popup;

class PopupComposer
{
    public function compose(View $view)
    {
        $popup = Popup::where('is_active', true)->orderByDesc('created_at')->first();
        $view->with('popup', $popup);
    }
}
