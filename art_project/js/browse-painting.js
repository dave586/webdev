/* global $ */

//javascript for browse-paintings.php on page load

$(document).ready(function() {
    var form = $(".field select");
    var paintings = $(".ui .items");
    var baseURL = "service-painting.php?";
    var cartArray = null;
    var favArray = null;
    var firstLoad = true;

    //adds change events to each select for artists, museums, and shapes and passes the query string parameter for each.
    addChangeEvents(form[0], "artist");
    addChangeEvents(form[1], "museum");
    addChangeEvents(form[2], "shape");

    //initializes the page for first load, generating the default painting list sorted by year of work.
    init_page();

    //adds change events
    function addChangeEvents(form, urlParam) {
        form.addEventListener("change", function(e) {
            //functionality for selecting default options and resetting when a second <option> is selected.
            var selectedIndex = e.target.selectedIndex;
            //Reset the other options
            document.getElementById("artist-dropdown").selectedIndex = 0;;
            document.getElementById("museum-dropdown").selectedIndex = 0;
            document.getElementById("shape-dropdown").selectedIndex = 0;
            e.target.selectedIndex = selectedIndex;
            //builds url using base service-painting.php web service and adds query string parameters
            var url = baseURL + urlParam + "=" + e.target.value;



            //retrieves JSON data using web  service
            $.get(url)
                .done(function(data) {
                    //generates paintings list given JSON data using loadPaintings function
                    loadPaintings(data);
                });

        });
    }
    //function used to generate image hovers
    addHovers();


    //function used to remove old paintings list and add new using Semantics UI slide transitions
    function transitionPaintings(paintings) {
        paintings.dimmer('show');
        if (firstLoad) {
            paintings.hide();
            firstLoad = false;
        }
        else
            paintings.transition('slide left');
        paintings.empty();
        return paintings;
    }

    //adds image hovers on paintings list
    function addHovers() {


        $('.painting img').on('mouseover', function(e) {
            var alt = $(this).attr('alt');
            var src = $(this).attr('src');
            //generates new src with larger picture
            var newsrc = src.replace("square-medium", "average");

            var preview = $('<div id="preview"></div>');
            var image = $('<img src="' + newsrc + '">');
            var caption = $('<p>' + alt + '</p>');
            preview.append(image);
            preview.append(caption);
            $('body').append(preview);

            $(this).addClass("gray");

            $("#preview").fadeIn(1000);
        });

        function removePreview() {
            // remove the dynamic element and the gray class
            $(this).removeClass("gray");
            $("#preview").remove();
        };

        function movePreview(e) {
            // position preview based on mouse coordinates
            $("#preview")
                .css("top", (e.pageY - 10) + "px")
                .css("left", (e.pageX + 30) + "px");
        };


        $(".painting img").on("mouseleave", removePreview);
        $(".painting img").on("mousemove", movePreview);

    }

    //function for initializing page on first load
    function init_page() {

        var url = baseURL;
        url = url + window.location.href.split("?", 2)[1];

        //Make sure that the page has fully loaded all required information before creating the list
        //This will retreive a list of paintings in the cart
        $.get("cart-info-list-service.php").done(function(data) {
            cartArray = JSON.parse(data);
            
            //gets favourite array for comparison during painting list generation and favourites remove/add buttons 
            $.get("fav-info-list-service.php").done(function(data) {
                favArray = JSON.parse(data);
                $.get(url)
                    .done(function(data) {
                        loadPaintings(data);
                        //jump to the anchor point
                        window.location.hash = window.location.hash;
                    });
            });


        });


    }

    function loadPaintings(data) {
        var json = JSON.parse(data);
        $('div[class="ui disabled centered loader"]').attr("class", "ui active centered loader");
        var list = transitionPaintings(paintings);
        $("#" + this.urlParam + "-label").text(this.Name);

        //Update the name of of the filter on the page
        updateNames();


        $.each(json["results"], function(key, value) {
            var anchorJump = $('<a id = "jump' + value['PaintingID'] + '"> </a>');
            var itemPainting = $("<div class = 'item painting' id=p|" + value['PaintingID'] + "></div>");
            itemPainting.append($("<div class='image'><a href = 'single-painting.php?PaintingID=" + value['PaintingID'] + "'><img src='images/art/works/square-medium/" + value['ImageFileName'] + ".jpg' alt='" + value['Title'] + "' class='image'></a></div>"));


            var content = $("<div class='content'></div>");
            content.append($("<a class='header browserTitle' href = 'single-painting.php?PaintingID=" + value['PaintingID'] + "' >" + value['Title'] + "</a>"));
            content.append($("<br>"));
            content.append($("<a class = 'browseAuthor' href = 'single-artist.php?ArtistID=" + value['ArtistID'] + "' >" + value['Name'] + "</a>"));
            content.append($("<p>$" + parseInt(value['MSRP']).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, '$1,') + "</p>"));
            if (value['Excerpt'] != null)
                content.append($("<div class = 'item'><p>" + value['Excerpt'] + "</p></div>"));
            else
                content.append($("<div class = 'item'><p>No description available for this painting.</p></div>"));

            var links = $("<div></div>");

            if (!isInCart(value['PaintingID'])) {
                links.append($("<a href = 'add-cart.php?PaintingID=" + value['PaintingID'] + "&return=" + encodeURIComponent(location.pathname + location.search) + "#jump" + value['PaintingID'] + "' class='ui icon orange button'><i class = 'add to cart icon'></i></a>"));
            }
            else {
                links.append($("<a href = 'view-cart.php' class='ui icon orange button'><i class = 'unhide icon'></i></a>"));
            }
            if (!isInFav(value['PaintingID'])) {
                links.append($("<a href='add-favourite.php?PaintingID=" + value['PaintingID'] + "&return=" + encodeURIComponent(location.pathname + location.search) + "#jump" + value['PaintingID'] + "'><button class = 'ui icon grey button'><i class='heart icon'></i></button></a>"));
            }
            else {
                links.append($("<a href='remove-favourite.php?PaintingID=" + value['PaintingID'] + "&return=" + encodeURIComponent(location.pathname + location.search) + "#jump" + value['PaintingID'] + "' class='ui icon grey button'><i class='ban icon'></i></a></div>"));
            }
            content.append(links);



            itemPainting.append(content);
            list.append(anchorJump)
            list.append($("<br>"));
            list.append(itemPainting);
            list.append("<hr>");
            this.url = "";
        });
        //loading icon for search. Waits .5 seconds before setting the loader as disabled.
        //A3 requirements state the need for a loader, so a timeout was added to ensure it was noticeable.
        setTimeout(function() {
            $('div[class="ui active centered loader"]').attr("class", "ui disabled centered loader");;
        }, 500);

        list.transition("slide right");
        addHovers();



        function isInCart(pId) {
            var result = false;
            $.each(cartArray, function(i, t_pId) {
                if (t_pId == pId) {
                    result = true;
                    return false;
                }

            });

            return result;
        }

        function isInFav(pId) {
            var result = false;
            $.each(favArray, function(i, t_pId) {
                if (t_pId == pId) {
                    result = true;
                    return false;
                }
            });
            return result;
        }

        function updateNames() {
            var artistVal = $("#artist-dropdown").val();
            var artistName = $('#artist-dropdown option[value="' + artistVal + '"]').text();
            var museumVal = $("#museum-dropdown").val();
            var museumName = $('#museum-dropdown option[value="' + museumVal + '"]').text();
            var shapeVal = $("#shape-dropdown").val();
            var shapeName = $('#shape-dropdown option[value="' + shapeVal + '"]').text();


            if (artistName == "Select Artist")
                artistName = "All";

            if (museumName == "Select Museum")
                museumName = "All";

            if (shapeName == "Select Shape")
                shapeName = "All";

            $("#artist-label").text(artistName);
            $("#museum-label").text(museumName);
            $("#shape-label").text(shapeName);


        }

    }

});
