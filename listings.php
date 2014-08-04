<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>GoldGo</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/cover.css" rel="stylesheet">
    <link href="css/slick.css" rel="stylesheet">
    <link href="css/listings.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script type="text/javascript" src="scripts/jquery.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAFs7b-BTdRvR3jlBEbvSuxvu3gOtZLsU8"></script>
  </head>

<body>
  <!--
    We position the images fixed and therefore need to place them outside of #skrollr-body.
    We will then use data-anchor-target to display the correct image matching the current section (.gap element).
  -->
    <div
      class="parallax-image-wrapper parallax-image-wrapper-100"
      data-anchor-target="#dragons + .gap"
      data-bottom-top="transform:translate3d(0px, 200%, 0px)"
      data-top-bottom="transform:translate3d(0px, 0%, 0px)">

      <div
        class="parallax-image parallax-image-100"
        style="background-image:url(assets/testbg.jpg)"
        data-anchor-target="#dragons + .gap"
        data-bottom-top="transform: translate3d(0px, -100%, 0px);"
        data-top-bottom="transform: translate3d(0px, 100%, 0px);"
        id="main"
      ></div>
      <!--the +/-80% translation can be adjusted to control the speed difference of the image-->
    </div>

    <div
      class="parallax-image-wrapper parallax-image-wrapper-100"
      data-anchor-target="#bacons + .gap"
      data-bottom-top="transform:translate3d(0px, 200%, 0px)"
      data-top-bottom="transform:translate3d(0px, 0%, 0px)">

      <div
        class="parallax-image parallax-image-100"
        style="background-image:url(assets/testweather.jpg)"
        data-anchor-target="#bacons + .gap"
        data-bottom-top="transform: translate3d(0px, -80%, 0px);"
        data-top-bottom="transform: translate3d(0px, 80%, 0px);"
        id="weather"
      ></div>
    </div>

<!--     <div
      class="parallax-image-wrapper parallax-image-wrapper-100"
      data-anchor-target="#kittens + .gap"
      data-bottom-top="transform:translate3d(0px, 300%, 0px)"
      data-top-bottom="transform:translate3d(0px, 0%, 0px)">

      <div
        class="parallax-image parallax-image-100"
        style="background-image:url(assets/testbg.jpg)"
        data-anchor-target="#kittens + .gap"
        data-bottom-top="transform: translate3d(0px, -60%, 0px);"
        data-top-bottom="transform: translate3d(0px, 60%, 0px);"
      ></div>
    </div> -->

    <div id="skrollr-body">
      <div class="header" id="dragons">
          <div class="events" id="carousel"><!-- CAROUSEL CONTAINER START -->

          </div><!-- CAROUSEL CONTAINER END -->
      </div>
      <div class="gap gap-50"></div>
      <div class="content" id="bacons">
        <p class="lead event-text" id="description">
          Loading...
        </p>
        <div id="map-canvas"></div>
      </div>
      <div class="gap gap-50"></div>
      <div class="content" id="kittens">
        <h1 class="event-text" id="weather-advice">Always check the weather before heading outside!</h1>
        <div class="content footer" id="done">
              <p id="loc"><a href="index.html">GoldGo.</a> Hand crafted with love in sunny Brisbane, Queensland.</p>
              <p>Built by Tech Stars, <a href="mailto:poxon.d@gmail.com" class="footer">David</a> &amp; <a class="footer" href="mailto:kurt.m0@gmail.com">Kurt</a>.</p>
      </div>
      </div>
      <!-- <div class="gap"></div> -->
      
    </div>



  <script type="text/javascript" src="scripts/skrollr.js"></script>
  <script type="text/javascript" src="scripts/slick.js"></script>
  <script type="text/javascript" src="scripts/bootstrap.js"></script>
  <script type="text/javascript" src="scripts/maps.js"></script>
  <script type="text/javascript">
    $(document).ready(function() {
      var events;
      $.get('maps/gold.php', function() {
        // pass
      }).done(function(data) {
        events = $.parseJSON(data);
        buildCarousel();
        getEvent(0);
        setTimeout(function(){$(window).trigger('resize');console.log('hi')}, 6000);
      })

      var buildCarousel = function() {
        var html = ""
        $.each(events, function() {
          $('#carousel').slickAdd('<div class="event-text"><h1>' + this['title'] + '</h1><h2>' + this['date']+' · ' + this['location'] + '</h2><p>' + this['cost'] + ' - Booking: ' + this['booking'] + '</p></div>')
        })
      }

      var getEvent = function(index) {
        $('#main').css("background-image", "url('" + events[index]['imgEvent'] + "')");
        $('#weather').css("background-image", "url('" + events[index]['imgWeather'] + "')");
        $('#weather-advice').text(events[index]['advice']);
        $('#description').text(events[index]['description']);

        setMarkersByName(events[index]['location'], "goldgo");
        centreMap(events[index]['location']);
      }

      var s = skrollr.init({
        smoothScrolling: false,
        mobileDeceleration: 0.004
      });

      $('.eventbg').each(function() {
        $(this).closest('body').css("background-image", "url('" + $(this).data('bg') + "')")
      })

      $('.weather').each(function() {
        $(this).css("background-image", "url('" + $(this).data('bg') + "')")
      })

      $('.events').slick({
        dots: true,
        arrows: false,
        onAfterChange : function(slider, index) {
          getEvent(index);
        }
      });
    }); 
  </script>
  </body>
</html>