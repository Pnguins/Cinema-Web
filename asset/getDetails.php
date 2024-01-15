<?php
session_start();
function callWebService($url){
    $curl = curl_init($url);
    curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
    $response= curl_exec($curl);
    curl_close($curl);
    return json_decode($response);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="detail.css">
    <title>Movie Details</title>
</head>
<body>
<div class="wrapper">
        <div class="header">
            <div id="h1-logo"><a href="../main.php" id="link-logo"> <h1 id="logo">PnguinsCine</h1></a></div>
            <div id="h1-search">
                <form action="post" id="search-form">
                <input type="text" id="search" placeholder="Search...">
                </form>
                <ul id="search-suggestions"></ul>
            </div>
            <div id="h1-icon">
                <div><button type="submit" form="search-form" class="icon-custom" disabled><i class="fa fa-search" ></i></button></div>
                <!-- user -->
                <?php
                if(isset($_SESSION['cID'])){ // check if user is logged in
                    echo '<div>
                        <form action="customer-information.php" method="post">
                            <input type="hidden" name="cID" value="'.$_SESSION['cID'].'">
                            <button type="submit" class="icon-custom"><i class="fa fa-history"></i></button>
                        </form>
                    </div>';
                } else {
                    echo '<div><button class="icon-custom" id="log-btn"><i class="fa fa-user-circle-o" ></i></button></div>';
                }
                ?>
                <!-- deal -->
                <div><button class="icon-custom"><i class="fa fa-ticket" ></i></button></div>
            </div>
        </div>
</div>
<?php
    // Get the movie ID from the query parameter
    $movieID = $_GET['id'];

    // Call your web service to retrieve the movie details based on the ID
    $url = "http://localhost/admin/getMovie.php?movieID=$movieID";
    $array = callWebService($url);
    $movie = $array[0];
    echo "<input type='hidden' id= 'movieID' value= '$movieID'>";
?>
    <div class="form-wrap">
        <div class="column image">
            <div>
                <img src="../images/<?php echo $movie->image ?>" alt="<?php echo $movie->image?>" id="">
                <br>
                <a href="<?php echo $movie->trailer ?>" target="_blank"><button id="trailer">TRAILER</button></a>
            </div>
        </div>
        <div class="column interact">
            <div >
                <h1 style="font-size:50px;"><?php echo $movie->Name?></h1>
                <div><u><b>Directors:</b></u> <?php echo $movie->Directors?></div>
                <p><u><b>Description:</b></u> <?php echo $movie->Description?></p>
                <p><u><b>Actors:</b></u> <?php echo $movie->Actors?> </p>
                <div class="genre-boxes">
                    <div class="genre-box"><?php echo $movie->Genre1?> </div>
                </div>
                <div class="genre-boxes">
                    <div class="genre-box"><?php echo $movie->Genre2?> </div>
                </div>
                <?php 
                    $url = "http://localhost/admin/getSchedule.php?movieID=$movieID";
                    $movie = callWebService($url);
                    echo "<form action='book.php' method='post'>";
                        echo "<select id='select-date' name='select-date' class='custom-select'>";
                        echo "<option value='' selected disabled> Date </option>";
                        foreach($movie as $key => $value){
                            echo "<option value='$value->ShowDate'> $value->ShowDate</option>";

                        }
                        echo "</select>";
                    ?>
                    <select name="select-theatre" id="select-theatre" class='custom-select'>
                        <option value="" selected disabled>Theatre</option>
                    </select>
                    <select name="select-time" id="select-time" class='custom-select'>
                        <option value="" selected disabled>Time</option>
                    </select>
                    <input type="hidden" id="mID" name="mID" value="<?php echo $movieID?>">
                    <button type="submit" class="book">Book</button>
                <?php    
                    echo "</form>";
                ?>
            </div>
        </div>
        <div id="login" class="modal">
            <div class="modal-content">
                <div class="modal-header">
                    <h2>Log In <span class="close" id="close1">&times;</span></h2>
                </div>
                <form action="asset/login.php" method="post">
                    <div class="input-icon">
                        <input type="text" id="uname" name="username" placeholder="Username" class="form-input">
                        <span><i class="fa fa-user icon"></i></span> 
                    </div>
                    <div class="input-icon">
                        <input type="password" id="password" name="password" placeholder="Password" class="form-input">
                        <span><i class="fa fa-key icon"></i></span>
                    </div>
                    <div>
                    <button id="logBtn">Log In</button>
                    <p>Don't have an account? <a href="#reg" id="reg-a">Click here</a></p>
                    </div>
                </form>
            </div>
        </div>
        <div id="reg" class="modal">
            <div class="modal-content">
                <div class="modal-header">
                    <h2>Register <span class="close" id="close2">&times;</span></h2>
                </div>
                <form action="asset/reg.php" method="post"> 
                    <div>       
                        <input type="text" id="name" name="name" placeholder="Your Name" class="reg-form">
                    </div>
                    <div>
                        <label for="age">Age: </label>
                        <input type="number" id="age" name="age" class="reg-form">
                    </div>
                    <div>
                        <input type="text" id="email" name="email" placeholder="Email" class="reg-form">
                    </div>
                    <div>
                        <input type="text" id="uname" name="uname" placeholder="Username" class="reg-form">
                    </div>
                    <div>
                    <input type="password" id="pword" name="pword" placeholder="Password" class="reg-form">
                    </div>
                    <div>
                        <label for="sex">Gender:</label>
                        <select name="sex" id="sex" class="reg-form">
                            <option value="" selected disabled></option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                            <option value="Other">Other</option>
                    </select>
                    </div>
                    <div>
                        <label for="phone">Phone Number:</label>
                        <input type="number" id="phone" name="phone" class="reg-form">
                    </div>
                    <div>
                        <label for="address">Address:</label>
                        <textarea name="address" id="address" cols="30" rows="1" class="reg-form" style="resize:none;">
                        </textarea>
                    </div>
                    <button id="regBtn">Register</button>
                </form>
                    <p>Already have an account? <a href="#login" id="log-a">Click here</a></p>
                
            </div>
        </div>
    </div>
    <script src="details.js"></script>
</body>
</html>