<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>To Do List - Completed</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/bootstrap.min.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="">To Do</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="completed.php">Completed</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="settings.php">Settings</a>
                    </li>
                </ul>
            </div>
        </nav>
        <div class="container">
            <div class="row">
            </div>
            <div class="row">
                <header class="mt-5 ml-3">
                    <h2>
                        <?php
                        include 'class.php';
                        session_start();

                        $_SESSION['$compare'] = "complete";
                        $data = new Database;

                        $data->showlist();

                        ?>
                        Completed Tasks
                        <span class="badge badge-pill badge-info"><?php echo count($_SESSION['$numberlist']); ?></span>
                    </h2>
                </header>
                <div class="col-lg-12 mt-5">
                    <!-- Tasks section-->
                    <section>
                        <ul class="list-group list-group-flush">
                            <?php
                              
                            foreach($_SESSION['$post_table'] as $list){  
                            ?>
                            <li class="list-group-item"><?php echo $list['List']; ?></li>
                            <?php
                            }
                            
                            ?>
                        </ul>
                    </section>
                    <nav aria-label="Page navigation example">
                        <ul class="pagination justify-content-center">
                            <li class="page-item">
                                <a class="page-link" href="completed.php?
                            <?php 
                            if (!empty($_SESSION['$getidpage'])) {
                                echo "id="; 
                                echo $_SESSION['$getidpage']-1;
                            }
                            ?>
                            ">Previous</a>
                            </li>
                            <li class="page-item"><a class="page-link" href="completed.php?id=0">1</a></li>
                            <li class="page-item"><a class="page-link" href="completed.php?id=1">2</a></li>
                            <li class="page-item"><a class="page-link" href="completed.php?id=2">3</a></li>
                            <li class="page-item">
                           
                            <a class="page-link"  href="completed.php?
                            <?php 
                            if (empty($_SESSION['$getidpage'])){
                                $_SESSION['$getidpage']=0;
                            }
                            if (!empty($_SESSION['$getidpage']) or $_SESSION['$getidpage']==0) {
                                echo "id="; 
                                echo $_SESSION['$getidpage']+1;
                            }
                            ?>
                            ">Next</a>
                            </li>

                            <?php
                            session_destroy();
                            ?>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </body>
</html>