<!DOCTYPE html>
<html lang="en">

<head>

  <title>National Environment Platform</title>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
  <style>
    .inline {
      display: inline;
    }

    * {
      margin: 0;
      padding: 0;
      outline: 0
    }

    body {
      font: 11px/18px Georgia, Palatino, "Times New Roman", Times, Serif;
      background: #f4f4f4 url(../images/bg.jpg) no-repeat center top;
      color: #777;
    }

    a {
      text-decoration: none;
      color: #89A213;
    }

    a:hover {
      color: #556314;
    }

    p {
      margin: 0 0 15px;
      line-height: 1.6em;
    }

    h1 {
      float: left;
      width: 320px;
      line-height: 1.5em;
      font-size: 2.7em;
      color: #fff;
      margin: 0 0 20px;
      text-shadow: #89A213 1px 1px 1px;
    }

    h2 {
      margin: 0 0 15px;
      font-size: 1.6em;
      color: #89A213;
    }

    h3 {
      margin: 0 0 7px;
      font-size: 1.3em;
      clear: both;
      color: #444;
      line-height: 1.3em;
    }

    h4 {
      margin: 0 0 10px;
      font-size: 1.2em;
    }

    img {
      border: 0;
    }

    .x {
      clear: both;
    }

    #content {
      margin: 0 auto;
      width: 960px;
    }

    #header {
      height: 350px;
    }

    #top {
      padding: 13px 0 0;
      margin: 0 0 40px;
      color: #fff;
      height: 31px;
    }

    #pitch {
      clear: left;
      float: left;
      width: 610px;
      font-size: 1.2em;
      padding: 20px 0 0;
      color: #59690C;
      margin: 0 0 60px;
    }

    #menu {
      float: right;
      margin: 10px 15px 0 0;
    }

    #menu li {
      display: inline;
    }

    #menu li a {
      float: left;
      color: #EFF4D7;
      font-size: 1.2em;
      margin: 0 0 0 0px;
      padding: 4px;
    }

    #menu li a:hover,
    #menu li a.current {
      color: #fff;
      border-bottom: 1px solid #A5BE2E;
    }

    #cols {
      clear: both;
    }

    .col {
      float: left;
      width: 300px;
      margin: 0 39px 30px 0;
    }

    .last {
      position: relative;
      float: right;
      margin: -76px 0 0;
      background: #fff;
      width: 280px;
    }

    .col.last div {
      padding: 12px;
    }

    .img {
      clear: both;
      margin: 0 0 15px;
      border: 1px solid #ddd;
      padding: 5px;
    }

    .date {
      margin: 0 0 12px;
      color: #444;
    }

    .col h4 {
      background: #a46cb8;
      padding: 15px;
      color: #fff;
    }

    #main {
      float: left;
      clear: both;
      width: 640px;
      font-size: 1.2em;
    }

    #secondmain {
      clear: both;
      font-size: 1.2em;
      margin: auto;
      width: 75%;
    }

    .left {
      float: left;
      margin: 0 30px 10px 0;
    }

    #main p {
      text-align: justify;
    }

    #footer {
      font: 15px/22px Georgia, Palatino, "Times New Roman", Times, Serif;
      clear: both;
      border-top: 1px solid #ddd;
      color: #999;
      padding: 35px 0 15px 0;
    }

    #footer a {
      margin: 0;
      color: #999;
    }

    #footer .left {
      float: left;
    }

    #footer .right {
      float: right;
    }

    .lightpurp {
      background-color: #A46CB8;
    }
  </style>
</head>

