document.getElementById("select-date").addEventListener("change", function(){
  var date = document.getElementById('select-date').value;
  var mID = document.getElementById('movieID').value;
  var xhr1 = new XMLHttpRequest();
  xhr1.onreadystatechange = function(){
      if (this.readyState == 4 && this.status == 200) {
          var scheduleResponse = JSON.parse(this.responseText);

          // make a call to the second API to get theatre data
          var xhr2 = new XMLHttpRequest();
          xhr2.onreadystatechange = function(){
              if (this.readyState == 4 && this.status == 200) {
                  var theatreResponse = JSON.parse(this.responseText);

                  var theatresel = document.getElementById("select-theatre");
                  theatresel.innerHTML = "<option value='' selected disabled>Theatre</option>";
                  for (var i = 0; i < scheduleResponse.length; i++){
                      var show = scheduleResponse[i];
                      if (show.ShowDate === date && show.movieID === mID) {
                          for (var j = 0; j < theatreResponse.length; j++) {
                              var theatre = theatreResponse[j];
                              if (show.theatreID === theatre.theatreID) {
                                  var option = document.createElement("option");
                                  option.value = theatre.theatreID;
                                  option.text = theatre.Name;
                                  theatresel.add(option);
                              }
                          }
                      }
                  }
              }
          };
          xhr2.open("GET", "http://localhost/admin/getTheatre.php");
          xhr2.send();
      }
  };
  xhr1.open("GET", "http://localhost/admin/getSchedule.php?ShowDate="  + date + "&movieID=" + mID);
  xhr1.send();
});
  document.getElementById("select-theatre").addEventListener("change", function(){
      var date = document.getElementById('select-date').value;
      var theatreID = document.getElementById('select-theatre').value;
      var mID = document.getElementById('movieID').value;
      
      // make a call to the third API to get the available seats data
      var xhr = new XMLHttpRequest();
      xhr.onreadystatechange = function(){
          if (this.readyState == 4 && this.status == 200) {
              var response = JSON.parse(this.responseText);

              var timesel = document.getElementById('select-time');
              timesel.innerHTML = "<option value='' selected disabled>Time</option>";
              for (var i = 0; i < response.length; i++){
                  if (response[i].ShowDate === date) {
                      var option = document.createElement("option");
                      option.value = response[i].ShowTime;
                      option.text = response[i].ShowTime;
                      timesel.add(option);
                  }
              }
          }
      };
      xhr.open("GET", "http://localhost/admin/getSchedule.php?ShowDate=" + date + "&theatreID=" + theatreID + "&movieID=" + mID);
      xhr.send();
  });
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
  function linkModal(modalid,aid,close,currmodalid){
        // Get the modal
        var modal = document.getElementById(modalid);
        var currmodal = document.getElementById(currmodalid);
        // Get the button that opens the modal
        var btn = document.getElementById(aid);
      
        // Get the <span> element that closes the modal
        var span = document.getElementById(close);
      
        // When the user clicks the button, open the modal 
        btn.onclick = function()  {
          modal.style.display = "block";
          currmodal.style.display = "none";
        }
      
        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
          modal.style.display = "none";
        }
  }
  login = document.getElementById('log-btn');
  if(login){
    modalShow("login","log-btn","close1");
    linkModal("login","log-a","close1","reg");
    linkModal("reg","reg-a","close2","login");
  }