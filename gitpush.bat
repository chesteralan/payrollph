@echo off
:INTRO
cls
echo ---------------------------------------------------------
echo ------- Payroll PH ---------------------
echo ---------------------------------------------------------
echo your are about to push to BitBucket.org Payroll Repository
pause

:PUSHLINE
For /f "tokens=2-4 delims=/ " %%a in ('date /t') do (set MYDATE=%%c-%%a-%%b)
For /f "tokens=1-2 delims=/" %%a in ('time /t') do (set MYTIME=%%a%%b)
git add . -A
git commit -m "Updates %MYDATE% %MYTIME%"
git push
pause
GOTO INTRO