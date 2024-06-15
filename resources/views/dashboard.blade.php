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
        <div class="content">
            <h2>Welcome to your Dashboard</h2>

            <!-- File Upload Form -->
            <form method="POST" action="{{ route('file.preview') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="file">Upload File</label>
                    <input type="file" name="file" id="file" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Preview</button>
            </form>

            <!-- Display Uploaded Files -->
            <h2 class="mt-5">Files</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>File Name</th>
                        <th>Uploaded At</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($uploadedFiles as $index => $file)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $file->file_name }}</td>
                            <td>{{ date_format($file->created_at,"d-m-Y") }}</td>
                            <td>
                                <a href="{{ route('download_file', $file->id) }}" class="btn btn-success">View</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- File Preview Section -->
            @if(session('filePreview'))
                <h3>File Preview:</h3>
                <form method="POST" action="{{ route('file.upload') }}">
                    @csrf
                    <input type="hidden" name="file_path" value="{{ session('filePreview.file_path') }}">
                    <input type="hidden" name="file_name" value="{{ session('filePreview.file_name') }}">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                @foreach(session('filePreview.headers') as $header)
                                    <th>{{ $header }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach(session('filePreview.rows') as $row)
                                <tr>
                                    @foreach($row as $cell)
                                        <td>{{ $cell }}</td>
                                    @endforeach
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <button type="submit" class="btn btn-success">Submit</button>
                    <a class="btn btn-default btn-close" href="{{ route('file.cancel') }}">Cancel</a>
                </form>
            @endif
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>