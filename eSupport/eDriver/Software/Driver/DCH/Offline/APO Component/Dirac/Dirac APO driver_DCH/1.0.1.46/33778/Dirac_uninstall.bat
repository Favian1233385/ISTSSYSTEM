@echo off
cd %~DP0
cls
:check_Permissions
    echo Administrative permissions required. Detecting permissions...

    net session >nul 2>&1
    if %errorLevel% == 0 (
        echo Success: Administrative permissions confirmed.
    ) else (
        echo Failure: Current permissions inadequate.
	goto end
    )
Powershell.exe -ExecutionPolicy Bypass -Command "& '%~dp0Dirac_executor.ps1'"

:end
pause
