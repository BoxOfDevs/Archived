@echo off
TITLE Online, Website software.
::
::
:: //=====\\      ||\\     ||     ||         //\\     ||\\     ||    //======
::||       ||     || \\    ||     ||         \\//     || \\    ||    ||
::||       ||     ||  \\   ||     ||          ||      ||  \\   ||    ||______
::||       ||     ||   \\  ||     ||          ||      ||   \\  ||    ||------
::||       ||     ||    \\ ||     ||          ||      ||    \\ ||    ||
:: \\=====//      ||     \\||     \\=====     ||      ||     \\||    \\======
::
:: Make websites better and easilier !
::
:: Author: BoxOfDevs Team
:: Authors: Ad5001
::
:: Website: http://boxofdevs.byethost14.com
echo %~dp0Main.php
%~dp0..\..\php\php.exe %~dp0Main.php
CMD %~dp0..\..\php\php.exe