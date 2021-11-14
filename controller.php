<?php

include 'class.php';
$deletedata = new delete;
$updatedata = new update;
$selectdata = new Select;

if (empty($_GET['ID']) and empty($_GET['pagination']))
{
    header("location:index.php"); 
}

if (!empty($_GET['ID'])){
    $id = intval($_GET['ID']);
    echo $id;

    if($deletedata->delete("todolist", 'ID = '.$id))  
     {  
        header("location:index.php");  
     }  
}

if (!empty($_GET['pagination'])){

    if(isset($_POST["savepagination"])) {  
        $update_data = array(  
            'Pagination' => $_POST['paginationtxt'],  
        );  
        $where_condition = array(  
            'ID' => intval($_GET['pagination'])
        );  
        if($updatedata->update("pagination", $update_data, $where_condition))  
        {  
            header("location:completed.php");  
        }  
    }   
}

if (!empty($_GET['completed'])){
    $update_data = array(  
        'Status' => 'Completed',  
    );  
    $where_condition = array(  
        'ID' => intval($_GET['completed'])
    );  
    if($updatedata->update("todolist", $update_data, $where_condition))  
    {  
        header("location:index.php");  
    }    
}




?>
