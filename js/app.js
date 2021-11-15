$(document).ready(function() {

    $(document).on("click","#deletebtn",function(){
        
        console.log($(this).attr("todo_id"))
        $("#todo_id_txt").val($(this).attr("todo_id"))
    })


});


