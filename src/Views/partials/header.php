<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Golap-Canon | Elegance in Every Bloom</title>
    <!-- 2026 Modern Stack -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&family=Playfair+Display:ital,wght@0,700;1,500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <style>
        :root {
            --primary-rose: #b01851;
            --secondary-emerald: #2b6954;
            --soft-cream: #fff8ef;
            --surface-white: #ffffff;
        }
        body { font-family: 'Montserrat', sans-serif; background-color: var(--soft-cream); color: #1e1b13; }
        h1, h2, h3, .serif { font-family: 'Playfair Display', serif; }
        
        /* Premium UI Elements */
        .glass-nav { background: rgba(255, 248, 239, 0.85); backdrop-filter: blur(10px); border-bottom: 1px solid rgba(140, 112, 117, 0.1); }
        .ambient-shadow { box-shadow: 0 20px 40px rgba(43, 105, 84, 0.05); border: none; transition: 0.4s ease; }
        .ambient-shadow:hover { transform: translateY(-10px); box-shadow: 0 30px 60px rgba(43, 105, 84, 0.1); }
        .btn-rose { background: var(--primary-rose); color: white; border-radius: 50px; padding: 12px 35px; border: none; font-weight: 600; letter-spacing: 1px; }
        .text-rose { color: var(--primary-rose); }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg glass-nav sticky-top py-3">
    <div class="container">
        <a class="navbar-brand serif h3 mb-0 text-rose fw-bold" href="/">Golap-Canon</a>
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
            <span class="bi bi-list fs-1 text-rose"></span>
        </button>
        <div class="collapse navbar-collapse" id="mainNav">
            <ul class="navbar-nav mx-auto text-uppercase small fw-bold">
                <li class="nav-item"><a class="nav-link px-3" href="/shop">Shop</a></li>
                <li class="nav-item"><a class="nav-link px-3" href="#">Weddings</a></li>
                <li class="nav-item"><a class="nav-link px-3" href="#">Events</a></li>
                <li class="nav-item"><a class="nav-link px-3" href="#">Contact</a></li>
            </ul>
            <div class="d-flex align-items-center gap-4">
                <a href="/cart" class="position-relative text-dark">
                    <i class="bi bi-bag fs-4"></i>
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" id="cart-count">0</span>
                </a>
                <a href="/login" class="btn btn-rose d-none d-lg-block">Book Consultation</a>
            </div>
        </div>
    </div>
</nav>