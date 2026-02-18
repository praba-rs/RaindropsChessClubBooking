<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome | Raindrops Chess Club</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .hero {
            background: url('https://images.unsplash.com/photo-1586165368502-1bad197a6461') center center/cover no-repeat;
            height: 90vh;
            color: white;
            display: flex;
            align-items: center;
            text-align: center;
        }
        .hero-overlay {
            background: rgba(0, 0, 0, 0.6);
            width: 100%;
            padding: 50px 20px;
        }
        .section-padding {
            padding: 60px 0;
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand fw-bold" href="#">Raindrops Chess Club</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link active" href="#">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="#">About</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Programs</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Contact</a></li>
            </ul>
        </div>
    </div>
</nav>

<!-- Hero Section -->
<section class="hero">
    <div class="hero-overlay">
        <div class="container">
            <h1 class="display-4 fw-bold">Welcome to Our Chess Club</h1>
            <p class="lead mt-3">Sharpen Your Mind. Build Strategy. Master the Game.</p>
            <a href="joinclub.php" class="btn btn-warning btn-lg mt-4">Join Now</a>
        </div>
    </div>
</section>

<!-- About Section -->
<section class="section-padding bg-light">
    <div class="container text-center">
        <h2 class="mb-4">About Our Club</h2>
        <p class="lead">
            Our Chess Club is dedicated to nurturing strategic thinking and problem-solving skills. 
            We welcome players of all ages and skill levels — from beginners to advanced competitors.
        </p>
    </div>
</section>

<!-- Programs Section -->
<section class="section-padding">
    <div class="container">
        <div class="row text-center">
            <h2 class="mb-5">Our Programs</h2>

            <div class="col-md-4 mb-4">
                <div class="card shadow h-100">
                    <div class="card-body">
                        <h5 class="card-title">Beginner Classes</h5>
                        <p class="card-text">
                            Learn the basics of chess, rules, and simple strategies.
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="card shadow h-100">
                    <div class="card-body">
                        <h5 class="card-title">Intermediate Training</h5>
                        <p class="card-text">
                            Improve tactics, openings, and endgame techniques.
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="card shadow h-100">
                    <div class="card-body">
                        <h5 class="card-title">Tournaments</h5>
                        <p class="card-text">
                            Participate in competitive tournaments and championships.
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- Footer -->
<footer class="bg-dark text-white text-center py-3">
    <p class="mb-0">© 2026 Chess Club | All Rights Reserved</p>
</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
