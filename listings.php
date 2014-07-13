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
          <div class="events"><!-- CAROUSEL CONTAINER START -->
            <div class="event-text">
              <h1>Tai Chi</h1>
              <p>A small summary</p>
            </div>
            <div class="event-text">
              <h1>Dancing</h1>
            </div>
          </div><!-- CAROUSEL CONTAINER END -->
      </div>
      <div class="gap gap-50" style="background-image:url(assets/testbg.jpg);"></div>
      <div class="content" id="bacons">
        <p class="lead event-text">
          Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam nec aliquam nisi. Quisque vitae eros et tellus feugiat mattis in vel urna. Pellentesque egestas metus ligula, fringilla interdum massa vehicula sit amet. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Nullam a velit felis. Aliquam a bibendum dui. Etiam porta lacus a dolor pulvinar vulputate. Fusce elementum vulputate mi vitae tincidunt. Suspendisse pretium tincidunt odio vel semper. Duis porta libero orci, in porta nulla vestibulum eget. Nunc tempus lorem in lectus congue venenatis. Morbi porttitor mattis nisl, ac luctus dolor tincidunt mollis.
        </p>
        <div id="map-canvas"></div>
      </div>
      <div class="gap gap-50"></div>
      <div class="content" id="kittens">
        <h1 class="event-text">Don't forget your umbrella!</h1>
        <div class="content footer" id="done">
              <p id="loc">Hand crafted with love in sunny Brisbane, Queensland.</p>
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
              console.log(index);
            }
          });

          var changeEvent = function() {

          };
    }); 
  </script>
  </body>
</html>