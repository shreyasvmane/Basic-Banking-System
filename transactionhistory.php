<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> History </title>

    <!-- External CSS file  -->
    <link rel="stylesheet" href="css/style.css?<?php echo date('l jS \of F Y h:i:s A'); ?>">
    <link rel="stylesheet" href="css/table.css?<?php echo date('l jS \of F Y h:i:s A'); ?>">

    <!-- Link for Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Bootstrap Files -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        .table td {
            text-align: center;
        }
    </style>
</head>

<body>
    <!-- Header-->
    <div class="container-fluid">
        <!-- Navigation Bar -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="#"> <span class="material-icons" style="font-size:36px;"> account_balance
                </span></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="viewcustomers.php">View Customers</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Transaction History</a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>


    <div class="container">
        <h2 class="text-center pt-4 text">TRANSACTION HISTORY</h2>
        </hr>
        <hr>
        <br>
        <div class="row">
            <div class="col">
                <div class="table-responsive-sm">
                    <table class="table table-hover table-striped table-condensed table-bordered ">
                        <thead>
                            <tr>
                                <th class="text-center">Transaction <br> ID</th>
                                <th class="text-center">Sender</th>
                                <th class="text-center">Receiver</th>
                                <th class="text-center">Amount</th>
                                <th class="text-center">Date and Time </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

        $servername = "localhost";
        $username = "root";
        $password = "";
        $db = "bankdata";

// Create connection
        $conn = mysqli_connect($servername, $username, $password, $db);

	if(!$conn){
		die("Unable to connect to the db due to the following error --> ".mysqli_connect_error());
	}


            $sql ="select * from transaction";

            $query =mysqli_query($conn, $sql);

            while($rows = mysqli_fetch_assoc($query))
            {
        ?>

                            <tr>
                                <td class="py-2">
                                    <?php echo $rows['id']; ?>
                                </td>
                                <td class="py-2">
                                    <?php echo $rows['sender']; ?>
                                </td>
                                <td class="py-2">
                                    <?php echo $rows['receiver']; ?>
                                </td>
                                <td class="py-2">
                                    <?php echo $rows['balance']; ?>
                                </td>
                                <td class="py-2">
                                    <?php echo $rows['datetime']; ?>
                                </td>

                                <?php
            }

        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>



    <br><br><br>
    <link rel="stylesheet" href="css/footer.css?<?php echo date('l jS \of F Y h:i:s A'); ?>">
    <?php
include 'footer.php';
?>

</body>

</html>