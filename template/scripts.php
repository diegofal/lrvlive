        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.2.min.js"><\/script>')</script>
        <script src="js/plugins.js"></script>
        <script src="js/main.js"></script>
        <script src="js/plugins/jquery.easing.1.3.js"></script>
        <script src="js/plugins/jquery.animate-enhanced.min.js"></script>
        <script src="js/plugins/jquery.superslides.min.js" type="text/javascript" charset="utf-8"></script>
        <script src="http://maps.google.com/maps/api/js?sensor=false&libraries=geometry&v=3.7"></script>
        <script src="js/plugins/maplace-0.1.3.js"></script>
        <script src="js/plugins/modalEffects.js"></script>
        <script src="js/plugins/classie.js"></script>
        <script src="js/plugins/jquery.datetimepicker.js"></script>
        <script type="text/javascript" src="slick/slick.min.js"></script>
        <script>
            $(function() {
                var header = $(".clearHeader");
                $(window).scroll(function() {    
                    var scroll = $(window).scrollTop();

                    if (scroll >= 200) {
                        header.removeClass('clearHeader').addClass("darkHeader");
                    } else {
                        header.removeClass("darkHeader").addClass('clearHeader');
                    }
                });
                $('.dropdown-btn').on('click', function(e) {
                  $('.select-trip-items').toggleClass("pressed");
                  $('.dropdown-btn').toggleClass("pressed");
                  e.preventDefault();
                });
                // Si clickear cualquier item del menu, oculpa el menu
                $('.select-trip-items .md-trigger').on('click', function(e) {
                  $('.select-trip-items').toggleClass("pressed");
                  $('.dropdown-btn').toggleClass("pressed");
                  e.preventDefault();
                });
            });
        </script>
        <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
        <script>
            (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
            function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
            e=o.createElement(i);r=o.getElementsByTagName(i)[0];
            e.src='//www.google-analytics.com/analytics.js';
            r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
            ga('create','UA-XXXXX-X','auto');ga('send','pageview');
        </script>
        
<script type="text/javascript">
    $('#datetimepicker3').datetimepicker({
        inline:true
    });
</script>

<script>
  var currentIndex = 0,
  items = $('.md-modal .step'),
  itemAmt = items.length;

function cycleItems(padre) {
  var item = $(padre).find(".step").eq(currentIndex);
  console.log(item);
  items.hide();
  item.css('display','block');
  // $('#buy').addClass('step-' + currentIndex);
}

$('.btn-next').click(function() {
  currentIndex += 1;
  var padre = $(this).closest('section');
  console.log(padre);
  if (currentIndex > itemAmt - 1) {
    currentIndex = 0;
    window.location.href = "http://www.sagepay.co.uk/";
  }
  else{
    cycleItems(padre);
  }
});

// $('#prev').click(function() {
//   currentIndex -= 1;
//   if (currentIndex < 0) {
//     currentIndex = itemAmt - 1;
//   }
//   cycleItems();
// });
</script>

<script type="text/javascript">
  $(document).ready(function() {
      var s = $(".facts-container");
      var pos = s.position();
      $(window).scroll(function() {
          var windowpos = $(window).scrollTop();

          if (windowpos >= pos.top) {
              s.addClass("stick");
          } else {
              s.removeClass("stick");
          }
      });
  });
</script>

<script>
    // Clicking button/checkbox Hack
    $( ".chartercheckbox" ).click(function() {
      $( ".chartercheckbox input" ).click(),
      $(".chartercheckbox").addClass("checked");
    });
</script>