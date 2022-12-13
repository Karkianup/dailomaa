<script src="{{ asset('Asset/Frontend/js/jquery3-3-1.js') }}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

<script src="{{ asset('Asset/Frontend/js/owl.carousel.js') }}"></script>
<script src="{{ asset('Asset/Frontend/js/highlight.js') }}"></script>
<script src="{{ asset('Asset/Frontend/js/app.js') }}"></script>


<script src="{{ asset('Asset/Frontend/js/imagezoom.js') }}"></script>
<script type="text/javascript">
    $(function() {
        $('#alertMessage').delay(5000).fadeOut();
    });
</script>
<!-- script for responsive tabs -->
<script src="{{ asset('Asset/Frontend/js/responsive-tabs.js') }}"></script>
<script>
    $(document).ready(function() {
        $('#horizontalTab').easyResponsiveTabs({
            type: 'default', //Types: default, vertical, accordion           
            width: 'auto', //auto or any width like 600px
            fit: true, // 100% fit in a container
            closed: 'accordion', // Start closed if in accordion view
            activate: function(event) { // Callback function if tab is switched
                var $tab = $(this);
                var $info = $('#tabInfo');
                var $name = $('span', $info);
                $name.text($tab.text());
                $info.show();
            }
        });
        $('#verticalTab').easyResponsiveTabs({
            type: 'vertical',
            width: 'auto',
            fit: true
        });
    });
</script>
<script>
    function showPassword() {
        var x = document.getElementById("password");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }
</script>
<script src="{{ asset('Asset/Frontend/js/jquery.flexslider.js') }}"></script>
<script>
    // Can also be used with $(document).ready()
    $(window).load(function() {
        $('.flexslider').flexslider({
            animation: "slide",
            slideshow: false,
            controlNav: "thumbnails",

        });
    });
</script>
<!-- //FlexSlider-->
<!-- add to cart value increase -->
<script>
    function increaseValue() {
        var value = parseInt(document.getElementById('number').value, 10);
        value = isNaN(value) ? 0 : value;
        value > 9 ? value = 9 : '';
        value++;
        document.getElementById('number').value = value;
    }

    function decreaseValue() {
        var value = parseInt(document.getElementById('number').value, 10);
        value = isNaN(value) ? 0 : value;
        value < 2 ? value = 2 : '';
        value--;
        document.getElementById('number').value = value;
    }
</script>
<script src="{{ asset('Asset/Frontend/js/bootstrap.min.js') }}"></script>

<!-- for stars ---->
<script>
    $(document).ready(function() {

        /* 1. Visualizing things on Hover - See next part for action on click */
        $('#stars li').on('mouseover', function() {
            var onStar = parseInt($(this).data('value'), 10); // The star currently mouse on

            // Now highlight all the stars that's not after the current hovered star
            $(this).parent().children('li.star').each(function(e) {
                if (e < onStar) {
                    $(this).addClass('hover');
                } else {
                    $(this).removeClass('hover');
                }
            });

        }).on('mouseout', function() {
            $(this).parent().children('li.star').each(function(e) {
                $(this).removeClass('hover');
            });
        });

        // For payment methods
        $(document).ready(function() {
            $("input[name$='payment_method']").click(function() {
                var radio_value = $(this).val();
                if (radio_value == 'esewa') {
                    // $("#contact").fadeIn("slow");
                    $("#esewaPaymentModal").modal('show');
                } else if (radio_value == 'cellpay') {
                    $("#cellpayPaymentModal").modal('show');

                } else if (radio_value == 'cash-on-delivery') {
                    $("#cashOnDeliveryPaymentModal").modal('show');
                } else if (radio_value == 'fonepay') {
                    $("#fonepayPaymentModal").modal('show');
                }
            });
        });

        // For adding modal popup after selecting payment method
        // $('input[name="payment_method"]').change(function() {
        //     if ($(this).is(':checked') && ($(this).val() == 'esewa' || 'cellpay' || 'fonepay')) {
        //         $('#myPaymentModal').modal('show');
        //     }
        // });


        /* 2. Action to perform on click */
        $('#stars li').on('click', function() {
            var onStar = parseInt($(this).data('value'), 10); // The star currently selected
            var stars = $(this).parent().children('li.star');

            for (i = 0; i < stars.length; i++) {
                $(stars[i]).removeClass('selected');
            }

            for (i = 0; i < onStar; i++) {
                $(stars[i]).addClass('selected');
            }

            // JUST RESPONSE (Not needed)
            var ratingValue = parseInt($('#stars li.selected').last().data('value'), 10);
            var msg = "";
            if (ratingValue > 1) {
                msg = "Thanks! You rated this " + ratingValue + " stars.";
            } else {
                msg = "We will improve ourselves. You rated this " + ratingValue + " stars.";
            }
            responseMessage(msg);

        });


    });


    function responseMessage(msg) {
        $('.success-box').fadeIn(200);
        $('.success-box div.text-message').html("<span>" + msg + "</span>");
    }
</script>

<script>
    $(".nav-tabs li").click(function() {
        $(".nav-tabs li").removeClass("active");
        $(this).addClass("active");
    });
</script>



<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.0/jquery.cookie.min.js">
</script>
<script type="text/javascript">
  $(document).ready(function() {
    if ($.cookie('pop') == null) {
      $('#myModal_a').modal('show');
      $.cookie('pop', '1');
    }
  });
</script>
