<?php
namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Models\Popup;

class PopupComposer
{
    public function compose(View $view)
    {
        $today = date('Y-m-d');
        $popup = Popup::where('is_active', true)
            ->where(function($query) use ($today) {
                $query->whereNull('fecha_inicio')->orWhere('fecha_inicio', '<=', $today);
            })
            ->where(function($query) use ($today) {
                $query->whereNull('fecha_fin')->orWhere('fecha_fin', '>=', $today);
            })
            ->orderByDesc('created_at')
            ->first();
        $view->with('popup', $popup);
    }
}
