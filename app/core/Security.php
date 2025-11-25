<?php
/**
 * Shim de compatibilidad para el sistema legacy: clase global Security
 * Provee un método estático logSecurity(...) usado por app/core/Model.php
 *
 * Esta implementación registra usando el facade de Laravel si está
 * disponible, o cae a error_log() en entornos donde no esté cargado.
 */
class Security
{
    /**
     * Registrar un evento de seguridad/error desde el código legacy.
     * @param string $code  Código o tipo de evento (por ejemplo 'database_error')
     * @param mixed $user   Identificador de usuario (opcional)
     * @param string|null $message Mensaje adicional
     * @param string $level  Nivel lógico ('low','medium','high' u 'info','warning','error')
     */
    public static function logSecurity($code, $user = null, $message = null, $level = 'info')
    {
        // Mapear niveles legacy a niveles de log de Laravel
        $map = [
            'low' => 'info',
            'medium' => 'warning',
            'high' => 'error',
            'info' => 'info',
            'warning' => 'warning',
            'error' => 'error',
        ];

        $lvl = $map[strtolower($level)] ?? 'info';

        $payload = [
            'type' => $code,
            'user' => $user,
            'message' => $message,
            'time' => date('c'),
        ];

        $text = sprintf("[LegacySecurity] %s | user=%s | msg=%s", $code, json_encode($user), $message);

        // Si el facade Log de Laravel está disponible, usarlo
        if (class_exists('\\Illuminate\\Support\\Facades\\Log')) {
            try {
                $logger = '\\Illuminate\\Support\\Facades\\Log';
                // Llamada dinámica al nivel correspondiente
                if (method_exists($logger, $lvl)) {
                    $logger::{$lvl}($text, $payload);
                    return;
                }
                // Fallback
                $logger::info($text, $payload);
                return;
            } catch (\Throwable $e) {
                // Si algo falla con el facade, caer al error_log
            }
        }

        // Fallback: simple error_log
        error_log($text . ' | ' . json_encode($payload));
    }
}
