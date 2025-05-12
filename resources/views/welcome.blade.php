<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome to Finote</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Meta -->
    <meta name="description" content="Finote helps you manage your finances with clarity and control.">

    <!-- Favicon -->
    <link rel="icon" href="https://via.placeholder.com/64" type="image/png">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap & Animate -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet" />

    <!-- Custom Styles -->
    <style>
        :root {
            --bg: #0e0e0e;
            --accent: #ff9f43;
            --accent-dark: #ff7f0a;
            --text-light: #eaeaea;
            --card: #1c1c1c;
        }

        body {
            margin: 0;
            background-color: var(--bg);
            color: var(--text-light);
            font-family: 'Outfit', sans-serif;
            overflow-x: hidden;
            background-image: radial-gradient(circle at 20% 40%, rgba(255,159,67,0.06), transparent 30%),
                              radial-gradient(circle at 80% 80%, rgba(255,159,67,0.04), transparent 30%);
        }

        .hero {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 2rem;
        }

        .brand-title {
            font-size: 3.5rem;
            font-weight: 700;
            color: var(--accent);
            margin-bottom: 0.75rem;
        }

        .subtitle {
            font-size: 1.25rem;
            color: #b0b0b0;
            max-width: 600px;
            margin: 0 auto 2rem;
        }

        .btn-main {
            background-color: var(--accent);
            color: var(--bg);
            font-weight: 600;
            border-radius: 12px;
            padding: 14px 28px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 20px rgba(255, 159, 67, 0.3);
        }

        .btn-main:hover {
            background-color: var(--accent-dark);
            transform: translateY(-2px);
        }

        .btn-outline-light {
            border: 2px solid #fff;
            background: transparent;
            color: #fff;
            font-weight: 500;
            border-radius: 12px;
            padding: 14px 28px;
            transition: all 0.3s ease;
        }

        .btn-outline-light:hover {
            background: #fff;
            color: var(--bg);
        }

        .features {
            margin-top: 3rem;
            display: flex;
            justify-content: center;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .feature-box {
            background: var(--card);
            border-radius: 14px;
            padding: 1.5rem;
            width: 160px;
            text-align: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .feature-box:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(255, 159, 67, 0.1);
        }

        .feature-icon {
            font-size: 2rem;
            color: var(--accent);
            margin-bottom: 0.5rem;
        }

        @media (max-width: 768px) {
            .brand-title {
                font-size: 2.5rem;
            }
            .subtitle {
                font-size: 1rem;
            }
        }
    </style>
</head>
<body>

    <section class="hero">
        <div class="container animate__animated animate__fadeIn">
            <h1 class="brand-title animate__animated animate__fadeInDown">Finote.</h1>
            <p class="subtitle animate__animated animate__fadeIn animate__delay-1s">
                Smart & simple finance management. Track your money, stay in control, and reach your goals faster.
            </p>

            <div class="d-flex flex-column flex-md-row justify-content-center gap-3 mb-4 animate__animated animate__fadeInUp animate__delay-2s">
                <a href="{{ url('/admin/login') }}" class="btn btn-main btn-lg">Login</a>
                <a href="{{ url('/register') }}" class="btn btn-outline-light btn-lg">Register</a>
            </div>

            <div class="features animate__animated animate__fadeInUp animate__delay-3s">
                <div class="feature-box">
                    <div class="feature-icon">📊</div>
                    <div>Track Spending</div>
                </div>
                <div class="feature-box">
                    <div class="feature-icon">💡</div>
                    <div>Smart Budgets</div>
                </div>
                <div class="feature-box">
                    <div class="feature-icon">📈</div>
                    <div>Insights</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Bootstrap Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
