// Get all elements with class="tabcontent" and hide them
var tabcontent = document.getElementsByClassName("tabcontent");
for (var i = 0; i < tabcontent.length; i++) {
  tabcontent[i].style.display = "none";
}

// Get all elements with class="tablinks" and add the "active" class to the first button
var tablinks = document.getElementsByClassName("tablinks");
tablinks[0].className += " active";

// When a tab button is clicked, open the corresponding tab content
function openTab(event, tabName) {
  // Hide all tab content
  for (var i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  
  // Remove the "active" class from all tab buttons
  for (var i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  
  // Show the clicked tab content and add the "active" class to the clicked tab button
  document.getElementById(tabName).style.display = "block";
  event.currentTarget.className += " active";
}
