

<x-app-layout>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    

    

            @if(session('checkout_message'))
                <div class="bg-green-600 text-white p-2 rounded mb-3">
                    {{ session('checkout_message') }}
                </div>
            @endif

            @if(!$cart || count($cart) == 0)
              
  <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Management System - PHP Laravel</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="{{ ('landingpage.css') }}" rel="stylesheet"  type="text/css">
    <link rel="stylesheet" href="{{url('css/style.css')}}" class="style">
    <script type="text/javascript"
        src="https://cdn.jsdelivr.net/npm/@emailjs/browser@4/dist/email.min.js">
</script>
<script type="text/javascript">
   (function(){
      emailjs.init({
        publicKey: "lSYpzqK1-6ojmdmF-",
      });
   })();
</script>
<script src="{{ url('js/script.js') }}"></script>

</head>
<body>
  
  

    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
  <div class="container">
    <a class="navbar-brand" href="#"><span class="text-warning">Shop</span>Con</a>
    
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0"> 
        <li class="nav-item">
          <a class="nav-link" href="#home">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#addtocart">Shop</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('user.orders') }}">My Orders</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#about">About</a>
        </li> 
        <li class="nav-item">
          <a class="nav-link" href="#products">Products</a>
        </li> 
        <li class="nav-item">
          <a class="nav-link" href="#portfolio">Suppliers</a>
        </li> 
        <li class="nav-item">
          <a class="nav-link" href="#team">Team</a>
        </li> 
        <li class="nav-item">
          <a class="nav-link" href="#contact">Contact</a>
        </li>
      </ul>
    </div>
  </div>
</nav>


            <div id="home" class="carousel slide" data-bs-ride="carousel">
          <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
          </div>
          <div class="carousel-inner">
            <div class="carousel-item active">
              <img src="{{ asset('img/image1.png') }}"  class="d-block w-100" alt="...">
              <div class="carousel-caption">
                <h5>Buy affordable products.</h5>
                <p>At ShopCon, every cents of your money is worth it. </p>
                <p><a href="#" class="btn btn-warning mt3">Learn more</a></p>
              </div>
            </div>
            <div class="carousel-item">
              <img src="{{ asset('img/image2.png') }}"  class="d-block w-100" alt="...">
              <div class="carousel-caption">
                <h5>Always dedicated to sell goods</h5>
                <p>We sell products for more than a decade and the company trust us to provide for the best quality needed.</p>
                <p><a href="#home" class="btn btn-warning mt3">Learn more</a></p>
              </div>
            </div>
            <div class="carousel-item">
              <img src="{{ asset('img/image3.png') }}"  class="d-block w-100" alt="...">
              <div class="carousel-caption">
                <h5>Buy snacks,fruits, and vegetables in one click</h5>
                <p> The foods you want are all here at ShopCon </p>
                <p><a href="#" class="btn btn-warning mt3">Learn more</a></p>
              </div>
            </div>
          </div>
          <button class="carousel-control-prev" type="button" data-bs-target="#home" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#home" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
          </button>
        </div>

        <br>
        <section id="about" class="about section-padding">
          <div class="container">
            <div class="row">
              <div class="col-lg-4 col-md-12 col-12">
                <div class="about-img">
                  <img src="{{ asset('img/about.png') }}"  alt="" class="img-fluid">
                </div>
              </div>
              
              <div class="col-lg-8 col-md-12 col-12 ps-lg-5 mt-md-5">
                <div class="about-text">
                  <h2>We Provide best quality <br> Products Ever</h2>
                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                  <a href="#" class="btn btn-warning">Learn more</a>
                </div>
              </div>
            </div>
          </div>
        </section>
<section id="addtocart">
<div class="py-10 max-w-4xl mx-auto">
        
        <div style="text-align: center; margin: auto; width: 800px; margin-top: 50px;" class="bg-white p-6 shadow rounded">
    <p>Your cart is empty. Please fill in the cart to place order.</p>
    <a style="display: inline-block; margin-top: 15px;" href="{{ route('admin.cart.add_page') }}">
        <img style="width: 150px;" src="{{ asset('img/cart.png') }}" alt="Description of the image">
    </a>
