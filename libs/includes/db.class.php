
<?
class Database{

    public static $conn;

    public static function connect_db(){

        if (Database::$conn == null) {
            
            $json_config = file_get_contents($_SERVER['DOCUMENT_ROOT']."/../photogram.conf.json");
            $config = json_decode($json_config,true);

            $servername =  $config['db_host'];
            $db_username = $config['db_username'];
            $db_password = $config['db_password'];
            $database = $config['db_database'];
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
