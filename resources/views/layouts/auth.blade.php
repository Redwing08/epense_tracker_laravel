<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Republic of the Philippines - National Treasury Portal</title>
    
    <!-- Bootstrap 5 CSS & Google Fonts -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Merriweather:wght@400;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --gov-maroon: #800000;
            --gov-dark-maroon: #4a0000;
            --gov-gold: #c5a059;
            --gov-dark: #111111;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #0f1115 0%, #2b0000 100%);
            color: #212529;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
            padding: 20px;
        }

        .auth-wrapper {
            width: 100%;
            max-width: 480px;
        }

        .official-seal {
            font-size: 2.2rem;
            line-height: 1;
        }
    </style>
</head>
<body>

    <div class="auth-wrapper">
        @yield('content')
        
        <div class="text-center mt-4 text-white-50" style="font-size: 0.72rem; letter-spacing: 0.5px;">
            REPUBLIC OF THE PHILIPPINES &bull; ALL RIGHTS RESERVED 2026<br>
            BUREAU OF THE TREASURY FINANCIAL MANAGEMENT INFORMATION SYSTEM
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>