<?

class UserSession{

    public function __construct($id)
    {
        $this->conn = Database::connect_db();
        $this->id = $id;
        $this->data = null;
        $sql = "select * from users where id = $this->id ";
        $result = $this->conn->query($sql);
        if ($result->num_rows) {
            $row = $result->fetch_assoc();
            $this->data = $row;
            $this->uid = $row['uid'];
        } else {
            throw new Exception("session is invalid");
        }
        
    }

    public static function authenticate($username,$password){
        
    }

    public function getUser(){
        return new User($this->uid);
    }
}