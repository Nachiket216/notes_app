<?php
$insert = false;
// connect to database
$servername = "localhost";
$username = "root";
$password = "";
$database = "notes";

$conn = mysqli_connect($servername,$username,$password,$database);

if(!$conn){
    die("Sorry we failed to connect".mysqli_connect_error());
}

if($_SERVER['REQUEST_METHOD']=='POST'){
    $title = $_POST['title'];
    $description = $_POST['description'];

    $sql = "INSERT INTO `notes` (`title`,`description`)VALUES ('$title','$description') ";
    $result = mysqli_query($conn,$sql);
    if($result){
        // echo "The record has been inserted successfully";
        $insert = true;
    }else{
        echo"The record was not inserted " .mysqli_error($conn);
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Notes App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.2/css/jquery.dataTables.min.css">
    <script src="//cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready( function () {
    $('#myTable').DataTable();
    } );
    </script>

</head>

<body>
    <!-- Button trigger modal -->
<!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
  Edit Modal
</button> -->

<!-- Modal -->
<div class="modal  fade " id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit this Note</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form action="/notes_app/index.php" method="post" >
            <div class="mb-3">
                <label for="title" class="form-label">Note Title</label>
                <input type="text" class="form-control" name="title" id="titleEdit" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="desc" class="form-label">Note Description</label>
                <div class="form-floating">
                    <textarea class="form-control" name="description" placeholder="Leave a comment here" id="descriptionEdit"
                        style="height: 100px"></textarea>
                    <label for="floatingTextarea2">Type your notes</label>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Add Note</button>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

<!-- Navbar -->
    <nav class="navbar navbar-expand-lg bg-body-tertiary " data-bs-theme="dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">PHP CRUD</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contace Us</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Dropdown
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled">Disabled</a>
                    </li>
                </ul>
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>
    <?php
        if($insert){
            echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
            <strong>Success!</strong> Your notes has been inserted successfully
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
          </div>";
        }
    ?>

    <div class="container my-4">
        <h2>Add a Note</h2>
        <form action="/notes_app/index.php" method="post" >
            <div class="mb-3">
                <label for="title" class="form-label">Note Title</label>
                <input type="text" class="form-control" name="title" id="title" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="desc" class="form-label">Note Description</label>
                <div class="form-floating">
                    <textarea class="form-control" name="description" placeholder="Leave a comment here" id="desc"
                        style="height: 100px"></textarea>
                    <label for="floatingTextarea2">Type your notes</label>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Add Note</button>
        </form>
    </div>

    <div class="container my-4">
    <table class="table" id="myTable" >
  <thead>
    <tr>
      <th scope="col">Sr.No</th>
      <th scope="col">Title</th>
      <th scope="col">Description</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
  <?php
            $sql = "SELECT * FROM `notes`";
            $result = mysqli_query($conn,$sql);
            $sno =0;
            while($row = mysqli_fetch_assoc($result)){
                $sno = $sno+1;
                echo "
                <tr>
                <th scope='row'>".$sno ."</th>
                <td>".$row['title']."</td>
                <td>".$row['description']."</td>
                <td><button class='edit btn btn-sm btn-primary'>Edit</button>Delete</a> 
                </td>
                </tr>";
            }
        
            ?>
  </tbody>
</table>
             <!-- INSERT INTO `notes` (`sno`, `title`, `description`, `tstamp`) VALUES ('1', 'Buy fruits', 'I want to buy banana, apple, watermelon', '2023-02-13 13:48:45.000000'); -->
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
        crossorigin="anonymous"></script>

        <script>
        edits = document.getElementsByClassName('edit');
        Array.from(edits).forEach((element)=>{
            element.addEventListener("click",(e)=>{
                console.log("edit",);
                tr =e.target.parentNode.parentNode;
                title = tr.getElementsByTagName("td")[0].innerText
                description = tr.getElementsByTagName("td")[1].innerText
                console.log(title,description);
                descriptionEdit.value =description
                titleValue = title
                $('#editModal').modal('toggle')
            })
        })
    </script>
</body>

</html>