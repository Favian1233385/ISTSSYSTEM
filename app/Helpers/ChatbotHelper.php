<?php
namespace App\Helpers;

use App\Models\ChatbotSetting;

class ChatbotHelper
{
    public static function getFallbackMessage()
    {
        $setting = ChatbotSetting::first();
        if ($setting) {
            $msg = $setting->fallback_message;
            $phone = $setting->contact_phone;
            $email = $setting->contact_email;
            $hours = $setting->contact_hours;
            $html = $msg;
            if ($phone) {
                $html .= '<br>📱 <a href="https://wa.me/' . preg_replace('/[^0-9]/', '', $phone) . '" target="_blank">WhatsApp</a>';
            }
            if ($email) {
                $html .= '<br>✉️ <a href="mailto:' . $email . '">' . $email . '</a>';
            }
            if ($hours) {
                $html .= '<br>🕒 Horario de atención: ' . $hours;
            }
            return $html;
        }
        return 'Gracias por tu mensaje. No he encontrado una respuesta exacta, pero puedes consultar nuestras carreras, noticias, actualizaciones o contactar a un asesor para más información.';
    }
}
