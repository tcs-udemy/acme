<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="/">Acme</a>
    </div>
    <div id="navbar" class="collapse navbar-collapse">
      <ul class="nav navbar-nav">
        <li class="active"><a href="/">Home</a></li>
        <li><a href="/about-acme">About</a></li>
        <li><a href="/register">Register</a></li>
        <li><a href="/testimonials">Testimonials</a></li>
        @if(Acme\auth\LoggedIn::user())
            <li><a href="/add-testimonial">Add a Testimonial</a></li>
        @endif
      </ul>
      <ul class="nav navbar-nav navbar-right">
          @if(Acme\auth\LoggedIn::user())
          <li class="dropdown">
            <a id="drop1" href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
              Admin
              <span class="caret"></span>
            </a>
            <ul class="dropdown-menu" aria-labelledby="drop1">
              <li><a href="#">Edit Page</a></li>
              <li role="separator" class="divider"></li>
              <li><a href="#">Separated link</a></li>
            </ul>
          </li>
            <li>
                <a href="/logout">
                    <span class="glyphicon glyphicon-lock" aria-hidden="true"></span> Logout
                </a>
            </li>
          @else
            <li>
                <a href="/login">
                    <span class="glyphicon glyphicon-lock" aria-hidden="true"></span> Login
                </a>
            </li>
          @endif
      </ul>
    </div><!--/.nav-collapse -->
  </div>
</nav>
