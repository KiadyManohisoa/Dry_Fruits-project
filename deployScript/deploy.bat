@echo off

set "projectFolder=..\..\Integr-Dry_Fruits"
set "htdocsPath=D:\ITU\S3\Web\xampp\htdocs\S4\Projet_Mme_Baovola\Dry_Fruits-project\"

rem recréation de htdocsPath 
rmdir /s /q "%htdocsPath%"
mkdir "%htdocsPath%"

xcopy "%projectFolder%" "%htdocsPath%" /E /Y