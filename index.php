<?php


include_once 'components/includes.php';
?>

    <!DOCTYPE html>
    <html lang=en xmlns="http://www.w3.org/1999/html">
    <?php
echo generateHead("Home");
?>

        <body>

            <?php
echo generateHeader()
?>
            <main>
                <br>
                <div class="hero-container">
                    <div class="ui text container">
                        <h1 class="ui huge header">Decorate your world</h1>
                        <a href="browse-paintings.php" class="ui huge orange button">Shop Now</a>
                    </div>
                </div>
                <h2 class="ui horizontal divider"><i class="tag icon"></i> Deals</h2>



                    <!-- Randy used stackable grid container. You'll have to figure this out later -->
                    <div class="ui cards centered">


                        <div class="ui card">
                            <div class="image">
                                <img src="images/art/works/square-medium/107050.jpg">
                            </div>


                            <div class="content">
                                <h4>Experience the sensuous pleasures of the French Rococco</h4>
                            </div>
                            <a class="ui bottom attached button" href="single-genre.php?GenreID=83">
                                <i class="info circle icon"></i> See More
                            </a>
                        </div>


                        <div class="ui card">

                            <div class="image">
                                <img src="images/art/works/square-medium/126010.jpg">

                            </div>


                            <div class="content">
                                <h4>Appeciate the quiet beauty of the Dutch Golden Age</h4>
                            </div>
                            <a class="ui bottom attached button" href="single-genre.php?GenreID=87">
                                <i class="info circle icon"></i> See More
                            </a>
                        </div>


                        <div class="ui card">
                            <div class="image">
                                <img src="images/art/works/square-medium/100030.jpg">
                            </div>


                            <div class="content">
                                <h4>Discover the glorious color of the Renaissance</h4>
                            </div>
                            <a class="ui bottom attached button" href="single-genre.php?GenreID=78">
                                <i class="info circle icon"></i> See More
                            </a>
                        </div>


                    </div>


                </main>
            <?php
            echo generateFooter();
            ?>
        </body>

    </html>
