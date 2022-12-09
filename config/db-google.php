<?php
class DB
{
    private $dbHost = "localhost";
    private $dbUsername = "root";
    private $dbPassword = "";
    private $dbName = "tttn";

    public function __construct()
    {
        if (!isset($this->db)) {
            // Connect to the database
            $conn = new mysqli($this->dbHost, $this->dbUsername, $this->dbPassword, $this->dbName);
            if ($conn->connect_error) {
                die("Failed to connect with MySQL: " . $conn->connect_error);
            } else {
                $this->db = $conn;
            }
        }
    }

    public function get_user($id)
    {
        $sql = $this->db->query("SELECT * FROM tttn_loginwith WHERE Id = '$id'");
        return $sql->fetch_assoc();
    }

    public function upsert_user($arr_data = array())
    {
        $uid = $arr_data['Id'];
        $name = $arr_data['Fullname'];
        $email = $arr_data['Email'];
        $picture = $arr_data['picture'];

        // check if user exists by fetching it's details
        $user = $this->get_user($uid);

        if (!$user) {
            // insert the user
            $this->db->query("INSERT INTO tttn_loginwith(Id, Fullname, Email) VALUES('$uid', '$name', '$email', '$picture')");
        } else {
            // update the user
            $this->db->query("UPDATE tttn_loginwith SET name = '$name', email = '$email', picture = '$picture' WHERE google_uid = '$uid'");
        }
    }
}
