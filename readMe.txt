Devana - the open source browser strategy game
-------------
Read the "license.txt" file for information about copyright.
Requirements: http web server, mysql database system, php, openssl.
When using this game get the latest versions of the above mentioned software.

Installation steps:
1. create a database in mysql;
2. import the "install/devana.sql" file in the database you just created;
3. edit the database connection data in the "devana/core/config.php" file;
4. edit the email settings in the "devana/core/email/email.php" file;
5. go to the install page "http://localhost/devana/install/install.php" to add the map data to the database;
     optionally, you can edit the map you'll be using by changing the "install/grid.png" image;
      each pixel is one map sector;
      blue is for water, green is for land;
6. delete the "install" folder;

For more information visit http://devana.eu.