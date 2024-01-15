<?php
    session_start();
    function callWebService($url){
        $curl = curl_init($url);
        curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
        $response= curl_exec($curl);
        curl_close($curl);
        return json_decode($response);
    }
    if(!isset($_SESSION['user'])){
        if($_SESSION['user'] != "admin"){
            header("Location: main.php");
            exit;
        }
    }
    if(isset($_SESSION['error'])){
        $error = $_SESSION['error'];
        echo "<script type='text/javascript'> alert('$error');</script>";
        unset($_SESSION['error']);
    }
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin Panel</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="admin.css">
    </head>
    <body>
        <div id="container">
            <div class="tab">        
                <button class="tablinks" onclick="openTab(event,'theatreTab')">Show Theatres</button>
                <button class="tablinks" onclick="openTab(event,'customerTab')">Show Customers</button>
                <button class="tablinks" onclick="openTab(event,'scheduleTab')">Show Schedules</button>
                <button class="tablinks" onclick="openTab(event,'movieTab')">Show Movie</button>
                <button class="tablinks" onclick="openTab(event,'bookingTab')">Show Booking</button>
                <button class="tablinks"><a href="asset/logout.php">Logout</a></button>
            </div> 
            <div id="theatreTab" class="tabcontent">
                <h3>Theatres Information</h3>
                <button type="button" class="btn btn-info btn-md" data-toggle="modal" data-target="#add-theatre">Add a theatre</button>
                <button type="button" class="btn btn-info btn-md" data-toggle="modal" data-target="#update-theatre">Update a theatre</button>
                <button type="button" class="btn btn-info btn-md" data-toggle="modal" data-target="#delete-theatre">Delete a theatre</button>
                <?php
                    $url = "http://localhost/admin/getTheatre.php";
                    $array = callWebService($url);
                    echo "<table border='1' >
                    <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Location</th>
                    <th>Num Room</th>
                    <tr>";
                    foreach ($array as $key => $value) {
                        echo "<tr>";
                        foreach ($value as $property => $propertyValue) {
                            echo "<td>$propertyValue</td>";
                        }
                        echo "</tr>";
                    }
                    echo "</table>"
                ?>
            </div>
            <div id="customerTab" class="tabcontent">
                <h3>Customers Information</h3>
                <button type="button" class="btn btn-info btn-md" data-toggle="modal" data-target="#add-customer">Add a customer</button>
                <button type="button" class="btn btn-info btn-md" data-toggle="modal" data-target="#update-customer">Update a customer</button>
                <button type="button" class="btn btn-info btn-md" data-toggle="modal" data-target="#delete-customer">Delete a customer</button>
                <?php
                    $url = 'http://localhost/admin/getCustomer.php';
                    $array = callWebService($url);
                    echo "<table border='1'>
                    <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Age</th>
                    <th>Sex</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Username</th>
                    <th>Password</th>
                    <tr>";
                    
                    foreach ($array as $key => $value) {
                        echo "<tr>";
                        foreach ($value as $property => $propertyValue) {
                            echo "<td>$propertyValue</td>";
                        }
                        echo "</tr>";
                    }
                    echo "</table>";
                ?>

            </div>
            <div id="scheduleTab" class="tabcontent">
                <h3>Schedules Information</h3>
                <button type="button" class="btn btn-info btn-md" data-toggle="modal" data-target="#add-schedules">Add Schedule</button>
                <button type="button" class="btn btn-info btn-md" data-toggle="modal" data-target="#update-schedules">Update a schedule</button>
                <button type="button" class="btn btn-info btn-md" data-toggle="modal" data-target="#delete-schedules">Delete a schedule</button>
                <?php
                    $url = "http://localhost/admin/getSchedule.php";
                    $array = callWebService($url);
                    echo "<table border='1'>
                    <tr>
                    <th>ScheduleID</th>       
                    <th>MovieID</th>
                    <th>theatreID</th>
                    <th>ShowDate</th>
                    <th>ShowTime</th>
                    <th>Room</th>
                    <tr>";
                    foreach ($array as $key => $value) {
                        echo "<tr>";
                        foreach ($value as $property => $propertyValue) {
                            echo "<td>$propertyValue</td>";
                        }
                        echo "</tr>";
                    }
                    echo "</table>";
                ?>

            </div>
            <div id="movieTab" class="tabcontent">
                <h3>Movies Information</h3>
                <button type="button" class="btn btn-info btn-md" data-toggle="modal" data-target="#add-movie">Add Movie</button>
                <button type="button" class="btn btn-info btn-md" data-toggle="modal" data-target="#update-movie">Update a movie</button>
                <button type="button" class="btn btn-info btn-md" data-toggle="modal" data-target="#delete-movie">Delete a movie</button>
                <?php
                    $url = "http://localhost/admin/getMovie.php";
                    $array = callWebService($url);
                    echo "<table border='1'>
                    <tr>
                    <th>MovieID</th>
                    <th>Name</th>
                    <th>Directors</th>
                    <th>Actors</th>
                    <th>Genre 1</th>
                    <th>Genre 2</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th>Trailer</th>
                    <tr>";
                    foreach ($array as $key => $value) {
                        echo "<tr>";
                        foreach ($value as $property => $propertyValue) {
                            echo "<td>$propertyValue</td>";
                        }
                        echo "</tr>";
                    }
                    echo "</table>";
                ?>

            </div>
        </div>
        <div id="bookingTab" class="tabcontent">
                <h3>Booking Information</h3>
                <button type="button" class="btn btn-info btn-md" data-toggle="modal" data-target="#add-booking">Add Booking</button>
                <button type="button" class="btn btn-info btn-md" data-toggle="modal" data-target="#update-booking">Update a booking</button>
                <button type="button" class="btn btn-info btn-md" data-toggle="modal" data-target="#delete-booking">Delete a booking</button>
                <?php
                    $url = "http://localhost/admin/getBooking.php";
                    $array = callWebService($url);
                    echo "<table border='1'>
                    <tr>
                    <th>bookID</th>
                    <th>CusID</th>
                    <th>scheduleID</th>
                    <th>Ticket2D</th>
                    <th>Ticket3D</th>
                    <th>Ticket4D</th>
                    <th>price</th>
                    <th>Popcorn</th>
                    <th>Soda</th>
                    <th>Combo</th>
                    <tr>";
                    foreach ($array as $key => $value) {
                        echo "<tr>";
                        foreach ($value as $property => $propertyValue) {
                            echo "<td>$propertyValue</td>";
                        }
                        echo "</tr>";
                    }
                    echo "</table>";
                ?>

            </div>
        </div>
        
        <div class="modal fade" id="add-theatre">
            <div class="modal-dialog">
            <div class="modal-content">
            
                <div class="modal-header">
                <h4 class="modal-title">Add a theatre</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form method="post" action="admin/addTheatre.php">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="Tname">Name</label>
                        <input type="text" placeholder="Theatre Name" class="form-control" id="Tname" name="Tname"/>
                    </div>
                    <div class="form-group">
                        <label for="location">Location</label>
                        <input type="text" placeholder="Theatre Location" class="form-control" id="location" name="location">
                    </div>
                    <div class="form-group">
                        <label for="nroom">numRoom</label>
                        <input type="number" value="0" class="form-control" id="nroom" name="nroom">
                    </div>
                </div>
                
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Save</button>
                </div>
                </form>            
                </div>
            </div>
        </div>
        <div class="modal fade" id="update-theatre">
            <div class="modal-dialog">
            <div class="modal-content">
            
                <div class="modal-header">
                <h4 class="modal-title">Update a theatre</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form method="post" action="admin/updateTheatre.php">
                <div class="modal-body">
                <div class="form-group">
                        <label for="tID">Theatre</label>
                        <input type="number" class="form-control" id="tID" name="tID"/>
                    </div>
                    <div class="form-group">
                        <label for="Tname">Name</label>
                        <input type="text" placeholder="Theatre Name" class="form-control" id="Tname" name="Tname"/>
                    </div>
                    <div class="form-group">
                        <label for="location">Location</label>
                        <input type="text" placeholder="Theatre Location" class="form-control" id="location" name="location">
                    </div>
                    <div class="form-group">
                        <label for="nroom">numRoom</label>
                        <input type="number" value="0" class="form-control" id="nroom" name="nroom">
                    </div>
                </div>
                
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Save</button>
                </div>
                </form>            
                </div>
            </div>
        </div>
        <div class="modal fade" id="add-movie">
            <div class="modal-dialog">
            <div class="modal-content">
            
                <div class="modal-header">
                <h4 class="modal-title">Add a movie</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form method="post" action="admin/addMovie.php" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="Mname">Name</label>
                        <input type="text" placeholder="Movie Name" class="form-control" id="Mname" name="Mname"/>
                    </div>
                    <div class="form-group">
                        <label for="director">Directors</label>
                        <input type="text" placeholder="The directors of the movie" class="form-control" id="director" name="director">
                    </div>
                    <div class="form-group">
                        <label for="actors">Actors</label>
                        <input type="text" placeholder="The actors of the movie" class="form-control" id="actors" name="actors">
                    </div>
                    <div class="form-group">
                        <label for="genre1">Genre 1</label>
                        <input type="text" placeholder="The first genre of the movie" class="form-control" id="genre1" name="genre1">
                    </div>
                    <div class="form-group">
                        <label for="genre2">Genre 2</label>
                        <input type="text" placeholder="The second genre of the movie" class="form-control" id="genre2" name="genre2">
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <br>
                        <textarea name="description" id="description" cols="60" rows="5"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="trailer">Trailer</label>
                        <input type="text" placeholder="Link to the movie trailer" class="form-control" id="trailer" name="trailer">
                    </div>
                    <div class="form-group">
                        <label for="image">Upload an image for the movie</label>
                        <input type="file" name="image" id="image">
                    </div>
                </div>
                
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Save</button>
                </div>
                </form>            
                </div>
            </div>
        </div>
        <div class="modal fade" id="add-schedules">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h4 class="modal-title">Add a schedule</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form method="post" action="admin/addSchedule.php" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="mID">Movie ID</label>
                        <input type="number" class="form-control" id="mID" name="mID"/>
                    </div>
                    <div class="form-group">
                        <label for="tID">Theatre ID</label>
                        <input type="number" class="form-control" id="tID" name="tID">
                    </div>
                    <div class="form-group">
                        <label for="dmovie">Date</label>
                        <input type="date" id="dmovie" name="dmovie">
                    </div>
                    <div class="form-group">
                        <label for="tmovie">Time</label>
                        <input type="time" id="tmovie" name="tmovie">
                    </div>
                    <div class="form-group">
                        <label for="room">Room</label>
                        <input type="text" placeholder="Enter the room number" class="form-control" id="room" name="room">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Save</button>
                </div>
                </form>            
                </div>
            </div>
        </div>
        <div class="modal fade" id="update-schedules">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h4 class="modal-title">Update a schedule</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form method="post" action="admin/updateSchedule.php" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="sID">Schedule ID</label>
                        <input type="number" class="form-control" id="sID" name="sID"/>
                    </div>
                    <div class="form-group">
                        <label for="mID">Movie ID</label>
                        <input type="number" class="form-control" id="mID" name="mID"/>
                    </div>
                    <div class="form-group">
                        <label for="tID">Theatre ID</label>
                        <input type="number" class="form-control" id="tID" name="tID">
                    </div>
                    <div class="form-group">
                        <label for="dmovie">Date</label>
                        <input type="date" id="dmovie" name="dmovie">
                    </div>
                    <div class="form-group">
                        <label for="tmovie">Time</label>
                        <input type="time" id="tmovie" name="tmovie">
                    </div>
                    <div class="form-group">
                        <label for="room">Room</label>
                        <input type="text" placeholder="Enter the room number" class="form-control" id="room" name="room">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Save</button>
                </div>
                </form>            
                </div>
            </div>
        </div>
        <div class="modal fade" id="add-customer">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h4 class="modal-title">Add a Customer</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form method="post" action="admin/addCustomer.php" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" placeholder="Enter the name" class="form-control" id="name" name="name">
                    </div>
                    <div class="form-group">
                        <label for="age">Age</label>
                        <input type="number" class="form-control" id="age" name="age">
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="number" id="phone" name="phone">
                    </div>
                    <div class="form-group">
                        <select name="sex" id="sex">
                        <option value="" selected disabled>Gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                       </select>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" placeholder="Enter the email" class="form-control" id="email" name="email">
                    </div>
                    <div class="form-group">
                        <label for="address">Address</label>
                        <input type="text" placeholder="Enter the address" class="form-control" id="address" name="address">
                    </div>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" placeholder="Enter the username" class="form-control" id="username" name="username">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="text" placeholder="Enter the password" class="form-control" id="password" name="password">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Save</button>
                </div>
                </form>            
                </div>
            </div>
        </div>
        <div class="modal fade" id="update-customer">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h4 class="modal-title">Update a Customer</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form method="post" action="admin/updateCustomer.php" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="cID">cID </label>
                        <input type="number" class="form-control" id="cID" name="cID"/>
                    </div>
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" placeholder="Enter the name" class="form-control" id="name" name="name"/>
                    </div>
                    <div class="form-group">
                        <label for="age">Age</label>
                        <input type="number" class="form-control" id="age" name="age">
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="number" id="phone" name="phone">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" placeholder="Enter the email" class="form-control" id="email" name="email">
                    </div>
                    <div class="form-group">
                        <label for="address">Address</label>
                        <input type="text" placeholder="Enter the address" class="form-control" id="address" name="address">
                    </div>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" placeholder="Enter the username" class="form-control" id="username" name="username">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="text" placeholder="Enter the password" class="form-control" id="password" name="password">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Save</button>
                </div>
                </form>            
                </div>
            </div>
        </div>
        <div class="modal fade" id="add-booking">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h4 class="modal-title">Add a booking</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form method="post" action="admin/addBooking.php" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="cID">cID </label>
                        <input type="number" class="form-control" id="cID" name="cID"/>
                    </div>
                    <div class="form-group">
                        <label for="sID">scheduleID</label>
                        <input type="number" class="form-control" id="sID" name="sID"/>
                    </div>
                    <div class="form-group">
                        <label for="t2">Ticket2D</label>
                        <input type="number" class="form-control" id="t2" name="t2">
                    </div>
                    <div class="form-group">
                        <label for="t3">Ticket3D</label>
                        <input type="number" class="form-control" id="t3" name="t3">
                    </div>
                    <div class="form-group">
                        <label for="t4">Ticket4D</label>
                        <input type="number" class="form-control" id="t4" name="t4">
                    </div>
                    <div class="form-group">
                        <label for="total">Total Price</label>
                        <input type="number" class="form-control" id="total" name="total">
                    </div>
                    <div class="form-group">
                        <label for="popcorn">Popcorn</label>
                        <input type="number" class="form-control" id="popcorn" name="popcorn">
                    </div>
                    <div class="form-group">
                        <label for="soda">Soda</label>
                        <input type="number" class="form-control" id="soda" name="soda">
                    </div>
                    <div class="form-group">
                        <label for="combo">Combo</label>
                        <input type="number" class="form-control" id="combo" name="combo">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Save</button>
                </div>
                </form>            
                </div>
            </div>
        </div>
        <div class="modal fade" id="update-booking">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h4 class="modal-title">Add a booking</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form method="post" action="admin/updateBooking.php" enctype="multipart/form-data">
                <div class="modal-body">
                <div class="form-group">
                        <label for="bID">Booking ID </label>
                        <input type="number" class="form-control" id="bID" name="bID"/>
                    </div>
                    <div class="form-group">
                        <label for="cID">cID </label>
                        <input type="number" class="form-control" id="cID" name="cID"/>
                    </div>
                    <div class="form-group">
                        <label for="sID">scheduleID</label>
                        <input type="number" class="form-control" id="sID" name="sID"/>
                    </div>
                    <div class="form-group">
                        <label for="t2">Ticket2D</label>
                        <input type="number" class="form-control" id="t2" name="t2">
                    </div>
                    <div class="form-group">
                        <label for="t3">Ticket3D</label>
                        <input type="number" class="form-control" id="t3" name="t3">
                    </div>
                    <div class="form-group">
                        <label for="t4">Ticket4D</label>
                        <input type="number" class="form-control" id="t4" name="t4">
                    </div>
                    <div class="form-group">
                        <label for="total">Total Price</label>
                        <input type="number" class="form-control" id="total" name="total">
                    </div>
                    <div class="form-group">
                        <label for="popcorn">Popcorn</label>
                        <input type="number" class="form-control" id="popcorn" name="popcorn">
                    </div>
                    <div class="form-group">
                        <label for="soda">Soda</label>
                        <input type="number" class="form-control" id="soda" name="soda">
                    </div>
                    <div class="form-group">
                        <label for="combo">Combo</label>
                        <input type="number" class="form-control" id="combo" name="combo">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Save</button>
                </div>
                </form>            
                </div>
            </div>
        </div>
        <div class="modal fade" id="update-movie">
            <div class="modal-dialog">
            <div class="modal-content">
            
                <div class="modal-header">
                <h4 class="modal-title">Update a movie</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form method="post" action="admin/updateMovie.php" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="mID">Movie ID</label>
                        <input type="number" class="form-control" id="mID" name="mID">
                     </div>
                    <div class="form-group">
                        <label for="Mname">Name</label>
                        <input type="text" placeholder="Movie Name" class="form-control" id="Mname" name="Mname"/>
                    </div>
                    <div class="form-group">
                        <label for="director">Directors</label>
                        <input type="text" placeholder="The directors of the movie" class="form-control" id="director" name="director">
                    </div>
                    <div class="form-group">
                        <label for="actors">Actors</label>
                        <input type="text" placeholder="The actors of the movie" class="form-control" id="actors" name="actors">
                    </div>
                    <div class="form-group">
                        <label for="genre1">Genre 1</label>
                        <input type="text" placeholder="The first genre of the movie" class="form-control" id="genre1" name="genre1">
                    </div>
                    <div class="form-group">
                        <label for="genre2">Genre 2</label>
                        <input type="text" placeholder="The second genre of the movie" class="form-control" id="genre2" name="genre2">
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <br>
                        <textarea name="description" id="description" cols="60" rows="5"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="trailer">Trailer</label>
                        <input type="text" placeholder="Link to the movie trailer" class="form-control" id="trailer" name="trailer">
                    </div>
                    <div class="form-group">
                        <label for="image">Upload an image for the movie</label>
                        <input type="file" name="image" id="image">
                    </div>
                </div>
                
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Save</button>
                </div>
                </form>            
                </div>
            </div>
        </div>
        <div class="modal fade" id="delete-movie">
            <div class="modal-dialog">
            <div class="modal-content">
            
                <div class="modal-header">
                <h4 class="modal-title">Delete a movie</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form method="post" action="admin/deleteMovie.php" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="mID">Movie ID</label>
                        <input type="number" class="form-control" id="mID" name="mID">
                     </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Save</button>
                </div>
                </form>            
                </div>
            </div>
        </div>
        <div class="modal fade" id="delete-customer">
            <div class="modal-dialog">
            <div class="modal-content">
            
                <div class="modal-header">
                <h4 class="modal-title">Delete a customer</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form method="post" action="admin/deleteCustomer.php" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="cID">Customer ID</label>
                        <input type="number" class="form-control" id="cID" name="cID">
                     </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Save</button>
                </div>
                </form>            
                </div>
            </div>
        </div>
        <div class="modal fade" id="delete-schedules">
            <div class="modal-dialog">
            <div class="modal-content">
            
                <div class="modal-header">
                <h4 class="modal-title">Delete a schedule</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form method="post" action="admin/deleteSchedule.php" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="sID">Schedule ID</label>
                        <input type="number" class="form-control" id="sID" name="sID">
                     </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Save</button>
                </div>
                </form>            
                </div>
            </div>
        </div>
        <div class="modal fade" id="delete-theatre">
            <div class="modal-dialog">
            <div class="modal-content">
            
                <div class="modal-header">
                <h4 class="modal-title">Delete a theatre</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form method="post" action="admin/deleteTheatre.php" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="tID">Theatre ID</label>
                        <input type="number" class="form-control" id="tID" name="tID">
                     </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Save</button>
                </div>
                </form>            
                </div>
            </div>
        </div>
        <div class="modal fade" id="delete-booking">
            <div class="modal-dialog">
            <div class="modal-content">
            
                <div class="modal-header">
                <h4 class="modal-title">Delete a booking</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form method="post" action="admin/deleteBooking.php" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="bID">Booking ID</label>
                        <input type="number" class="form-control" id="bID" name="bID">
                     </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Save</button>
                </div>
                </form>            
                </div>
            </div>
        </div>
        <script src="admin.js"></script>
    </body>
</html>