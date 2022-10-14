<!DOCTYPE html>
<html>

<head>
<title> </title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>NARENDRA PONGULETI</title>
<link href='http://fonts.googleapis.com/css?family=Roboto+Condensed|Open+Sans+Condensed:300' rel='stylesheet' type='text/css'>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>


<script type="text/javascript" src="https://code.jquery.com/jquery-1.7.1.min.js"></script>
<!--Bootstrap CSS link -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

<!--Font Awesome CDN  link -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<!--Custom CSS-->
    <link rel="stylesheet" href="CRUD_CSS/style.css">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>

<h1 class="bg-dark text-light text-center py-2">NARENDRA PONGULETI</h1>

<div class="container">

<div class="displaymessage text-center alert-success" id="displaymessage" role="alert" style="font-weight:700;"></div>
<!--Form Modal -->
<?php
    include "form.php";
    include "profile.php";
 ?>
<!--Form Modal END -->

<!--input serach and button section -->

<div class="row mb-4">
    <div class="col-10">
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text bg-dark"><i class="fa-solid fa-magnifying-glass text-light"></i></span>
            </div>
            <input type="text" class="form-control" placeholder="Serch user..." id="searchinput">
            
        </div>
        
    </div>
    <div class="col-2">
        <button class="btn btn-dark" type="button" data-bs-toggle="modal" data-bs-target="#usermodal" id="adduserbtn">Add New User</button>
    </div>
    
    
</div>

<!--Table section -->
<?php
    include "tableData.php";
 ?>
<!--Table section END-->

<!--Pagination -->
<nav aria-label="Page navigation example" id="pagination">
  <!--<ul class="pagination justify-content-center">
    <li class="page-item disabled"><a class="page-link" href="#">Previous</a></li>
    <li class="page-item active"><a class="page-link" href="#">1</a></li>
    <li class="page-item"><a class="page-link" href="#">2</a></li>
    <li class="page-item"><a class="page-link" href="#">3</a></li>
    <li class="page-item"><a class="page-link" href="#">Next</a></li>
  </ul>-->
</nav>

<input type="hidden" value="1" name="currentpage" id="currentpage">


</div>


<!--JQuery CDN  JavaScript links -->

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<!--Bootstrap JavaScript links -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>



<!--JS FILE -->
<script type="text/javascript" src="CRUD_JS/script.js"></script>

</body>
</html>