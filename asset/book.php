<?php
session_start();
function callWebService($url){
    $curl = curl_init($url);
    curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
    $response= curl_exec($curl);
    curl_close($curl);
    return json_decode($response);
}
if(isset($_POST['select-date']) && isset($_POST['select-theatre']) && isset($_POST['select-time']) && isset($_POST['mID'])){
    $date = $_POST['select-date'];
    $tID = $_POST['select-theatre'];
    $time = $_POST['select-time'];
    $mID = $_POST['mID'];
    $url = "http://localhost/admin/getSchedule.php?ShowDate=" . $date . "&theatreID=" . $tID."&ShowTime=".$time."&movieID=".$mID;
    $array= callWebService($url);
    $schedule= $array[0];

    $url = "http://localhost/admin/getMovie.php?movieID=".$mID;
    $array = callWebService($url);
    $movie= $array[0];

    $url = "http://localhost/admin/getTheatre.php?theatreID=".$schedule->theatreID;
    $array = callWebService($url);
    $theatre= $array[0];

    $sID = $schedule->scheduleID;
}
else{
    header("Location: ../main.php");
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="book.css">
    <title>Tickets Booking</title>
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
        <div class="form_wrap">
            <div class="step">
                <div class="text" id="step-1">Ticket</div>
                <div>&#129130;</div>
                <div class="text" id="step-2">Food And Beverage</div>
                <div>&#129130;</i></div>
                <div class="text" id="step-3">Confirm</div>
                <div>&#129130;</div>
                <div class="text" id="step-4">Checkout</div>
            </div>
            <form action="addBooking.php" method="post">
                <div class="image">
                    <img src="../images/<?php echo $movie->image?>" class="poster">
                </div>
                <div class="interact">
                    <div class="form content-1">
                        <div class="container">
                            <h2>1. SELECT TICKET TYPES</h2>
                            <div class="content">
                                <ul>
                                    <li> ADULT-VIP 2D:
                                        <div>
                                            <span><button type="button" id="minus-2"><i class="fa fa-minus"></i></button></span>
                                        </div>
                                        <input type="number" value="0" max="10" min="0" id="ticket-2d" name="ticket-2d">
                                        <div>
                                            <span><button type="button" id="plus-2"><i class="fa fa-plus"></i></button></span>
                                        </div>
                                    </li>
                                    <li> ADULT-VIP 3D: 
                                        <div>
                                            <span><button type="button" id="minus-3"><i class="fa fa-minus"></i></button></span>
                                        </div>
                                        <input type="number" value="0" max="10" min="0" id="ticket-3d" name="ticket-3d">
                                        <div>
                                            <span><button type="button" id="plus-3"><i class="fa fa-plus"></i></button></span>
                                        </div>
                                    </li>
                                    <li> ADULT-VIP 4DX: 
                                        <div>
                                            <span><button type="button" id="minus-4"><i class="fa fa-minus"></i></button></span>
                                        </div>
                                        <input type="number" value="0" max="10" min="0" id="ticket-4d" name="ticket-4d">
                                        <div>
                                            <span><button type="button" id="plus-4"><i class="fa fa-plus"></i></button></span>
                                        </div>
                                    </li>
                                </ul>
                                <p>ADULT-VIP: 2D = 75.000VND | 3D = 90.000VND | 4DX = 120.000VND </p>
                                
                            </div>
                        </div>
                        <div class="navigation next">
                            <button type="button" id="next-1"><i>&#62;</i></button>
                        </div>
                    </div>
                    <div class="form content-2" style="display:none">
                        <div class="navigation back">
                            <button type="button" id="back-2"><i>&#60;</i></button>
                        </div>
                        <div class="container">
                            <h2>2.SELECT FOOD AND BEVERAGES</h2>
                            <div>
                                <div style="display:flex; justify-content: center;">
                                    <div class="fb_wrap">
                                        <img src="../images/popcorn.png" style="width:150px; height:200px;">
                                        <div>
                                        <input type="number" value="0" min="0" id="popcorn" name="popcorn">
                                        <button type="button" id="minus-pop"><i class="fa fa-minus"></i></button>
                                        <button type="button" id="plus-pop"><i class="fa fa-plus"></i></button>
                                        </div>
                                    </div>
                                    <div class="fb_wrap">
                                        <img src="../images/soda.jpg" style="width:150px; height:200px;">
                                        <div>
                                        <input type="number" value="0" min="0" id="soda" name="soda">
                                        <button type="button" id="minus-soda"><i class="fa fa-minus"></i></button>
                                        <button type="button" id="plus-soda"><i class="fa fa-plus"></i></button> 
                                        </div>
                                    </div>
                                    <div class="fb_wrap">
                                        <img src="../images/combo.jpg" style="width:150px; height:200px;">
                                        <div>
                                        <input type="number" value="0" min="0" id="combo" name="combo">
                                        <button type="button" id="minus-combo"><i class="fa fa-minus"></i></button>
                                        <button type="button" id="plus-combo"><i class="fa fa-plus"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <p>Popcorn = 60.000VND | Soda = 30.000VND | Combo = 75.000VND</p>
                            </div>
                        </div>    
                        <div class="navigation next">
                            <button type="button" id="next-2"><i>&#62;</i></button>
                        </div>
                    </div>
                    <div class="form content-3" style="display:none">
                        <div class="navigation back">
                            <button type="button" id="back-3"><i>&#60;</i></button>
                        </div>
                        <div class="container">
                            <h2>3.CONFIRMATION</h2>
                            <div class="content">
                                <p>Movie Name: <strong><?php echo $movie->Name?> </strong></p>
                                <p>Show Time: <strong><?php echo $schedule->ShowTime ?></strong></p>
                                <p>Location: <strong><?php echo $theatre->Location?></strong></p>
                                <p>Theatre: <strong><?php echo $theatre->Name?></strong> Room: <strong><?php echo $schedule->Room ?></strong></p>
                            </div>
                        </div>
                        <div class="navigation next">
                            <button type="button" id="next-3"><i>&#62;</i></button>
                        </div>
                    </div>
                    <div class="form content-4" style="display:none">
                        <div class="navigation back">
                            <button type="button" id="back-4"><i>&#60;</i></button>
                        </div>
                        <div class="container">
                            <h2>4.CHECKOUT AND PAYMENTS</h2>
                            <div class="content">
                                <p id="total-2d" style="display:none;">ADULT-VIP 2D = <span id="price-2d">0.000vnd</span></p>
                                <p id="total-3d" style="display:none;">ADULT-VIP 3D = <span id="price-3d">0.000vnd</span></p>
                                <p id="total-4d" style="display:none;">ADULT-VIP 4DX = <span id="price-4d">0.000vnd</span></p>
                                <p id="total-pop" style="display:none;">Popcorn = <span id="price-pop">0.000vnd </span> </p>
                                <p id="total-soda" style="display:none;">Soda = <span id="price-soda">0.000vnd </span> </p>
                                <p id="total-combo" style="display:none;">Combo = <span id="price-combo">0.000vnd </span> </p>
                                <p>Total = <span id="total"> </span></p>
                            </div>
                            <input type="hidden" id="total-price" name="total-price" value="0">
                            <input type="hidden" id="scheID" name="scheID" value="<?php echo $sID?>">
                            <?php
                            if(isset($_SESSION['cID'])){
                                echo '<input type="hidden" id="cusID" name="cusID" value="'.$_SESSION['cID'].'">
                                <button class="checkout" type="submit">CHECKOUT</button>';
                            }
                            else{
                                echo '<button type="button" id="login-btn">Log In</button>';
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div id="login" class="modal">
            <div class="modal-content">
                <div class="modal-header">
                    <h2>Log In <span class="close" id="close1">&times;</span></h2>
                </div>
                <form action="login.php" method="post">
                    <div class="input-icon">
                        <input type="text" id="username" name="username" placeholder="Username" class="form-input">
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
                <form action="reg.php" method="post"> 
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
    <script src="book.js" type="application/javascript"></script>
</body>
</html>