
<?
class Database{

    public static $conn;

    public static function connect_db(){

        if (Database::$conn == null) {

            $servername =  get_config('db_host');
            $db_username = get_config('db_username');
            $db_password = get_config('db_password');
            $database = get_config('db_database');
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
