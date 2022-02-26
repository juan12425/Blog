<?php
session_start()
?>


<!DOCTYPE html>
<html>
<title>Filósofos</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="styles.css">
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lobster">





<style>
.mySlides {display:none;}
</style>


<body class="body40">


<?php 
    include_once 'header2.php';
?>



<div class="w3-content w3-display-container" style="margin-top: 2%;">
  <img class="mySlides" src="i/filo.png" style="max-width: 100%; height: auto;">
  <img class="mySlides" src="i/cita2.png" style="width:100%; height: auto;">
  

  <button class="w3-button w3-black w3-display-left" onclick="plusDivs(-1)">&#10094;</button>
  <button class="w3-button w3-black w3-display-right" onclick="plusDivs(1)">&#10095;</button>
</div>




<div class="float-container" style="margin-top: 10%;">

  <div class="float-child">
        <h2 class="h35">Michel Foucault</h2>
        <img src="i/f.jpg" alt="foucault" class="foucault3">
       
        
  </div>
  
  <div class="float-child2">
    <h2 class="h35">Friedrich Nietzsche</h2>
      <img src="i/0.jpg" alt="Sócrates" class="foucault3">

  </div>
  
</div>





<div class="float-container" style="margin-top: 70%;">

  <div class="float-child">
        <h2 class="h35">Heidegger</h2>
        <img src="i/heidegger.jpg" alt="foucault" class="foucault3">
       
        
  </div>
  
  <div class="float-child2">
    <h2 class="h35">Sócrates/Platón</h2>
      <img src="i/sócrates2.jpg" alt="Sócrates" class="foucault3">

  </div>
  
</div>

<div class="float-container" style="margin-top: 70%;">

  <div class="float-child">
        <h2 class="h35">Voltaire</h2>
        <img src="i/04.png" alt="foucault" class="foucault3">
       
        
  </div>
  
  <div class="float-child2">
    <h2 class="h35">Marco Aurelio</h2>
      <img src="i/marco_aurelio_0.jpg" alt="Sócrates" class="foucault3">

  </div>
  
</div>





<script>
var slideIndex = 1;
showDivs(slideIndex);

function plusDivs(n) {
  showDivs(slideIndex += n);
}

function showDivs(n) {
  var i;
  var x = document.getElementsByClassName("mySlides");
  if (n > x.length) {slideIndex = 1}
  if (n < 1) {slideIndex = x.length}
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";  
  }
  x[slideIndex-1].style.display = "block";  
}
</script>

</body>
</html>
