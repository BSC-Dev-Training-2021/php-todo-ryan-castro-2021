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

    public function delete ($table_name, $id) {
        
        $query = "DELETE FROM ".$table_name." WHERE ".$id;
        if(mysqli_query($this->con, $query)){
            return true;
        }
        else{
            echo 'Database Connection Error ' . mysqli_connect_error($this->con);
        }
      }

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

      public function select($column_name, $table_name ,$where, $condition, $limit){
        $array = array();  
        $query = "SELECT ". $column_name ." FROM ".$table_name." ".$where." ". $condition." ".$limit;
        $result = mysqli_query($this->con, $query);
        while($row = mysqli_fetch_assoc($result))
        {
            $array[] = $row; 
        }
       return $array;
    }

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
        $data = new Database;
            $insert_data = array(
                'List' => $_POST['todo'],
                'Status' => 'To Do',
                'Date' => date( 'Y-m-d H:i:s')
            );
            if($data->insert('todolist', $insert_data)){

            }
    }

    public function deletelist(){
        $data = new Database;
        if (empty($_GET['ID']) and empty($_GET['pagination']))
        {
            header("location:index.php"); 
        }

        if (!empty($_GET['ID'])){
            $id = intval($_GET['ID']);
            echo $id;

            if($data->delete("todolist", 'ID = '.$id))  
            {  
                header("location:index.php");  
            }  
        }
    }

    public function updatepagination(){
        $data = new Database;
        if(isset($_POST["savepagination"])) {  
            $update_data = array(  
                'Pagination' => $_POST['paginationtxt'],  
            );  
            $where_condition = array(  
                'ID' => intval($_GET['pagination'])
            );  
            if($data->update("pagination", $update_data, $where_condition))  
            {  
                header("location:completed.php");  
            }  
        }   
    }

    public function updatelist(){
        $data = new Database;
        $update_data = array(  
            'Status' => 'Completed',  
        );  
        $where_condition = array(  
            'ID' => intval($_GET['completed'])
        );  
        if($data->update("todolist", $update_data, $where_condition))  
        {  
            header("location:index.php");  
        }
    }

    public function showlist(){
        
        $data = new Database;
        
        if (!empty($_GET['id'])){
            $getid = (int)$_GET['id'];
        }
        $getpag = $data->select('*','pagination','WHERE ID=1','',''); 
        
        $limit = 0;
        $offset = 0;
        foreach($getpag as $pag){
            $limit = $pag["Pagination"];
            if (!empty($_GET['id'])){
                $offset = $pag["Pagination"] * $_GET['id'];
            }    
        }  
        
        $wew = $_SESSION['$compare'];

        if ($wew == "complete"){
            $where = "WHERE Status = 'Completed'";
        }
        else if ($wew == "todo"){
            $where = "WHERE Status = 'To Do'";
        }
        else
        {
            echo "<script type='text/javascript'>alert('$wew');</script>";
        }

        $orderby = "ORDER BY Date DESC";

        $_SESSION['$numberlist'] = $data->select('List','todolist','' ,$where,''); 

        $_SESSION['$post_table'] = $data->select('*','todolist ',' '. $where .' ',' '.$orderby.' ',' LIMIT '.$limit.' OFFSET '.$offset);    
    }
} 


?>
