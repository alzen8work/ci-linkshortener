For windows:
run in cmd setup.bat

For linux: 
run in terminal setup.sh

At Mysql Terminal:
create a new db with you own (DBNAME) with mysql schema at the following file:
init_with_migrations.sql

Change directory to _app/config/
Edit database.php,
fill in the credential of you mysql:
--------------------------------------------------
'username' => '',
'password' => '',
'database' => '(DBNAME)',
--------------------------------------------------

Edit config.php,
fill in app's root directory path at: 
{APP ROOT} = eg: localhost:8080/app/
--------------------------------------------------
$config['base_url'] = '{APP ROOT}';
--------------------------------------------------


good to go.