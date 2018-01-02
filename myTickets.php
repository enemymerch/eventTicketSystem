<!DOCTYPE html>
<html lang="en">

<head>


    <?php
    // Loggin Control
    include 'C:/xampp/htdocs/src/myEvents.php';
    include 'C:/xampp/htdocs/src/memberLoginAuthentication.php';

    //TODO

    ?>

    <title>myticket</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>

<body>


<!-- NAVBAR  -->
<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="welcome_member.php">My Events</a>
        </div>
        <ul class="nav navbar-nav">
            <li class="active"><a href="welcome_member.php">Home</a></li>
            <li><a href="search_events.php">Events</a></li>

        </ul>

        <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <?php
                    if(!isset($_SESSION)){
                        session_start();
                    }
                    echo $_SESSION["USERNAME"];
                    ?>
                    <span class="glyphicon glyphicon-user"></a>
                <ul class="dropdown-menu">
                    <li><a href="edit_profile_php">Edit Profile</a></li>
                    <li><a href="logout.php">Log Out</a></li>
                </ul>
            </li>
        </ul>
    </div>
</nav>

<div class="container" style="margin-top: 10%;">
    <div class="row">
        <h2 class="text-info" style="text-align: center">Purchased Tickets</h2>
        <?php
        createPurchasedTable();
        ?>
    </div>
    <div class="col-xs-4 col-xs-offset-2">
        <h4 class="text-info"  style="text-align: center;">Give Back Purchase</h4>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
            <div class="form-group">
                <?php getPurchasedTicketsSelection(); ?>
                </br></br>
                <button type="submit" name="submit" value="deletePurchase" class="btn btn-default">Give Back</button>
            </div>
        </form>
    </div>
</div>


<footer style="margin-top: 20%">
</footer>
</body>
</html>