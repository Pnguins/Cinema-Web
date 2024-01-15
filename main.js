  // get all carousels
  const carousels = document.querySelectorAll('.carousel');

  // loop through each carousel and add event listeners for buttons
  carousels.forEach((carousel) => {
  const carouselLeft = carousel.querySelector('.carousel-button-left');
  const carouselRight = carousel.querySelector('.carousel-button-right');

  carouselLeft.addEventListener('click', () => {
      carousel.scrollLeft -= carousel.offsetWidth;
  });

  carouselRight.addEventListener('click', () => {
      carousel.scrollLeft += carousel.offsetWidth;
  });
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




