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

if(isset($_POST['submit']))
{
    $from = $_GET['id'];
    $to = $_POST['to'];
    $amount = $_POST['amount'];

    $sql = "SELECT * from users where id=$from";
    $query = mysqli_query($conn,$sql);
    $sql1 = mysqli_fetch_array($query); 

    $sql = "SELECT * from users where id=$to";
    $query = mysqli_query($conn,$sql);
    $sql2 = mysqli_fetch_array($query);



    
    if (($amount)<0)
   {
        echo '<script type="text/javascript">';
        echo ' alert("Dear User, Please Enter correct amount")';
        echo '</script>';
    }

 
    else if($amount == 0){

        echo "<script type='text/javascript'>";
            echo "alert('Dear User, Please Enter correct Amount')";
            echo "</script>";
    }

  
    
    else if($amount > $sql1['balance']) 
    {
        
        echo '<script type="text/javascript">';
            echo ' alert("Dear User, Insufficient Balance")';
            echo '</script>';
    }
    

    else {
        
                
                $newbalance = $sql1['balance'] - $amount;
                $sql = "UPDATE users set balance=$newbalance where id=$from";
                mysqli_query($conn,$sql);
             

                
                $newbalance = $sql2['balance'] + $amount;
                $sql = "UPDATE users set balance=$newbalance where id=$to";
                mysqli_query($conn,$sql);
                
                $sender = $sql1['name'];
                $receiver = $sql2['name'];
                $sql = "INSERT INTO transaction(`sender`, `receiver`, `balance`) VALUES ('$sender','$receiver','$amount')";
                $query=mysqli_query($conn,$sql);

                if($query){
                     echo "<script> alert('Transaction Successful!');
                        window.location = 'viewcustomers.php';
                    </script>";
                    
                }

                $newbalance= 0;
                $amount =0;
        }
    
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Money Transfer</title>

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
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="viewcustomers.php">View Customers</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="transactionhistory.php">Transaction History</a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
    <main>

        <div class="container">
            <h2 class="text-center pt-4 text"> MONEY TRANSFER</h2>
            <hr>
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
                $sid=$_GET['id'];
                $sql = "SELECT * FROM  users where id=$sid";
                $result=mysqli_query($conn,$sql);
                if(!$result)
                {
                    echo "Error : ".$sql."<br>".mysqli_error($conn);
                }
                $rows=mysqli_fetch_assoc($result);
            ?>
            <form method="post" name="tcredit" class="tabletext"><br>
                <div class="table-responsive-sm">
                    <table class="table table-striped table-condensed table-bordered">
                        <tr>
                            <th class="text-center">ID</th>
                            <th class="text-center">Name</th>
                            <th class="text-center">Email</th>
                            <th class="text-center">Balance</th>
                        </tr>
                        <tr>
                            <td class="py-2">
                                <?php echo $rows['id'] ?>
                            </td>
                            <td class="py-2"><b>
                                    <?php echo $rows['name'] ?><b></td>
                            <td class="py-2">
                                <?php echo $rows['email'] ?>
                            </td>
                            <td class="py-2">
                                <?php echo $rows['balance'] ?>
                            </td>
                        </tr>
                    </table>
                </div>
                <br><br><br>
                <label><b>Transfer To :</b></label>
                <select name="to" class="form-control" required>
                    <option value="" disabled selected>-- Please Select --</option>
                    <?php
                include 'config.php';
                $sid=$_GET['id'];
                $sql = "SELECT * FROM users where id!=$sid";
                $result=mysqli_query($conn,$sql);
                if(!$result)
                {
                    echo "Error ".$sql."<br>".mysqli_error($conn);
                }
                while($rows = mysqli_fetch_assoc($result)) {
            ?>
                    <option class="table" value="<?php echo $rows['id'];?>">

                        <?php echo $rows['name'] ;?> (Balance:
                        <?php echo $rows['balance'] ;?> )

                    </option>
                    <?php 
                } 
            ?>
                    <div>
                </select>
                <br>
                <br>
                <label><b> Amount :</b></label>
                <input type="number" class="form-control" name="amount" required>
                <br><br>
                <div class="text-center">
                    <button class="btn mt-3 btn-info" name="submit" type="submit">Transfer</button>
                </div>
            </form>
            <br>
        </div>
    </main>

    <link rel="stylesheet" href="css/footer.css?<?php echo date('l jS \of F Y h:i:s A'); ?>">
    <?php
include 'footer.php';
?>

</body>

</html>