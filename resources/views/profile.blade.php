<!-- resources/views/user/profile.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      display: flex;
      min-height: 100vh;
      flex-direction: column;
    }

    .wrapper {
      display: flex;
      flex: 1;
    }

    .sidebar {
      width: 250px;
      background: #343a40;
      color: white;
      padding: 15px;
    }

    .content {
      flex: 1;
      padding: 20px;
    }

    .navbar {
      background: #343a40;
    }
  </style>
</head>

<body>
  <!-- Horizontal Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark">
    <a class="navbar-brand" href="#">Dashboard</a>
    <div class="collapse navbar-collapse">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" href="{{ route('logout') }}"
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            Logout
          </a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
          </form>
        </li>
      </ul>
    </div>
  </nav>

  <!-- Wrapper -->
  <div class="wrapper">
    <!-- Sidebar -->
    <div class="sidebar">
      <h4>Menu</h4>
      <ul class="nav flex-column">
        <li class="nav-item">
          <a class="nav-link text-white" href="{{ route('dashboard')}}">Dashboard</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="{{ route('profile')}}">Profile</a>
        </li>

      </ul>
    </div>

    <!-- Content -->
    <div class="container mt-5">
      <div class="card">
        <div class="card-header">
          <h3>User Profile</h3>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-4">
              <img src="https://via.placeholder.com/150" class="img-fluid" alt="User Avatar">
            </div>
            <div class="col-md-8">
              <table class="table">
                <tr>
                  <th>Name:</th>
                  <td>{{ $userProfile->name }}</td>
                </tr>
                <tr>
                  <th>Email:</th>
                  <td>{{ $userProfile->email }}</td>
                </tr>
                <tr>
                  <th>Role:</th>

                </tr>
                <tr>
                  <th>Joined:</th>
                  <td>{{ $userProfile->created_at->format('d M Y') }}</td>
                </tr>
              </table>
              <a href="{{ route('logout') }}" class="btn btn-danger"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                Logout
              </a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>