@echo off

echo *** Starting 2_fetch.bat ...


set folder=2_fetch
call 98_folders.bat %folder%
call 98_folders.bat ..\..\cache feed

set result=%folder%\log.html

echo %wget% -q -nv -a %log% -O %output%\%result% "_SITE_/action.php?p=do_test_items&code=%code%" >>%log%
"%wget%" -q -nv -a %log% -O %output%\%result% "%site%/action.php?p=do_test_items&code=%code%" 2>nul

call 99_compare.bat %result%

set result=
set folder=
