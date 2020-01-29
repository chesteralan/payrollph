@echo off
:INTRO
cls
echo ---------------------------------------------------------
echo ---------------------------------------------------------
echo your are about to push to BitBucket.org Repository
pause

:PUSHLINE
For /f "" %%a in ('date /t') do (set MYDATE=%%a)
For /f "" %%a in ('time /t') do (set MYTIME=%%a)
git add . -A
git commit -m "Updates %MYDATE% %MYTIME%"
git push
pause
pause
pause
pause
pause
GOTO INTRO