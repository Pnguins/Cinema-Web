<?php
session_start();
require_once('../admin/connection.php');
function callWebService($url){
    $curl = curl_init($url);
    curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
    $response= curl_exec($curl);
    curl_close($curl);
    return json_decode($response);
}
$cID = $_SESSION['cID'];
$url="http://localhost/admin/getCustomer.php?cusID=$cID";
$array = callWebService($url);
$cus = $array[0];
$url = "http://localhost/admin/getBooking.php?cID=$cID";
$book = callWebService($url);
$book = array_reverse($book,true);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="infor.css">
    <title>Customer-Information</title>
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
                <div><button type="submit" form="search-form" class="icon-custom" disabled><i class="fa fa-search"></i></button></div>
                <!-- user -->
                <?php
                    echo '<div>
                             <form action="customer-information.php" method="post">
                                 <input type="hidden" name="cID" value="'.$_SESSION['cID'].'">
                                 <button type="submit" class="icon-custom"><i class="fa fa-history"></i></button>
                             </form>
                         </div>';
                ?>
                <!-- deal -->
                <div><button class="icon-custom"><i class="fa fa-ticket" ></i></button></div>
            </div>
        </div>
        <div class="content">
            <div class="column">
                <h2>Profile</h2>
                <ul>
                    <li>Name: <span><?php echo $cus->Name?></span></li>
                    <li>Age: <span><?php echo $cus->Age?></span></li>
                    <li>Gender: <span><?php echo $cus->Sex ?></span></li>
                    <li>Email: <span><?php echo $cus->Email ?></span></li>
                    <li>Phone: <span><?php echo $cus->Phone?></li>
                    <li>Address: <span><?php echo $cus->Address ?> </span> </li>
                </ul>
                <button id="changebtn">Change Information</button>
                <a href="logout.php"><button>Logout</button></a>
            </div>
            <div class="column">
                <h2>History</h2>
                <?php 
                    foreach($book as $key=>$value){
                        $url = "http://localhost/admin/getSchedule.php?scheduleID=$value->scheduleID";
                        $schedule = callWebService($url)[0];      
                        $url = "http://localhost/admin/getMovie.php?movieID=$schedule->movieID";
                        $movie = callWebService($url)[0];               
                        echo '<div class="book-history">
                        <h3><u>'.$movie->Name.'</u></h3>
                        <p>'.$schedule->ShowDate.'|'.$schedule->ShowTime.'</p>';
                        echo '<p> <strong>';
                        if($value->Ticket2D != 0){
                            echo "Ticket2D x ".$value->Ticket2D ." ";
                        }
                        if($value->Ticket3D != 0){
                            echo "Ticket3D x ".$value->Ticket3D ." ";
                        }
                        if($value->Ticket4D != 0){
                            echo "Ticket4D x ".$value->Ticket4D ." ";
                        }
                        echo '</strong></p>';
                        echo '</div>';
                    }
                ?>
            </div>
        </div>
    </div>
    <div id="change_infor" class="modal">
            <div class="modal-content">
                <div class="modal-header">
                    <h2>Change Information <span class="close" id="close2">&times;</span></h2>
                </div>
                <form action="changeInfor.php" method="post"> 
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
                    <?php
                        echo '<input type="hidden" id ="cID" name="cID" value="'.$_SESSION['cID'].'">';

                    ?>
                    <button id="regBtn">Change</button>
                </form> 
            </div>
    <script>
    function modalShow(modalid,btnid,close){
        // Get the modal
        var modal = document.getElementById(modalid);
    
        // Get the button that opens the modal
        var btn = document.getElementById(btnid);
    
        // Get the <span> element that closes the modal
        var span = document.getElementById(close);
    
        // When the user clicks the button, open the modal 
        btn.onclick = function()  {
        modal.style.display = "block";
        }
    
        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
        modal.style.display = "none";
        }
    }
    modalShow("change_infor","changebtn","close2");
    const searchBar = document.getElementById("search");
    const searchSuggestions = document.getElementById("search-suggestions");

        // Add event listener for input changes on search bar
        searchBar.addEventListener("input", function() {
            // Clear any previous suggestions
            searchSuggestions.innerHTML = "";
        
            // Get user input
            const userInput = searchBar.value.toLowerCase().trim();
        
            // Check if input is empty
            if (!userInput) {
            return;
            }

            // Make API call to get suggestions
            const xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                const response = JSON.parse(this.responseText);
                // Display up to 5 suggestions
                for (let i = 0; i < Math.min(response.length, 5); i++) {
                const suggestion = response[i];
                const li = document.createElement("li");
                const a = document.createElement("a");
                a.href=  "http://localhost/asset/getDetails.php?id=" + suggestion.movieID;
                a.innerText = suggestion.Name;
                li.appendChild(a)
                searchSuggestions.appendChild(li);
                }
            }
            };
            xhr.open("GET", "http://localhost/asset/movieSearch.php?keyword=" + userInput);
            xhr.send();
        });
    </script>
</body>
</html>