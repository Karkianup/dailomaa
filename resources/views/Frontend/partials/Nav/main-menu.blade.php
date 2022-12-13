<style>
 
#container_k {

 white-space: nowrap;

   
   }
  
/*
  #container_k:hover{

 overflow:visible;
   }

#slideLeft{
      position: absolute;
   left: -3%;
    top: 5px;
  border:none;
  background:none;
  font-size:32px;
  }
 #slideRight{
      position: absolute;
    right: -3%;
    top: 5px;
    border:none;
    background:none;
    font-size:32px;
  }
  @media (max-width: 1000px){
  #slideLeft{
   display:none;
  }
 #slideRight{
     display:none;
  }
  }
*/
</style>

<div class="head-menu">
  
    <div class="container" >
     
   <!--  <div class="row" >
       <div class="col-md-12" >
   <button id="slideLeft" type="button"><i class="fa fa-caret-left" aria-hidden="true"></i></button>
    <button id="slideRight" type="button"><i class="fa fa-caret-right" aria-hidden="true"></i></button> 
      </div></div> -->
        <nav class="navbar navbar-expand-lg " id="container_k">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span title="Open Main Navigation" class="relative">
                    <span class="app-menu-icon-initial absolute center-a"><svg aria-hidden="true" focusable="false"
                            data-prefix="far" data-icon="bars" role="img" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 448 512" class="svg-inline--fa fa-bars fa-w-14 fa-fw fa-lg">
                            <path fill="currentColor"
                                d="M436 124H12c-6.627 0-12-5.373-12-12V80c0-6.627 5.373-12 12-12h424c6.627 0 12 5.373 12 12v32c0 6.627-5.373 12-12 12zm0 160H12c-6.627 0-12-5.373-12-12v-32c0-6.627 5.373-12 12-12h424c6.627 0 12 5.373 12 12v32c0 6.627-5.373 12-12 12zm0 160H12c-6.627 0-12-5.373-12-12v-32c0-6.627 5.373-12 12-12h424c6.627 0 12 5.373 12 12v32c0 6.627-5.373 12-12 12z"
                                class=""></path>
                        </svg>
                    </span>

                </span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto" id="content_k" >
                    @foreach ($menu as $men)
                        @if ($men->menu_items->count() <= 0)
                            <li class="nav-item" style="border-bottom: 3px solid #f35b04;">

                                <a class="nav-link"
                                    @if ($men->type == 'route') {
                            href="#"
                            }
@elseif($men->type == 'none'){
                            href="{{ url($men->url ?? '#') }}"
                            }
@elseif($men->type == 'url'){
                            href="{{ url($men->url) }}"
                            }
@elseif($men->type == 'page'){
                            href="
                            {{ route('page-wise', $men->url) }}"
                            }
@elseif($men->type == 'category'){
                                href="{{ route('product-category-wise', $men->url) }}"
                                }
@elseif($men->type == 'sub-category'){
                            href="
                            {{ route('product-sub-category-wise', $men->url) }}
                            "
                            } @endif>
                                    {{ $men->menu_title }}
                                </a>
               
                            </li>
                        @else
                            <li class="nav-item dropdown" style="border-bottom: 3px solid #20245ce0;">
                              
                               
                                <a class="nav-link dropdown-toggle" id="navbarDropdown" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                    href="{{ $men->url }}">
                                    {{ $men->menu_title }}
                                </a>
                                @if ($men->mega_menu == 1)
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        @foreach ($men->menu_items as $items)
                                            <a class="dropdown-item"
                                                @if ($items->type == 'route') {
                                                href="
                                                {{-- {{route($items->url)}} --}}
                                                "
                                                }
        @elseif($items->type == 'none'){
                                                href="{{ url($items->url) }}"
                                                }
        @elseif($items->type == 'url'){
                                                href="{{ url($items->url) }}"
                                                }
        @elseif($items->type == 'page'){
                                                {{-- If the segment of url is 'en' route will add en and if not will not add --}}
                                                href="
                                                {{ route('page-wise', $items->url) }}"
                                                }
        @elseif($items->type == 'category'){
                                                    href="{{ route('product-category-wise', $items->url) }}"
                                                    }
        @elseif($items->type == 'sub-category'){
                                                href="
                                                {{ route('product-sub-category-wise', $items->url) }}
                                                "
                                                } @endif
                                                class="menu-li-color list-font-size">
                                                {{ $items->menu_item_title }}
                                      </a>
                                            <div class="dropdown-divider"></div>
                                        @endforeach
                                  </div>
                                @else
                             
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        @foreach ($men->menu_items as $items)
                                            <a class="dropdown-item"
                                                @if ($items->type == 'route') {
                                    href="
                                    "
@elseif($items->type == 'none'){
                                    href="{{ url($items->url) }}"
                                    }
@elseif($items->type == 'url'){
                                    href="{{ url($items->url) }}"
                                    }
@elseif($items->type == 'page'){
                                    href="
                                    {{ route('page-wise', $items->url) }}"
                                    }
@elseif($items->type == 'category'){
                                    href="
                                   #
                                    "
                                    }
                @elseif($items->type == 'sub-category'){
                                        href="
                                        {{ route('product-category-wise', $items->url) }}
                                        "
                                        } @endif>
                                                {{ $items->menu_item_title }}

                                            </a>
                                            <div class="dropdown-divider"></div>
                                        @endforeach
                                    </div>
                                @endif
                            </li>
                        @endif
                    @endforeach
                </ul>
            </div>

        </nav>
    </div>

</div>

<script>

  
 // const buttonRight = document.getElementById('slideRight');
 // const buttonLeft = document.getElementById('slideLeft');

 //  buttonRight.onclick = function () {
  //    document.getElementById('container_k').scrollLeft +=500;
  //  };
  //  buttonLeft.onclick = function () {
  //    document.getElementById('container_k').scrollLeft -= 500;
 //   };
 

</script>
