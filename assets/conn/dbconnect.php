<?php
// if(!mysql_connect("localhost","root",""))
// {
//      die('oops connection problem ! --> '.mysql_error());
// }
// if(!mysql_select_db("db_healthcare"))
// {
//      die('oops database selection problem ! --> '.mysql_error());
// }
?>

<?php
//      define('_HOST_NAME','localhost');
//      define('_DATABASE_NAME','db_healthcare');
//      define('_DATABASE_USER_NAME','root');
//      define('_DATABASE_PASSWORD','');
 
//      $MySQLiconn = new MySQLi(_HOST_NAME,_DATABASE_USER_NAME,_DATABASE_PASSWORD,_DATABASE_NAME);
  
//      if($MySQLiconn->connect_errno)
//      {
//        die("ERROR : -> ".$MySQLiconn->connect_error);
//      }
// ?>
<!-- mysql -->
 <?php 
// if(!mysql_connect("mysql.hostinger.my","u346953953_admin","database123"))
// {
//      die('oops connection problem ! --> '.mysql_error());
// }
// if(!mysql_select_db("u346953953_db"))
// {
//      die('oops database selection problem ! --> '.mysql_error());
// }
//  ?>

<!-- mysqli -->
<?php
// $con = mysqli_connect("mysql.hostinger.my","u346953953_admin","database123","u346953953_db");

// // Check connection
// if (mysqli_connect_errno())
//   {
//   echo "Failed to connect to MySQL: " . mysqli_connect_error();
//   }
?>
<?php
$host = 'dbhealthcare.mysql.database.azure.com';
$username = 'root1@dbhealthcare';
$password = 'Mauricio_1';
$db_name = 'db_healthcare';

//Initializes MySQLi
$conn = mysqli_init();

mysqli_ssl_set($conn,NULL,NULL, "/var/www/html/DigiCertGlobalRootG2.crt.pem", NULL, NULL);

// Establish the connection
mysqli_real_connect($conn, 'dbhealthcare.mysql.database.azure.com', 'root1@dbhealthcare', 'Mauricio_1', 'quickstartdb', 3306, NULL, MYSQLI_CLIENT_SSL);

//If connection failed, show the error
if (mysqli_connect_errno())
{
    die('Failed to connect to MySQL: '.mysqli_connect_error());
}