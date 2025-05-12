<?php 
session_start();
include('includes/header.php');
?>

<!-- insert model -->
<div class="modal fade" id="insertdata" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="insertdataLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="insertdataLabel">INSERT DATA INTO DATABASE USING BOOTSTRAP MODEL</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="code.php" method="post">
                <div class="modal-body">

                    <div class=" mb-3">
                        <label for="">Name</label>
                        <input type="text" class="form-control" name="username" placeholder="Enter Username">
                    </div>

                    <div class=" mb-3">
                        <label for="">Email Address</label>
                        <input type="email" class="form-control" name="email" placeholder="Enter Email">
                    </div>

                    <div class=" mb-3">
                        <label for="">Phone Number</label>
                        <input type="number" class="form-control" name="number" placeholder="Enter a Number">
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="save_data" class="btn btn-primary">Save data</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <?php
            if(isset($_SESSION['status']) && $_SESSION['status'] !='')
            {
                echo $_SESSION['status'];
                ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Holy guacamole!</strong> <?php echo $_SESSION['status']; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php
                unset($_SESSION['status']);
            }
            ?>

            <div class="card">
                <div class="card-header">
                    <h4>PHP POP-UP MODEL CRUD- part1</h4>
                </div>
                <div class="card-body">
                    <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal"
                        data-bs-target="#insertdata">
                        INSERT DATA
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include('includes/footer.php') ?>