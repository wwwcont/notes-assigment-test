@echo off
cd D:\test_2

REM Обновляем composer, игнорируя отсутствующие расширения
echo Updating composer dependencies...
composer update --ignore-platform-req=ext-fileinfo

REM Устанавливаем npm зависимости
echo Installing npm dependencies...
npm install

REM Собираем assets
echo Building assets...
npm run build

echo Installation complete!
pause
