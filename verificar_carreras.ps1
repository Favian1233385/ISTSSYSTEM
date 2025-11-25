Write-Host "=== VERIFICACIÓN DE CARRERAS ===" -ForegroundColor Green
Write-Host "`n1. Archivos en storage/app/public/careers:" -ForegroundColor Yellow
Get-ChildItem "storage\app\public\careers" -File -ErrorAction SilentlyContinue | Format-Table Name, Length, LastWriteTime
Write-Host "`n2. Para ver las carreras en BD ejecuta:" -ForegroundColor Yellow
Write-Host 'php artisan tinker --execute="echo json_encode(DB::table(''careers'')->get([''id'', ''name'', ''image_path''])->toArray(), JSON_PRETTY_PRINT);"' -ForegroundColor Cyan
