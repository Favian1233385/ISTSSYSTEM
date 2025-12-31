@echo off
Pushd "%~dp0"
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


pnputil.exe /subdirs /add-driver *.inf /install


@echo Done
@echo on