</div>

</div>
</section>
        <!-- products section -->
         <section id="products" class="products section-padding">
            <div class="container">
              <div class="row">
                <div class="col-md-12">
                  <div class="section-header text-center pb-5">
                    <h2>Our Products</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quod <br> minus nulla delectus fugiat vel id? </p>
                  </div>
                </div>
              </div>

              
              <div class="row">
                <div class="col-12 col-md-12 col-lg-4">
                  <div class="card text-white text-center bg-dark pb-2">
                    <div class="card-body">
                        <i class="bi bi-stars"></i>
                        <h3 class="card-title">Best Quality</h3>
                        <p class="lead">Lorem ipsum dolor sit amet consectetur adipisicing elit. Deserunt doloribus voluptas officia, consequatur nemo nisi, vel dicta perferendis velit porro accusamus quidem debitis, officiis voluptatem quae eos nihil ab. Ratione.</p>
                        <button class="btn btn-warning text-dark">Read More</button>
                    </div>
                  </div>
                </div>

                <div class="col-12 col-md-12 col-lg-4">
                  <div class="card text-white text-center bg-dark pb-2">
                    <div class="card-body">
                        <i class="bi bi-coin"></i>
                        <h3 class="card-title">Affordability</h3>
                        <p class="lead">Lorem ipsum dolor sit amet consectetur adipisicing elit. Deserunt doloribus voluptas officia, consequatur nemo nisi, vel dicta perferendis velit porro accusamus quidem debitis, officiis voluptatem quae eos nihil ab. Ratione.</p>
                        <button class="btn btn-warning text-dark">Read More</button>
                    </div>
                  </div>
                </div>

                <div class="col-12 col-md-12 col-lg-4">
                  <div class="card text-white text-center bg-dark pb-2">
                    <div class="card-body">
                        <i class="bi bi-playstation"></i>
                        <h3 class="card-title">Integrity</h3>
                        <p class="lead">Lorem ipsum dolor sit amet consectetur adipisicing elit. Deserunt doloribus voluptas officia, consequatur nemo nisi, vel dicta perferendis velit porro accusamus quidem debitis, officiis voluptatem quae eos nihil ab. Ratione.</p>
                        <button class="btn btn-warning text-dark">Read More</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
         </section>

         <section id="portfolio" class="portfolio section-padding" >
            <div class="container" >
              <div class="row" >
                <div class="col-md-12">
                  <div class="section-header text-center pb-5">
                    <h2>Our Suppliers</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quod <br> minus nulla delectus fugiat vel id? </p>
                  </div>
                </div>
              </div>

             <div class="row justify-content-center">

                <div class="col-12 col-md-12 col-lg-4">
                  <div class="card text-center bg-white pb-2" style="width: auto; height: 675px";>
                    <div class="card-body text-dark" >
                       <div class="img-area mb-4" >
                       <img src="{{ asset('img/supplier1.png') }}" alt="" class="" style="width: auto; height: 200px;display: block; margin: auto"; >
                      </div>
                      <h3 class="card-title">M.Y. San</h3>
                      <p class="lead">Lorem ipsum dolor sit amet consectetur adipisicing elit. Placeat, minima! Ea, iure. Officia consequuntur, error earum vero inventore, sunt magni aut ullam eos voluptatem, sed accusantium odit rerum enim cum.</p>
                      <button class="btn bg-warning text-dark">Learn More</button>
                    </div>
                  </div>
                </div>
                <div class="col-12 col-md-12 col-lg-4">
                  <div class="card text-center bg-white pb-2" style="width: auto; height: 675px;";>
                    <div class="card-body text-dark">
                      <div class="img-area mb-4"  >
                       <img src="{{ asset('img/supplier2.png') }}"  alt="" class="img-fluid" style="width: auto; height: 200px;display: block; margin: auto";> 
                      </div>
                      <h3 class="card-title">Condura</h3>
                      <p class="lead">Lorem ipsum dolor sit amet consectetur adipisicing elit. Placeat, minima! Ea, iure. Officia consequuntur, error earum vero inventore, sunt magni aut ullam eos voluptatem, sed accusantium odit rerum enim cum.</p>
                      <button class="btn bg-warning text-dark">Learn More</button>
                    </div>
                  </div>
                </div>
                <div class="col-12 col-md-12 col-lg-4">
                  <div class="card text-center bg-white pb-2" style="width: auto; height: 675px";>
                    <div class="card-body text-dark" >
                      <div class="img-area mb-4">
                        <img src="{{ asset('img/supplier3.png') }}"  alt="" class="img-fluid" style="width: auto; height: 200px; display: block; margin: auto";>
                      </div>
                      <h3 class="card-title">Rebisco</h3>
                      <p class="lead">Lorem ipsum dolor sit amet consectetur adipisicing elit. Placeat, minima! Ea, iure. Officia consequuntur, error earum vero inventore, sunt magni aut ullam eos voluptatem, sed accusantium odit rerum enim cum.</p>
                      <button class="btn bg-warning text-dark">Learn More</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
         </section>

         <!-- team section -->
          <section id="team" class="team section-padding">
            <div class="container">
              <div class="row">
                <div class="col-md-12">
                  <div class="section-header text-center pb-5">
                    <h2>Our Team</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quod <br> minus nulla delectus fugiat vel id? </p>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-12 col-md-6 col-lg-3">
                  <div class="card text-center">
                  <div class="card-body">
                    <img src="{{ asset('img/team1.jpg') }}"  alt="" class="img-fluid rounded-circle" style="width: 200px; height: 200px;display: block; margin: auto">
                    <h3 class="card-title py-2">Jarius Miguel Ballesteros</h3>
                    <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ullam atque aperiam sit beatae quisquam eaque placeat, at corrupti necessitatibus, provident consequatur assumenda perferendis culpa omnis sint, recusandae quae libero natus?</p>

                    <p class="socials">
                      <i class="bi bi-twitter text-dark mx-1"></i>
                      <i class="bi bi-facebook text-dark mx-1"></i>
                      <i class="bi bi-linkedin text-dark mx-1"></i>
                      <i class="bi bi-instagram text-dark mx-1"></i>
                    </p>
                  </div>
                  </div>
                </div>
                <div class="col-12 col-md-6 col-lg-3">
                  <div class="card text-center">
                  <div class="card-body">
                    <img src="{{ asset('img/profilepic.png') }}"  alt="" class="img-fluid rounded-circle" style="width: 200px; height: 200px;display: block; margin: auto">
                    <h3 class="card-title py-2">First Name Last Name</h3>
                    <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ullam atque aperiam sit beatae quisquam eaque placeat, at corrupti necessitatibus, provident consequatur assumenda perferendis culpa omnis sint, recusandae quae libero natus?</p>

                    <p class="socials">
                      <i class="bi bi-twitter text-dark mx-1"></i>
                      <i class="bi bi-facebook text-dark mx-1"></i>
                      <i class="bi bi-linkedin text-dark mx-1"></i>
                      <i class="bi bi-instagram text-dark mx-1"></i>
                    </p>
                  </div>
                  </div>
                </div>
                <div class="col-12 col-md-6 col-lg-3">
                  <div class="card text-center">
                  <div class="card-body">
                    <img src="{{ asset('img/profilepic.png') }}"  alt="" class="img-fluid rounded-circle" style="width: 200px; height: 200px; display: block; margin: auto">
                    <h3 class="card-title py-2">First Name Last Name</h3>
                    <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ullam atque aperiam sit beatae quisquam eaque placeat, at corrupti necessitatibus, provident consequatur assumenda perferendis culpa omnis sint, recusandae quae libero natus?</p>

                    <p class="socials">
                      <i class="bi bi-twitter text-dark mx-1"></i>
                      <i class="bi bi-facebook text-dark mx-1"></i>
                      <i class="bi bi-linkedin text-dark mx-1"></i>
                      <i class="bi bi-instagram text-dark mx-1"></i>
                    </p>
                  </div>
                  </div>
                </div>
                <div class="col-12 col-md-6 col-lg-3 ">
                  <div class="card text-center">
                  <div class="card-body">
                    <img src="{{ asset('img/profilepic.png') }}"  alt="" class="img-fluid rounded-circle" style="width: 200px; height: 200px; display: block; margin: auto">
                    <h3 class="card-title py-2">First Name Last Name</h3>
                    <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ullam atque aperiam sit beatae quisquam eaque placeat, at corrupti necessitatibus, provident consequatur assumenda perferendis culpa omnis sint, recusandae quae libero natus?</p>

                    <p class="socials">
                      <i class="bi bi-twitter text-dark mx-1"></i>
                      <i class="bi bi-facebook text-dark mx-1"></i>
                      <i class="bi bi-linkedin text-dark mx-1"></i>
                      <i class="bi bi-instagram text-dark mx-1"></i>
                    </p>
                  </div>
                  </div>
                </div>
              </div>
            </div>
          </section>

          <!-- contact section -->
           <section id="contact" class="contact section-padding">
            <div class="container">
              <div class="row">
                <div class="col-md-12">
                  <div class="section-header text-center pb-5">
                    <h2>Contact Us</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quod <br> minus nulla delectus fugiat vel id? </p>
                  </div>
                </div>
              </div>

              <div class="row m-0">
                <div class="col-md-12 p-0 pt-4 p-4">
                  <form action="#" class="bg-light p-4.m-auto">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="mb-3">
                        <input id="name" type="text" class="form-control" required placeholder="Your Full Name">
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="mb-3">
                        <input id="email" type="email" class="form-control" required placeholder="Your Email Here">
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="mb-3">
                        <input id="subject" type="text" class="form-control" required placeholder="Subject">
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="mb-3">
                        <textarea id="message" rows="3" required class="form-control" placeholder="Your Query Here"></textarea>
                      </div>
                    </div>

                    <button class="btn btn-warning btn-lg btn-block mt-3" onclick="sendMail()">Send Now</button>
                  </div>
                  </form>
                </div>
              </div>
            </div>
           </section>


      <!-- footer -->
           <footer class="bg-dark p-2 text-center">
              <div class="container">
                <p class="text-white">
                  &copy; 2025 Inventory Management System. All Rights Reserved.                
                </p>
              </div>
           </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

    
