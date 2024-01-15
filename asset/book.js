function minus(m,i){
    document.getElementById(m).addEventListener("click", function (){
        var value = document.getElementById(i).value;
        if (value == 0){
            value = 0;
        }
        else{
            value--;
        }
    
        document.getElementById(i).value = value;
     })
}
function plus(p,i){
    document.getElementById(p).addEventListener("click", function (){
        var value = document.getElementById(i).value;
        value++;
        document.getElementById(i).value = value;
     })
}
minus('minus-2','ticket-2d')
plus('plus-2','ticket-2d')

minus('minus-3','ticket-3d')
plus('plus-3','ticket-3d')

minus('minus-4','ticket-4d')
plus('plus-4','ticket-4d')

minus('minus-pop','popcorn')
plus('plus-pop','popcorn')

minus('minus-soda','soda')
plus('plus-soda','soda')

minus('minus-combo','combo')
plus('plus-combo','combo')

var form1 = document.querySelector('.content-1');
var form2 = document.querySelector('.content-2');
var form3 = document.querySelector('.content-3');
var form4 = document.querySelector('.content-4');

var next_btn_1 = document.getElementById('next-1');
var back_btn_2 = document.getElementById('back-2');
var next_btn_2 = document.getElementById('next-2');
var back_btn_3 = document.getElementById('back-3');
var next_btn_3 = document.getElementById('next-3');
var back_btn_4 = document.getElementById('back-4');

var step_2 = document.getElementById('step-2');
var step_3 = document.getElementById('step-3');
var step_4 = document.getElementById('step-4');

next_btn_1.addEventListener('click', function(){
    form2.style.display = "inline-flex";
    form1.style.display = "none";

    step_2.style.backgroundColor="rgb(228, 147, 147)";
    step_2.style.color = "rgb(44, 51, 51)";
})

back_btn_2.addEventListener('click', function(){
    form1.style.display = "inline-flex";
    form2.style.display = "none";

    step_2.style.color="rgb(228, 147, 147)";
    step_2.style.backgroundColor = "rgb(44, 51, 51)";
})

next_btn_2.addEventListener('click', function(){
    form3.style.display = "inline-flex";
    form2.style.display = "none";

    step_3.style.backgroundColor="rgb(228, 147, 147)";
    step_3.style.color = "rgb(44, 51, 51)";
})

back_btn_3.addEventListener('click', function(){
    form2.style.display = "inline-flex";
    form3.style.display = "none";

    step_3.style.color="rgb(228, 147, 147)";
    step_3.style.backgroundColor = "rgb(44, 51, 51)";
})

next_btn_3.addEventListener('click', function(){
    form4.style.display = "inline-flex";
    form3.style.display = "none";

    step_4.style.backgroundColor="rgb(228, 147, 147)";
    step_4.style.color = "rgb(44, 51, 51)";
})

back_btn_4.addEventListener('click', function(){
    form3.style.display = "inline-flex";
    form4.style.display = "none";

    step_4.style.color="rgb(228, 147, 147)";
    step_4.style.backgroundColor = "rgb(44, 51, 51)";
})
const ticketPrices = {
    "2d": 75000,
    "3d": 90000,
    "4d": 120000
  };
const fbPrices ={
    "popcorn" : 60000,
    "soda" : 30000,
    "combo" : 75000,
} 
  function updatePrices() {
    const ticket2d = document.getElementById("ticket-2d").value;
    const ticket3d = document.getElementById("ticket-3d").value;
    const ticket4d = document.getElementById("ticket-4d").value;
  
    const price2d = ticket2d * ticketPrices["2d"];
    const price3d = ticket3d * ticketPrices["3d"];
    const price4d = ticket4d * ticketPrices["4d"];

    if(ticket2d != 0){
      document.getElementById('total-2d').style.display = "block";
      document.getElementById("price-2d").innerHTML = price2d.toLocaleString('it-IT',{style:'currency',currency:'VND'});
    }
    else{
      document.getElementById('total-2d').style.display = "none";
    }
    if(ticket3d != 0){
      document.getElementById('total-3d').style.display = "block";
      document.getElementById("price-3d").innerHTML = price3d.toLocaleString('it-IT',{style:'currency',currency:'VND'});
    }
    else{
      document.getElementById('total-3d').style.display = "none";
    }
    if(ticket4d != 0){
      document.getElementById('total-4d').style.display = "block";
      document.getElementById("price-4d").innerHTML = price4d.toLocaleString('it-IT',{style:'currency',currency:'VND'});
    }
    else{
      document.getElementById('total-4d').style.display = "none";
    }

    const popcorn = document.getElementById("popcorn").value;
    const soda = document.getElementById("soda").value;
    const combo = document.getElementById("combo").value;

    const pricepop = popcorn * fbPrices["popcorn"];
    const pricesoda = soda * fbPrices["soda"];
    const pricecombo = combo * fbPrices["combo"];

    if(popcorn != 0){
      document.getElementById('total-pop').style.display = "block";
      document.getElementById("price-pop").innerHTML = pricepop.toLocaleString('it-IT',{style:'currency',currency:'VND'});
    }
    else{
      document.getElementById('total-pop').style.display = "none";
    }
    if(soda != 0){
      document.getElementById('total-soda').style.display = "block";
      document.getElementById("price-soda").innerHTML = pricesoda.toLocaleString('it-IT',{style:'currency',currency:'VND'});
    }
    else{
      document.getElementById('total-soda').style.display = "none";
    }
    if(combo != 0){
      document.getElementById('total-combo').style.display = "block";
      document.getElementById("price-combo").innerHTML = pricecombo.toLocaleString('it-IT',{style:'currency',currency:'VND'});
    }
    else{
      document.getElementById('total-combo').style.display = "none";
    }
    const total = price2d + price3d + price4d + pricecombo + pricepop +pricesoda;
    document.getElementById("total").innerHTML = total.toLocaleString('it-IT',{style:'currency',currency:'VND'});
    document.getElementById("total-price").value = total;
  }
  
  // Call updatePrices() whenever the user clicks the plus or minus button
  document.querySelectorAll("button[type='button']").forEach(function(button) {
    button.addEventListener("click", updatePrices);
  });
  
  // Call updatePrices() whenever the user manually changes the ticket quantity
  document.querySelectorAll("input[type='number']").forEach(function(input) {
    input.addEventListener("change", updatePrices);
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
  btn = document.getElementById('login-btn');
  if(btn){
    modalShow("login","login-btn","close1");
  }
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