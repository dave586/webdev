<?php
//based on subject

include_once 'components/includes.php';
include_once 'components/SingleGallery.php';


?>


<!DOCTYPE html>
<html lang=en xmlns="http://www.w3.org/1999/html">
<?php

$gallery = BusinessHelper::createObject(new SingleGallery(BusinessHelper::getConnection()));
echo generateHead($gallery->getName());


?>

<body>
<?php

echo generateHeader();
?>
<main>
<h2 class="ui horizontal divider"></h2>
<?php
echo $gallery->generateBanner();
?>
<div class="ui segment">
    <?php
    echo $gallery->generateGalleryHead();


    echo "<h2 class=\"ui horizontal divider\">contains following artwork</h2>  ";




    echo $gallery->generatePaintingList();


    ?>

</div>
<!-- <div id="map" style="width:100%;height:450px"></div>-->
<script>
    var lat =<?php  echo $gallery->generateLat()?>;

    var long =<?php  echo $gallery->generateLong(); BusinessHelper::closeAllConnection();?>;

    window.onload = function initMap() {
        var location = {lat: lat, lng: long};
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 15,
            center: location
        });
        var marker = new google.maps.Marker({
            position: location,
            map: map
        });
    }


</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCgZwWy83_GYQUkVM57bKjPAu9Vao508xw&callback=initMap">
</script>

</main>
<?php
echo generateFooter();
?>
</body>


</html>