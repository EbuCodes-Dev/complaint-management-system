<?php
ob_start();
include("../includes/session.php");
?>

<?php
ob_start();
// Query for registering a new category
if (isset($_POST["addCategory"])) {
    $categoryName = $_POST["categoryName"];  
    $date = date("Y/m/d");

    $query = "INSERT INTO category (categoryName, date) VALUES ('$categoryName','$date')" or die(mysqli_error($conn));
    $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
    if ($result) {
    ?>
            <script>
                setTimeout(function() {
                        swal({
                            title: "Congratulations!!!",
                            text: "<?php echo $categoryName ?> was successfully added as a Category",
                            html: true,
                            icon: "success",
                            button: "OK",
                        });
                    },
                    100);
            </script>     
    <?php
    } else {
    ?>
            <script>
                setTimeout(function() {
                        swal("Error!", "Category not added!", "error");
                    },
                    100);
            </script>
    <?php
    }
    
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>FUTO Complaints System | Category</title>

<?php include("../includes/style.php"); ?>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">


  <!-- Navbar -->
<?php include("../includes/navbar.php"); ?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
    <?php include("../includes/sidebar.php"); ?>
  <!-- Content Wrapper. Contains page content -->
  <?php 
    if ($admin_info['category'] == 'Admin') {
  ?>
  <div class="content-wrapper">

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Edit faculty Form -->
        <div class="card card-dark">
          <div class="card-header">
            <h1 class="card-title"><i class="fa fa-plus-circle"></i> New Category</h1>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
                <form action="addCategory.php" class="form-signin" method="POST" enctype="multipart/form-data" novalidate>
                    <div class="form-group">
                        <label>Category</label>
                        <input type="text" name="categoryName" id="categoryName" class="form-control" placeholder="Enter Name" required>
                        <div class="invalid-feedback">This field is required.</div>
                    </div>

                    <div class="modal-footer justify-content-between">
                        <button type="submit" name="addCategory" class="btn bg-gradient-success"><i class="fas fa-save"></i> Save</button>
                        <a type="button" class="btn bg-gradient-danger" href="../category/"><i class="fas fa-arrow-left"></i> Back</a>
                    </div>
                </form>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
<!-- Footer -->
<?php include("../includes/footer.php"); ?>
<?php
  } else {
  ?>
            <script>
                setTimeout(function() {
                        swal({
                            title: "Error!!!",
                            text: "You don't have permission to view this page",
                            icon: "error",
                            button: "OK",
                        }).then(function(){
                          window.location ="../index.php";
                        });
                    },
                    100);
            </script> 
  <?php
  }
  
?>
<!-- JavaScript -->
<?php include("../includes/scripts.php"); ?>

    <script>
        // Self-executing function
        (function() {
            'use strict';
            window.addEventListener('load', function() {
                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                var forms = document.getElementsByClassName('form-signin');
                // Loop over them and prevent submission
                var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();
    </script>
</body>
</html>
