    <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
      <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="#page-top" ><img src="img/sample.png">bidpro</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="#about">About</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="#services">Services</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="#portfolio">Portfolio</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="#contact">Contact</a>
            </li>
            @if(Auth::user())
             <!-- Dropdown -->
              <li class="nav-item dropdown">
               <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                 {{ Auth::user()->name }}
                </a>
                 <div class="dropdown-menu">
                  <a class="dropdown-item" href="#">Link 1</a>
                   <a class="dropdown-item" href="#">Link 2</a>
                   <a class="dropdown-item" href="{{ route('logout') }}">Logout</a>
                    </div>
                  </li>
            @else
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="{{ route('login') }}">Login</a>
            </li>
             <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="{{ route('register') }}">Sign Up</a>
            </li>
             @endif
          </ul>
        </div>
      </div>
    </nav>
