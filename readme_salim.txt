Ref: https://spreadwaves.com/how-to-install-yii2-0-basic-and-advanced-application-using-composer-and-archived-files/
Ref: https://www.mwcbarcelona.com/
----------------------------------------------------------------------------------------------------------------------------------
Install Yii2 Advanced
composer create-project --prefer-dist yiisoft/yii2-app-advanced
----------------------------------------------------------------------------------------------------------------------------------
step 1) 
php init
set development or production mode
----------------------------------------------------------------------------------------------------------------------------------
step 2)
Create a new database and adjust the components configuration in C:/wamp/www/yii2advanced/common/config/main-local.php accordingly.
----------------------------------------------------------------------------------------------------------------------------------
step 3)
Apply migrations with console command c:\xampp\htdocs\projects\yii2advanced> yii migrate
----------------------------------------------------------------------------------------------------------------------------------
step 4)
Set document roots of your Web server:
for frontend /path/to/yii-application/frontend/web/ [ In my case http://localhost/yii2advanced/frontend/web/index.php"
for backend /path/to/yii-application/backend/web/ [ In my case http://localhost/yii2advanced/backend/web/]
----------------------------------------------------------------------------------------------------------------------------------
Frontend: http://localhost/projects/events/frontend/web/
Backend: http://localhost/projects/events/backend/web/
salim / salim123
----------------------------------------------------------------------------------------------------------------------------------
Sub Dominas
Ref: https://www.dev-tips-and-tricks.com/add-subdomains-to-a-xampp-server-on-windows

1) C:\xampp\apache\conf\httpd.conf uncomment LoadModule vhost_alias_module modules/mod_vhost_alias.so
2) C:\xampp\apache\conf\extra\httpd-vhosts.conf
3) C:\Windows\System32\drivers\etc\hosts and add 127.0.0.1 test.localhost.com
4) events.localhost.com
----------------------------------------------------------------------------------------------------------------------------------

