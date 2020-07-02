@ECHO OFF

IF [%1] == [] GOTO ShowHelp

ROBOCOPY app\code\community\Magmodules\Channable %1\app\code\community\Magmodules\Channable /MIR /XA:SH /XD .git /NP
XCOPY app\design\adminhtml\default\default\layout\magmodules_channable.xml %1\app\design\adminhtml\default\default\layout\ /Q /Y
ROBOCOPY app\design\adminhtml\default\default\template\magmodules\channable %1\app\design\adminhtml\default\default\template\magmodules\channable /MIR /XA:SH /XD .git /NP
XCOPY app\etc\modules\Magmodules_Channable.xml %1\app\etc\modules /Q /Y
XCOPY app\locale\en_US\Magmodules_Channable.csv %1\app\locale\en_US /Q /Y
XCOPY app\locale\nl_NL\Magmodules_Channable.csv %1\app\locale\nl_NL /Q /Y
ROBOCOPY skin\adminhtml\default\default\magmodules\channable %1\skin\adminhtml\default\default\magmodules\channable /MIR /XA:SH /XD .git /NP
GOTO End

:ShowHelp
ECHO.
ECHO Usage: deploy.bat ^<wwwroot^>
ECHO.
ECHO ^<wwwroot^>  =  Root directory of Magento website
ECHO.

:End
