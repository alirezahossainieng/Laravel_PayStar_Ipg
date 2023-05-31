<nav class="navbar navbar-expand-lg bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active"  href="{{route('index.product')}}">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Link</a>
        </li>
        

      </ul>
      <div class="d-flex" >
        <ul class="navbar-nav me-auto mb-2 mb-lg-0 ">
          <li class="nav-item">
            @if (Auth::check())
            <a class="nav-link active"  href="{{route('logout')}}">
              <i class="fas fa-sign-out-alt"></i>
            </a>
            @else
            <a class="nav-link active"  href="{{route('login')}}">
              <i class="far fa-user"></i>
            </a>
            @endif
          </li>
          
          <li class="nav-item">
           
            <a class="nav-link position-relative" href="{{route('showcart')}}">
              <i class="fas fa-shopping-basket">
                @if (!empty($cart))
                @if ($cart->count >= 1)
                <span  class="position-absolute top--1 start-100 translate-middle badge rounded-pill bg-danger">
                  {{$cart->count}}
                @endif
                
                @endif
                <span class="visually-hidden">unread messages</span>
              </span></i>
            </a>
           
          </li>
          
  
          
        </ul>
      </div>
    </div>
  </div>
</nav>