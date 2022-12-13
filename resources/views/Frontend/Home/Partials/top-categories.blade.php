  <style>
      /* .owl-nav button span {
      font-size: 60px;
    }

    button.owl-prev,
    button.owl-next {

      background-color: #F5E9E4 !important;
      width: 40px;
      border-top-left-radius: 20px;
      border-bottom-left-radius: 20px;
    }

    button.owl-next {
      float: left;
    }

  

    .owl-carousel.owl-theme.owl-loaded.owl-drag {
      display: flex;
      justify-content: center;
      align-items: center;
    } */
  </style>

  <section class="category mb-5" id="demos">
      <div class="container-fluid gap-top">
          <div class="category-header">
              <h2>Top Categories</h2>
          </div>
          <!--feature title-->
          <div class="feature-catogory home-page-fc lazyload animated fadeIn">
              <div class="row">
                  <div class="col-12 col-sm-12 col-md-12 col-lg-12 ">
                      <div class="large-12 columns">
                          <div class="owl-carousel owl-theme">
                              @foreach ($topCategories as $topCategory)
                                  <div class="item cato-box text-center pb-2 ">
                                      <a href="{{ url('content', $topCategory->slug) }}"
                                          title="{{ $topCategory->name }}">
                                          <img class="pb-3"
                                              src="{{ asset('Asset/Uploads/Sub-Categories/' . $topCategory->image) }}"
                                              width="100%" height="175px">
                                          <div class="f-category-name"><b>{{ $topCategory->name }} </b><span
                                                  class="offer-tag-main"></span>
                                          </div>
                                      </a>
                                  </div>
                              @endforeach
                          </div>
                      </div>
                  </div>
              </div>
          </div>
          <!--feature-catogory-->
          {{--  <div class="feature-catogory home-page-fc lazyload animated fadeIn">
            <div class="row">
            @foreach ($topCategories as $topCategory)
                <div class="col-md-2 col-sm-6 cato-box text-center pb-2"style="background: #FFF;">
                    <div class=" agile_ecommerce_tab_left">
                        <div class="hs-wrapper">
                            <img  src="{{ asset('Asset/Uploads/Sub-Categories/' . $topCategory->image) }}"
                                alt=" " width="100%" height="100%">

                            <div class="hs_bottom">
                                <div class="simpleCart_shelfItem" style="color: #FFF; text-align:center;">
                                    <strong>
                                        <h5>
                                            <del>Rs.150</del>
                                            Rs. 120
                                            <h5>
                                        </i>
                                    </strong>
                                </div>
                                <ul>
                                    <li>
                                        <a href="{{ url('content', $topCategory->slug) }}" ><span class="fa fa-eye"
                                                aria-hidden="true"></span></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="f-category-name">{{$topCategory->name}} <span
                        class="offer-tag-main"></span>
                    </div>
                </div>
            @endforeach
            </div>
        </div>  --}}
          {{-- <div class="" style="float: right;">
              <a href="{{ url('category/all-categories') }}"> <button type="button" class="btn">
                      Next <i class="fa fa-angle-double-right" aria-hidden="true"></i>
                  </button></a>
          </div> --}}
      </div>
  </section>

  <script>
      $(document).ready(function() {
          var owl = $(".owl-carousel");
          owl.owlCarousel({
              margin: 10,
              nav: false,
              loop: true,
              dots: false,
              autoplay: true,
              autoplayTimeout: 2000,
              autoplayHoverPause: true,
              autoHeight: true,
              responsive: {
                  0: {
                      items: 2,
                  },
                  600: {
                      items: 2,
                  },
                  1000: {
                      items: 6,
                  },
              },
          });
      });
  </script>
