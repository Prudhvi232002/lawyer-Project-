@echo off
title KMS Server Service Uninstaller
color 1F

set hSpp="HKEY_LOCAL_MACHINE\SOFTWARE\Microsoft\Windows NT\CurrentVersion\SoftwareProtectionPlatform"
set hOspp="HKEY_LOCAL_MACHINE\SOFTWARE\Microsoft\OfficeSoftwareProtectionPlatform"

echo -------------------------------------------------------------------------------
echo    KMS Server Service Uninstaller
echo -------------------------------------------------------------------------------
echo.

:--------------------------------------
"%WinDir%\system32\reg.exe" query "HKU\S-1-5-19" >NUL 2>&1
	if '%ErrorLevel%' NEQ '0' (
			goto UACPrompt
	) else ( goto gotAdmin )

:UACPrompt
    echo Set UAC = CreateObject^("Shell.Application"^) > "%Temp%\getadmin.vbs"
    echo UAC.ShellExecute "%~s0", "", "", "runas", 1 >> "%Temp%\getadmin.vbs"
    "%Temp%\getadmin.vbs"
    exit /B

:gotAdmin
    if exist "%Temp%\getadmin.vbs" ( del "%Temp%\getadmin.vbs" )
    pushd "%~dp0"
:--------------------------------------

echo Uninstall service...
echo.

sc stop "KMSServerService" >nul 2>&1
sc delete "KMSServerService"

reg delete %hSpp% /f /v "KeyManagementServiceName" >nul 2>&1
reg delete %hSpp% /f /v "KeyManagementServicePort" >nul 2>&1
reg delete %hSpp% /f /v "VLActivationType" >nul 2>&1
reg delete %hSpp% /f /v "DisableDnsPublishing" >nul 2>&1
reg delete %hSpp% /f /v "DisableKeyManagementServiceHostCaching" >nul 2>&1

reg delete %hOspp% /f /v "KeyManagementServiceName" >nul 2>&1
reg delete %hOspp% /f /v "KeyManagementServicePort" >nul 2>&1
reg delete %hOspp% /f /v "VLActivationType" >nul 2>&1
reg delete %hOspp% /f /v "DisableDnsPublishing" >nul 2>&1
reg delete %hOspp% /f /v "DisableKeyManagementServiceHostCaching" >nul 2>&1

del "%WinDir%\system32\kms.exe"

echo.
echo -------------------------------------------------------------------------------
echo.
echo Done...
pause >nul
exit