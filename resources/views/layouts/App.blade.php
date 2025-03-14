<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>G-Scores</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Rubik', sans-serif;
        }
        .navbar {
            background-color: #007bff;
        }
        .navbar-brand {
            font-size: 30px;
            font-weight: 700;
        }
        .navbar-brand, .nav-link {
            color: #fff !important;
        }
        /* Sidebar */
        .sidebar {
            background: linear-gradient(45deg, #ff0000, #ff7f00, #ffff00, #00ff00, #0000ff, #4b0082, #8b00ff);
            background-size: 400% 400%;
            animation: gradient 15s ease infinite;
            color: #fff;
            height: 100vh;
            padding: 20px;
            width: 250px;
            transition: width 0.3s ease-in-out;
            position: fixed;
            left: 0;
            top: 0;
            z-index: 1000;
        }
        @keyframes gradient {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        /* Khi sidebar thu nhỏ */
        .sidebar.small {
            width: 70px;
            overflow: hidden;
        }
        .sidebar.small h4,
        .sidebar.small .nav-item a {
            display: none; /* Ẩn nội dung khi sidebar thu nhỏ */
        }
        /* Button Toggle */
        .toggle-btn {
            position: absolute;
            right: 10px;
            top: 10px;
            background: #007bff;
            color: white;
            border: none;
            padding: 10px 15px;
            font-size: 18px;
            cursor: pointer;
            z-index: 1100;
            border-radius: 5px;
        }
        /* Nội dung chính */
        .content {
            padding: 20px;
            margin-left: 250px;
            transition: margin-left 0.3s ease-in-out;
        }
        .content.small {
            margin-left: 70px;
        }
        /* Thiết kế đáp ứng cho màn hình nhỏ */
        @media (max-width: 768px) {
            
            .sidebar h4,
            .sidebar .nav-item a {
                
                width: 100%;
            }
            .sidebar .small .nav-item a {
                display: none;
            }
            .content {
                margin-left: 70px;
            }
        }
    </style>
</head>
<body>
    {{-- <button class="toggle-btn" onclick="toggleSidebar()">☰</button> --}}
    <div id="loading-overlay" class="d-none" style="
    position: fixed; top: 0; left: 0; width: 100%; height: 100%;
    background: rgba(255, 255, 255, 0.7); display: flex; align-items: center; 
    justify-content: center; z-index: 2000;">
    <div class="spinner-border text-primary" role="status">
        <span class="sr-only">Loading...</span>
    </div>
</div>

    <nav class="navbar navbar-expand-lg navbar-dark justify-content-center">
        <a class="navbar-brand" href="#">G-Scores</a>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12 col-lg-2 sidebar" id="sidebar">
                <button class="toggle-btn" onclick="toggleSidebar()">☰</button>
                <h4>Menu</h4>
                <ul class="nav flex-column">
                    <li class="nav-item"><a class="nav-link" href="/">Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link" href="/search-scores">Search Scores</a></li>
                    <li class="nav-item"><a class="nav-link" href="/reports">Reports</a></li>
                    <li class="nav-item"><a class="nav-link" href="/settings">Settings</a></li>
                </ul>
            </div>
            <div class="col-md-10 content" id="content">
                <div class="centered-content">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>

    <script>
        function toggleSidebar() {
            document.getElementById("sidebar").classList.toggle("small");
            document.getElementById("content").classList.toggle("small");
        }
        document.addEventListener("DOMContentLoaded", function() {
        let loadingOverlay = document.getElementById("loading-overlay");

       

    // Ẩn spinner sau khi trang đã tải hoàn toàn
    window.addEventListener("load", function() {
        loadingOverlay.classList.add("d-none");
    });
    // Khi người dùng làm mới trang hoặc điều hướng, hiển thị lại loading
    window.addEventListener("beforeunload", function (event) {
    let isExporting = event.target.activeElement.id === "export-btn";
    if (!isExporting) {
        loadingOverlay.classList.remove("d-none");
    }
});



  
});
 
    </script>
</body>
</html>
