<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ChatbotSetting;

class ChatbotSettingController extends Controller
{
    public function edit()
    {
        $setting = ChatbotSetting::first() ?? new ChatbotSetting();
        return view('admin.chatbot_settings.edit', compact('setting'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'fallback_message' => 'required|string',
            'contact_phone' => 'nullable|string',
            'contact_email' => 'nullable|email',
            'contact_hours' => 'nullable|string',
            'welcome_message' => 'nullable|string',
        ]);
        $setting = ChatbotSetting::first();
        if (!$setting) {
            $setting = ChatbotSetting::create($data);
        } else {
            $setting->update($data);
        }
        return redirect()->back()->with('success', 'Configuración actualizada correctamente.');
    }
}
