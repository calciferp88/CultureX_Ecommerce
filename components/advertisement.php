<style type="text/css">
    .slideshow-container {
  width: 100%;
  margin: auto;
}

/* The dots/bullets/indicators */
.dot {
  height: 15px;
  width: 15px;  
  margin: 0 2px;
  background-color: #bbb;
  border-radius: 50%;
  display: inline-block;
  transition: background-color 0.6s ease;
  display: none;
}

/* Fading animation */
.fade {
  -webkit-animation-name: fade;
  -webkit-animation-duration: 3s;
  animation-name: fade;
  animation-duration: 3s;
}

@-webkit-keyframes fade {
  from {opacity: .4} 
  to {opacity: 1}
}

@keyframes fade {
  from {opacity: .4} 
  to {opacity: 1}
}

/* On smaller screens, decrease text size */
@media only screen and (max-width: 300px) {
  .text {font-size: 11px}
}
</style>

<!-- default banner from cultureX -->
<div class="banner mySlides fade ">
    <img src="themes/img/hero-2.jpg" style="height: 522px; max-width: 100%; object-fit: cover;">
</div>  
<span class='dot'></span>

<!-- Get other advertisement Data -->
<?php 

    $thisday = date('Y-m-d');

    $selectadv = "SELECT * FROM advertisement 
                WHERE day1 = '$thisday' 
                OR    day2 = '$thisday'
                OR    day3 = '$thisday' LIMIT 10";

    $runadv = mysqli_query($connect, $selectadv);
    $countadv = mysqli_num_rows($runadv);

    // display data for each advertisement
    for ($adv=0;$adv<$countadv;$adv++)  
    {
      $rowadv = mysqli_fetch_array($runadv);
      $advid  = $rowadv['advertisementID'];
      $advimg = $rowadv['advertiseImage'];
      $advter = $rowadv['advertiserID'];

 ?>



<div class="banner mySlides fade ">
    <img src="<?php echo($advimg) ?>" style="height: 522px; max-width: 100%; object-fit: cover;">
</div>
<span class='dot'></span>

<?php } ?>

<!-- default banner from cultureX -->
<div class="banner mySlides fade ">
    <img src="themes/img/hero-4.jpg" style="height: 522px; max-width: 100%; object-fit: cover;">
</div>  
<span class='dot'></span>