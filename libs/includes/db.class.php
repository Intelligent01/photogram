
<?
class Database{

    public static $conn;

    public static function connect_db(){

        if (Database::$conn == null) {
            
            $servername = "mysql.selfmade.ninja";
            $db_username = "captain";
            $db_password = "Captain@123";
            $database = "captain_ecom";
            // Create connection
            $conn = new mysqli($servername, $db_username, $db_password, $database);
            // Check connection
            if ($conn->connect_error) {
                throw new Exception("Connection failed: " . $conn->connect_error);
            }else {

                return Database::$conn = $conn;

            }
        }else 
        {
            return Database::$conn;
        }
    }

}
?>
