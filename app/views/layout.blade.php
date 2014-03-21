<html>
  <head>
    <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.3.0/pure-min.css" >
    <link rel="stylesheet" href="http://dev.sc2ctl.com/styles/style.css" >
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" >
    <script src="/scripts/jquery-2.0.3.min.js"></script>
    <title>Oralism @yield('title', '')</title>
  </head>
  <body>
    <nav class="pure-menu pure-menu-open pure-menu-horizontal">
      <a href="{{ URL::route('home') }}" class="pure-menu-heading">
        ORALISM
      </a>
      <ul>
        @if (Auth::check() && Auth::user()->isAdmin())
          <li>
            <a href="{{ URL::route('user.index') }}">
              User Management
            </a>
          </li>
          <li>
            <a href="#">
              Reports
            </a>
          </li>
        @endif

        @if (Auth::check() && Auth::user()->isRadiologist())
          <li>
            <a href="{{ URL::route('record.create') }}">
              Upload
            </a>
          </li>
        @endif

        @if (Auth::check())
          <li>
            <a href="{{ URL::route('user.edit', Auth::user()->person_id) }}">
              Edit Info
            </a>
          </li>
          <li>
            <a href="{{ URL::route('logout') }}">
              Log out {{ Auth::user()->user_name }}
            </a>
          </li>
        @else
          <li>
            <a href="{{ URL::route('login') }}">
              Log in
            </a>
          </li>
        @endif
      </ul>
    </nav>
    @yield('content')
  </body>
</html>
