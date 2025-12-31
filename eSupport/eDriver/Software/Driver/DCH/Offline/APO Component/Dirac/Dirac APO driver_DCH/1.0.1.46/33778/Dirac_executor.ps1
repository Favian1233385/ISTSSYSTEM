If (-NOT ([Security.Principal.WindowsPrincipal] [Security.Principal.WindowsIdentity]::GetCurrent()).IsInRole([Security.Principal.WindowsBuiltInRole]::Administrator))
{
  # Relaunch as an elevated process:
  Start-Process powershell.exe "-File",('"{0}"' -f $MyInvocation.MyCommand.Path) -Verb RunAs
  exit
}

$online_drivers = Get-WindowsDriver -Online | Where-Object {$_.ProviderName -eq "Drivewintech Co., Ltd."}

Stop-Service Audiosrv
Stop-Service DiracAudSrv

$service = Get-WmiObject -Class Win32_Service -Filter "Name='DiracAudSrv'"
$service.delete()

foreach ($driver in $online_drivers) {
    #echo $driver
    if ($driver.OriginalFileName -match "DiracExt.inf$") {
        $diracext = $driver
        Write-Host "DiracExt Version    $($diracext.Version) $(($diracext.Date).ToString("yyyy/MM/dd"))" -NoNewline        
    } elseif ($driver.OriginalFileName -match "DiracIapEffectApo.inf$") {        
        $apoeffect = $driver            
        Write-Host "DiracIapEffectApo Version           $($apoeffect.Version) $(($apoeffect.Date).ToString("yyyy/MM/dd"))" -NoNewline
    } elseif ($driver.OriginalFileName -match "DiracHsa.inf$") {
        $dirachsa = $driver
        Write-Host "DiracHsa Version    $($dirachsa.Version) $(($dirachsa.Date).ToString("yyyy/MM/dd"))" -NoNewline
    } elseif ($driver.OriginalFileName -match "DiracService.inf$") {
        $diracservice = $driver
        Write-Host "DiracService Version    $($diracservice.Version) $(($diracservice.Date).ToString("yyyy/MM/dd"))" -NoNewline
    } else {
        continue
    }
    pnputil /delete-driver $($driver.Driver) /uninstall | out-null
    Write-Host "   ...removed"
}

if ($diracext -eq $null -and $apoeffect -eq $null -and $dirachsa -eq $null -and $diracservice -eq $null) {
    Write-Host "No Dirac driver is found!"
}

Start-Service Audiosrv

if ($psISE -eq $null) {
    # keep console opened
    Write-Host "Press any key to continue..."
    [void][System.Console]::ReadKey($true)
}