</body>
</html>
                
            @else

            <x-slot name="header">
        <h2 class="font-semibold text-xl">Your Cart</h2>
    </x-slot>

    
   
<div class="py-10 max-w-4xl mx-auto">
        
        <div class="bg-white p-6 shadow rounded">
               <form action="{{ route('user.postaddinventory') }}" method="POST">
    @csrf

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>

        @foreach($cart as $index => $item)
            @php
                $lineTotal = $item['price'] * $item['quantity'];
            @endphp

            <tr>
              
                <td>{{ $item['name'] }}</td>
                <td>{{ $item['quantity'] }}</td>
                <td>₱{{ $item['price'] }}</td>
                <td>₱{{ $lineTotal }}</td>
                 <!-- <td>
                                <form action="{{ route('admin.cart.remove') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $item['id'] }}">
                                    <button class="btn btn-danger btn-sm">Remove</button>
                                </form>
                            </td> -->
            </tr>

            <!-- ✅ Hidden inputs -->
            <input type="hidden" name="products[{{ $index }}][product_id]" value="{{ $item['id'] }}">
            <input type="hidden" name="products[{{ $index }}][product_name]" value="{{ $item['name'] }}">
            <input type="hidden" name="products[{{ $index }}][quantity]" value="{{ $item['quantity'] }}">
            <input type="hidden" name="products[{{ $index }}][price]" value="{{ $item['price'] }}">
            <input type="hidden" name="products[{{ $index }}][total]" value="{{ $lineTotal }}">
        @endforeach

        </tbody>
    </table>

    <button href="{{ route('admin.order.add_to_cart') }}" type="submit" class="btn btn-primary mt-4">Place Order</button>
</form>



            @endif

        </div>
    </div>
</x-app-layout>
