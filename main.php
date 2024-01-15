<?php
    session_start();
    function callWebService($url){
        $curl = curl_init($url);
        curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
        $response= curl_exec($curl);
        curl_close($curl);
        return json_decode($response);
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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="main_style.css">
    <title>Cinema</title>
</head>
<body>
    <div class="wrapper">
        <div class="header">
            <div id="h1-logo"><a href="main.php" id="link-logo"><h1 id="logo">PnguinsCine</h1></a></div>
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
                        <form action="asset/customer-information.php" method="post">
                            <input type="hidden" name="cID" value="'.$_SESSION['cID'].'">
                            <button type="submit" class="icon-custom"><i class="fa fa-history"></i></button>
                        </form>
                    </div>';
                } else {
                    echo '<div><button class="icon-custom" id="log-btn"><i class="fa fa-user-circle-o" ></i></button></div>';
                }
                ?>

                <!-- deal -->
                <div><a href="#deals"><button class="icon-custom"><i class="fa fa-ticket" ></i></button></a></div>
            </div>
        </div>

        <div class="content">
            <div class="carousel-container">
                <h1 id="tabs">Now Showing</h1>
                <div class="carousel" id="movie">
                    <?php
                        $url="http://localhost/admin/getMovie.php";
                        $array = callWebService($url);
                        $movie = array_reverse($array,true);
                        foreach ($movie as $key=> $value){
                            echo "<div class='carousel-item'>
                                <a href='asset/getDetails.php?id=$value->movieID'>
                                <img src='images/$value->image' alt='$value->image'>
                                </a>
                                <h3>$value->Name </h3>
                                <p>Directors: $value->Directors </p>
                                <p>Stars: $value->Actors</p>
                                <div class='genre-boxes'> 
                                    <div class='genre-box'>$value->Genre1 </div>
                                    <div class='genre-box'>$value->Genre2 </div>
                                </div>
                                </div> ";         
                        }
                    ?>
                    <button class="carousel-button carousel-button-left">&#8249;</button> 
                    <button class="carousel-button carousel-button-right">&#8250;</button>    
                </div>
            </div>
            <div class="carousel-container">  
                <h1 id="tabs">What's New?</h1>
                <div class="carousel" id="news">
                    <?php
                        $url = "http://localhost/admin/getMovie.php";
                        $array = callWebService($url);
                        shuffle($array);
                        foreach ($array as $key=> $value){
                            echo "<div class='carousel-item'>
                                <a href='asset/getDetails.php?id=$value->movieID'>
                                <img src='images/$value->image' alt='$value->image'>
                                </a>
                                <h3>$value->Name </h3>
                                <p>Directors: $value->Directors </p>
                                <p>Stars: $value->Actors</p>
                                <div class='genre-boxes'> 
                                    <div class='genre-box'>$value->Genre1 </div>
                                    <div class='genre-box'>$value->Genre2 </div>
                                </div>
                                </div> ";
                        }
                    ?>
                    <button class="carousel-button carousel-button-left">&#8249;</button>
                    <button class="carousel-button carousel-button-right">&#8250;</button>
                </div>
            </div> 
            <div id="deals">  
                <h1 id="tabs">Hot Deals</h1>
                <div id="deal">
                    <div class='carousel-item'>
                            <img src='images/summer-deals.png' alt=''>
                            <h3>Summer Movie Deals </h3>
                            <p>Buy 1 Ticket and get the second for 2$ or less </p>
                        </div>
                    </div>
                </div>
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
        <footer>
        <div class="footer-column">
            <h3>About Us</h3>
            <p>This is our Movie Booking website. Our aim is to help the user book their favorite movie with ease. We have 2 member Nguyễn Duy Anh, Đỗ Tuấn Kiệt</p>
        </div>
        <div class="footer-column">
            <h3>Contact Us</h3>
            <p>13 Nguyễn Hữu Thọ, Quận 7</p>
            <p>HCMC, Việt Nam</p>
            <p>Email: 521K0126@student.tdtu.edu.vn</p>
            <p>Email: 521K0182@student.tdtu.edu.vn</p>
        </div>
        </footer>
        <script src="main.js"></script>
</body>
</html>