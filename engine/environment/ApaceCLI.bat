@echo off
setlocal enabledelayedexpansion
setlocal enableextensions
MODE CON: COLS=98 LINES=22
COLOR A
for /f %%A in ('"prompt $H &echo on &for %%B in (1) do rem"') do set BS=%%A

echo.
echo  Apace MVC environment CLI
echo  -------------------------------------------------------
echo  Type the appname inside the 'application' folder you want to work against.
echo  Available applications:
for /D %%s in (..\..\application\*) do echo  ^> %%~ns
echo  -------------------------------------------------------
:start
SET /pappfolder=.%BS% ^> 

IF EXIST ..\..\data\!appfolder!data (
echo  ------ You are monitoring !appfolder!
echo  -------------------------------------------------------
goto :loop
) ELSE (
echo  Error: !appfolder! does not exist
goto :start
)

:loop

timeout -t 1 >nul  


rem javascriptcompresser
for %%i in (..\..\data\!appfolder!data\js\*.js) do ( 

		echo %%~ai|find "a">nul
		if errorlevel 1 (
			rem file was not changed
		) else (
			php ..\lib\systemwatch.php minifyjs %%~ni !appfolder!
  			echo  File: %%~ni was minified
			echo  FilePath: %%~nfi 
			echo  FileType: Javascript
			echo  -------------------------------------------
			rem 'a'ttribute is overwritten
			attrib -a %%i
		)
)

rem lesscompiler
for %%i in (..\..\data\!appfolder!data\css\*.less) do ( 

		echo %%~ai|find "a">nul
		if errorlevel 1 (
			rem file was not changed
		) else (
			php ..\lib\systemwatch.php less %%~nfi %%~ni !appfolder!
		    echo.
		    echo  FilePath: %%~nfi 
			echo  FileType: Less
			echo  -------------------------------------------
			rem 'a'ttribute is overwritten
			attrib -a %%i
		)
)

goto :loop