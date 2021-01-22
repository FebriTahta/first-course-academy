<!-- footer-28 block -->
<section class="app-footer mt-100">
  <footer class="footer-28 py-5">
    <div class="footer-bg-layer">
      <div class="container py-lg-3">
        <div class="row footer-top-28">
          <div class="col-lg-4 footer-list-28 copy-right mb-lg-0 mb-sm-5 mt-sm-0 mt-4">
            <a class="navbar-brand mb-3" href="#">
              <span class="fa fa-newspaper-o"></span> Course Academy</a>            
            <p class="mt-2">Design by <small><a href="https://w3layouts.com/">W3Layouts</a></small> </p>
          </div>          
        </div>
      </div>
    </div>
    </div>
  </footer>

  <!-- move top -->
  <button onclick="topFunction()" id="movetop" title="Go to top">
    <span class="fa fa-angle-up"></span>
  </button>

  <script>
    // When the user scrolls down 20px from the top of the document, show the button
    window.onscroll = function () {
      scrollFunction()
    };

    function scrollFunction() {
      if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
        document.getElementById("movetop").style.display = "block";
      } else {
        document.getElementById("movetop").style.display = "none";
      }
    }

    // When the user clicks on the button, scroll to the top of the document
    function topFunction() {
      document.body.scrollTop = 0;
      document.documentElement.scrollTop = 0;
    }
    
  </script>
  <!-- /move top -->
  
</section>
<!-- //footer-28 block -->

<!-- disable body scroll which navbar is in active -->
{{-- <script>
  $(function () {
    $('.navbar-toggler').click(function () {
      $('body').toggleClass('noscroll');
    })
  });
</script> --}}
<!-- disable body scroll which navbar is in active -->

<!-- Template JavaScript -->
{{-- <script src="{{ asset('assets/assets/js/bootstrap.min.js') }}"></script> --}}
<script src="{{ asset('assets/js/codebase.core.min.js') }}"></script>
<script src="{{ asset('assets/js/codebase.app.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/summernote/summernote-bs4.min.js') }}"></script>
{{-- <script src="{{ asset('assets/assets/js/jquery-3.3.1.min.js') }}"></script> --}}
<script src="{{ asset('assets/js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/js/pages/be_tables_datatables.min.js') }}"></script>
<script>jQuery(function(){ Codebase.helpers(['summernote', 'ckeditor', 'simplemde']); });</script>
<script>jQuery(function(){ Codebase.helpers('content-filter'); });</script>
<!-- theme changer js -->
<script src="{{ asset('assets/assets/js/theme-change.js') }}"></script>
<!-- //theme changer js -->

<!-- courses owlcarousel -->
<script src="{{ asset('assets/assets/js/owl.carousel.js') }}"></script>
<!--BOOTSTRAP-->
{{-- <script src="{{ asset('assets/assets/js/bootstrap.min.js') }}"></script> --}}

<!-- script for testimonials -->
@yield('script')
<script>
  $(document).ready(function () {
    $('.owl-testimonial').owlCarousel({
      loop: true,
      margin: 0,
      nav: true,
      responsiveClass: true,
      autoplay: false,
      autoplayTimeout: 5000,
      autoplaySpeed: 1000,
      autoplayHoverPause: false,
      responsive: {
        0: {
          items: 1,
          nav: false
        },
        480: {
          items: 1,
          nav: false
        },
        667: {
          items: 1,
          nav: true
        },
        1000: {
          items: 1,
          nav: true
        }
      }
    })
  })
</script>
<script type="text/javascript">
  var months  =['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
  var theDays =['Minggu','Senen','Selasa','Rabu','Kamis','Jumat','Sabtu'];
  var date    = new Date();
  var day     = date.getDate();
  var month   = date.getMonth();
  var thisDay = date.getDay(),
      thisDay = theDays[thisDay];
  var yy      = date.getYear();
  var year    = (yy<1000) ? yy + 1900: yy;
  // document.write(thisDay+',' + day + '' + months[month] + '' + year);
  document.getElementById("waktu").innerHTML=(thisDay+', ' + day + '' + months[month] + '' + year);
</script>
<script>
  function showtime()
  {            
      var today       = new Date();
      var curr_hour   = today.getHours();
      var curr_minute = today.getMinutes();
      var curr_second = today.getSeconds();            
      curr_hour       = checkTime(curr_hour);
      curr_minute     = checkTime(curr_minute);
      curr_second     = checkTime(curr_second);
      document.getElementById("jam").innerHTML=curr_hour+ ":" + curr_minute + ":" + curr_second ;                        
  }
  function checkTime(i){            
      if(i == 60){
          i = 60;
      }
      return i;        
  }
  setInterval(showtime, 500);
</script>
<!-- //script for testimonials -->
</body>

</html>