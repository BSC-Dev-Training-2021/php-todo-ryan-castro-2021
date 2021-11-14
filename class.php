<?php
class Database {
    public $con;
    public $error;
    public $table_name;

    public function __construct(){
        $this->con = mysqli_connect("localhost", "root", "", "todo");
        if(!$this->con)
        {
            echo 'Database Connection Error ' . mysqli_connect_error($this->con);
        }
    }
} 

class delete extends Database {
    public function delete($table_name, $id) {
        $query = "DELETE FROM ".$table_name." WHERE ".$id;
        if(mysqli_query($this->con, $query)){
            return true;
        }
        else{
            echo 'Database Connection Error ' . mysqli_connect_error($this->con);
        }
      }
}

class update extends Database {
    public function update($table_name, $fields, $where) {
        $query = '';
        $condition = '';
        foreach($fields as $key => $value) {  
            $query .= $key . "='".$value."', ";  
        }  

        $query = substr($query, 0, -2);  

        foreach($where as $key => $value) {
            $condition .= $key . "='".$value."' AND ";
        }  
        $condition = substr($condition, 0, -5);

        $query = "UPDATE ".$table_name." SET ".$query." WHERE ".$condition."";
        if(mysqli_query($this->con, $query)){
            return true;
        }
        else{
            echo 'Database Connection Error ' . mysqli_connect_error($this->con);
        }
      }

}

class select extends Database {
    public function select($column_name, $table_name,$where,$condition,$limit){
        $array = array();  
        $query = "SELECT ". $column_name ." FROM ".$table_name." ".$where." ". $condition." ".$limit;
        $result = mysqli_query($this->con, $query);
        while($row = mysqli_fetch_assoc($result))
        {
            $array[] = $row; 
        }
       return $array;
    }
}

class Insert extends Database {
    public function insert($table_name, $data){
        $string = "INSERT INTO $table_name (";
        $string .= implode(",", array_keys($data)) . ') VALUES (';
        $string .= "'" . implode("','", array_values($data)) . "')";
        if(mysqli_query($this->con, $string)) {
            return true;
        }
        else{
            echo mysqli_error($this->con);
        }
   }
    public function inserttodo(){
        $data = new Insert;
            $insert_data = array(
                'List' => $_POST['todo'],
                'Status' => 'To Do',
                'Date' => date( 'Y-m-d H:i:s')
            );
            if($data->insert('todolist', $insert_data)){
            }
    }
}



?>