<body>

  <div id="content">
    <p id="top"></p>
    <h1>Welcome to the National Environment Platform</h1>
    <ul id="menu">
      <!-- Authentication Links -->
      @guest
      <li class="nav-item">
        <a class="nav-link text-light" href="{{ route('login') }}">
          <p class="h5">{{ __('Login') }}</p>
        </a>
      </li>
      @if (Route::has('register'))
      <li class="nav-item">
        <a class="nav-link text-light ml-3" href="{{ route('register') }}">
          <p class="h5">{{ __('Register') }}</p>
        </a>
      </li>
      @endif
      @else
      <li class="nav-item">
        <a class="nav-link text-light mr-3" href="/home"><h6>Home</h6></a>
      </li>
      <li class="nav-item dropdown">
        <a id="navbarDropdown" class="nav-link dropdown-toggle text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
         {{ Auth::user()->name }} 
        </a>

        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
          <a class="dropdown-item text-dark" href="{{ route('logout') }}" onclick="event.preventDefault();
                                          document.getElementById('logout-form').submit();">
            {{ __('Logout') }}
          </a>

          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
          </form>
        </div>
      </li>
      @endguest
    </ul>


    <div id="pitch">
      <p class="text-light">Deforestation is one of the most serious environmental issues in Sri Lanka. In 1920, the island had a 49% percentage coverage of forests and by the end of 2005, this had fallen up to approximately 29%.</p>
    </div>
    <div id="main">
      <h2><a href="#">Lorem ipsum dolor sit amet</a></h2>
      <img src="images/img.gif" class="img left" alt="" />
      <p>Deforestation is one of the most serious environmental issues in Sri Lanka. In 1920, the island had a 49% percentage coverage of forests and by the end of 2005, this had fallen up to approximately 29%. In 1990 the national policy for wildlife conservation was approved and the prime objective of this policy was to enhance the sustainability of ecosystems. Sri Lanka also introduced a logging ban for all the natural forests under the forestry sector development program. </p>
      <p>To ensure the sustainability of this natural resource we need to have a proper system to solve the problems above mentioned, which are currently in the environment sector. One of the major issues of the current system is the mismanagement within the authorities which ultimately delay the whole process which is being done by the ministries. This is what leads the people to get work done through illegal means. By using a digitalized system, we can make the system more reliable. For example, data can be created only when they get a request to cut down a tree.</p>
      <p>By using our digitized platform we would be able to provide a system which provides reports and statistical data with better transparency, processing applications easily with the integrated environment which is embedded in the system and also a system which works under the rules, regulations and requirements expected by our client.</p>
      <div class="x"></div>
    </div>
    <div class="col last">
      <h4>Reforest Sri Lanka & LSF</h4>
      <div>
        <p>There is a necessity to capture and maintain data to ensure transparency in the system which would ensure proper procedure is carried out without being held down by administrative bureaucracy and political intervention. <a href="#">&raquo;</a></p>
        <p> The Ministry of Environment should have a simple transparent process to grant permission to cut down trees. The lack of clear documentation and transparency has allowed inefficiencies and mismanagement within such ministries to go unchecked.<a href="#">&raquo;</a></p>
        <p>By using our digitized platform we would be able to provide a system which provides reports and statistical data with better transparency, processing applications easily and also a system which works under the rules, regulations and requirements expected by our client.<a href="#">&raquo;</a></p>
      </div>
    </div>
  </div>


  <div id="secondmain">
    <br>
    <hr><br>
    <h2 style="text-align: center;">Quick Links</h2>
    <div class="row justify-content-center">
      <div class="card m-2" style="width: 18rem;">
        <img class="card-img-top" style="height:250px; width:287px;" src="images/tree.jpg" alt="Card image cap">
        <div class="card-body">
          <h5 class="card-title">Tree Removals</h5>
        </div>
        <div class="card-body">
          @if(auth()->user())
          @if(auth()->user()->role_id)
          <a href="{{ route('treeremoval') }}" class="btn lightpurp text-light">Submit a Tree Removal Form</a>
          @endif
          @else
          <a href="{{ route('login') }}" class="btn lightpurp text-light">Submit a Tree Removal Form</a>
          @endif
        </div>
      </div>

      <div class="card m-2" style="width: 18rem;">
        <img class="card-img-top" style="height:250px; width:287px;" src="images/dev.jpg" alt="Card image cap">
        <div class="card-body">
          <h5 class="card-title">Development Projects</h5>
        </div>
        <div class="card-body">
          @if(auth()->user())
          @if(auth()->user()->role_id)
          <a href="{{ route('devproject') }}" class="btn lightpurp text-light">Submit a Development Form</a>
          @endif
          @else
          <a href="{{ route('login') }}" class="btn lightpurp text-light">Submit a Development Form</a>
          @endif
        </div>
      </div>

      <div class="card m-2" style="width: 18rem;">
        <img class="card-img-top" style="height:250px; width:287px;" src="/images/restore2.jpg" alt="Card image cap">
        <div class="card-body">
          <h5 class="card-title">Restorations</h5>
        </div>
        <div class="card-body">
          @if(auth()->user())
          @if(auth()->user()->role_id)
          <a href="{{ route('envrestoration') }}" class="btn lightpurp text-light">Submit a Restoration Form</a>
          @endif
          @else
          <a href="{{ route('login') }}" class="btn lightpurp text-light">Submit a Restoration Form</a>
          @endif
        </div>
      </div>

      <div class="card m-2" style="width: 18rem;">
        <img class="card-img-top" style="height:250px; width:287px;" src="images/complain.jpg" alt="Card image cap">
        <div class="card-body">
          <h5 class="card-title">Complaints</h5>
        </div>
        <div class="card-body">
          @if(auth()->user())
          @if(auth()->user()->role_id)
          <a href="{{ route('crime') }}" class="btn lightpurp text-light">Make a Complaint</a>
          @endif
          @else
          <a href="{{ route('login') }}" class="btn lightpurp text-light">Make a Complaint</a>
          @endif
        </div>
      </div>
    </div>
    <br>
    <hr><br>

    <h2 style="text-align: center;">Blogs</h2>
    @for($i=0; $i<3; $i++) <div class="row justify-content-center mb-3">
      <div class="col-lg-11 card">
        <div class="row no-gutters">
          <div class="col-auto">
            <img src="//placehold.it/200" class="img-fluid" alt="">
          </div>
          <div class="col">
            <div class="card-block px-3">
              <p class="card-title h3 p-2">Title</p>
              <p class="card-text">Some quick example text to build on the carSome quick example text to build on the card title and make up the bulk of the card's content.d title and make up the bulk of the card's content.Some quick example text to build on the card title and make up the bulk of the card's content.</p>
              <a href="#" class="btn lightpurp text-white float-right">Read More</a>
            </div>
          </div>
        </div>
        <div class="card-footer bg-white w-100 text-muted">
          Author: Daniel Farst | Category: Illustration | Likes: 21
        </div>
      </div>
  </div>
  @endfor

  <br>
  <hr><br>
  <h2 style="text-align: center;">Our Progress</h2>
  <div class="row justify-content-center mb-3">
    <div class="col-lg-11 card">
      <canvas id="UserChart"></canvas>
    </div>
  </div>
  <div class="row justify-content-center mb-3">
    <div class="col-lg-11 card">
      <canvas id="processItemTypeChart"></canvas>
    </div>
  </div>
  </div>

  <div id="footer">
    <div class="d-flex  bg-light justify-content-end">
      <br>
      <a href="https://www.facebook.com/reforestsrilanka/" class="text-secondary mr-2">
        <i class="fab fa-facebook-square"></i> Facebook |
      </a>
      <a href="https://www.linkedin.com/company/reforest-sri-lanka/" class="text-secondary mr-2">
        <i class="fab fa-linkedin"></i> LinkedIn |
      </a>
      <a href="https://www.instagram.com/reforest_srilanka/?hl=en" class="text-secondary mr-2">
        <i class="fab fa-instagram"></i> Instagram |
      </a>
      <a href="https://medium.com/@achalaarunalu/reforest-sri-lanka-8e16cf5749de" class="text-secondary mr-2">
        <i class="fab fa-medium"></i> Medium |
      </a>
      <a href="http://www.reforestsrilanka.com/" class="text-secondary mr-2">ReforestSL</a>
    </div>
    <div class="d-flex bg-light justify-content-center">
      <h5 class="text-secondary"><i class="far fa-copyright"></i> 2021 by RFSL - LSF - Ministry of Environment</h5><br>
    </div>
    <div class="d-flex bg-light justify-content-center">
      <h6>All rights reserved</h6>
    </div>
  </div>
  <!--chart js -->
  <script src="{{ url('/vendor/chart.js/dist/Chart.min.js') }}"></script>
  <script src="{{ url('/vendor/chart.js/dist/Chart.extension.js') }}"></script>
  <script src="{{ url('/vendor/welcomepage-charts.js' ) }}"></script>
</body>

</html>