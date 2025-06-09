
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BENIN EXCELLENCE</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
            line-height: 1.5;
            color: #1a1a1a;
        }

        .navbar {
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
            padding: 1rem;
            transition: all 0.3s ease;
            background: transparent;
        }

        .navbar.scrolled {
            background: white;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1rem;
        }

        .nav-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            display: flex;
            align-items: center;
            font-weight: 700;
            font-size: 1.25rem;
            color: white;
        }

        .scrolled .logo {
            color: #1a1a1a;
        }

        .nav-links {
            display: none;
        }

        @media (min-width: 768px) {
            .nav-links {
                display: flex;
                gap: 2rem;
            }

            .nav-links a {
                color: white;
                text-decoration: none;
                font-weight: 500;
                transition: color 0.2s;
            }

            .scrolled .nav-links a {
                color: #1a1a1a;
            }

            .nav-links a:hover {
                color: #3b82f6;
            }
        }

        .hero {
            background: linear-gradient(135deg, #0069d9, #6610f2);
            padding: 8rem 1rem 4rem;
            text-align: center;
            color: white;
        }

        .hero-content {
            max-width: 800px;
            margin: 0 auto;
        }

        .hero h1 {
            font-size: 2.5rem;
            margin-bottom: 1rem;
            animation: fadeIn 0.8s ease-out forwards;
        }

        .hero h2 {
            font-size: 1.5rem;
            margin-bottom: 2rem;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-top: 3rem;
        }

        .stat-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            padding: 1.5rem;
            border-radius: 0.75rem;
            text-align: center;
        }

        .stat-card h3 {
            font-size: 2rem;
            margin-bottom: 0.5rem;
        }

        .features {
            padding: 4rem 1rem;
            background: white;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 2rem;
            margin-top: 3rem;
        }

        .feature-card {
            background: #f8f9fa;
            padding: 2rem;
            border-radius: 0.75rem;
            transition: transform 0.3s ease;
        }

        .feature-card:hover {
            transform: translateY(-5px);
        }

        .feature-icon {
            width: 48px;
            height: 48px;
            margin-bottom: 1rem;
            color: #3b82f6;
        }

        .carousel {
            position: relative;
            height: 400px;
            overflow: hidden;
            margin: 4rem 0;
        }

        .carousel-slide {
            position: absolute;
            width: 100%;
            height: 100%;
            opacity: 0;
            transition: opacity 0.5s ease-in-out;
        }

        .carousel-slide.active {
            opacity: 1;
        }

        .carousel-slide img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .carousel-caption {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 1.5rem;
            background: linear-gradient(transparent, rgba(0,0,0,0.7));
            color: white;
        }

        .carousel-buttons {
            position: absolute;
            bottom: 1rem;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            gap: 0.5rem;
            z-index: 10;
        }

        .carousel-dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background: rgba(255,255,255,0.5);
            cursor: pointer;
            border: none;
        }

        .carousel-dot.active {
            background: white;
        }

        .footer {
            background: #1a1a1a;
            color: white;
            padding: 4rem 1rem 2rem;
        }

        .footer-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            margin-bottom: 3rem;
        }

        .footer-links h4 {
            margin-bottom: 1rem;
            font-size: 1.25rem;
        }

        .footer-links ul {
            list-style: none;
        }

        .footer-links a {
            color: #9ca3af;
            text-decoration: none;
            transition: color 0.2s;
        }

        .footer-links a:hover {
            color: white;
        }

        .copyright {
            text-align: center;
            padding-top: 2rem;
            border-top: 1px solid #374151;
            color: #9ca3af;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .btn {
            display: inline-block;
            padding: 0.75rem 1.5rem;
            border-radius: 0.5rem;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .btn-primary {
            background: white;
            color: #0069d9;
        }

        .btn-primary:hover {
            background: #f8f9fa;
        }

        .btn-outline {
            border: 2px solid white;
            color: white;
        }

        .btn-outline:hover {
            background: rgba(255,255,255,0.1);
        }

        .buttons {
            display: flex;
            gap: 1rem;
            justify-content: center;
            flex-wrap: wrap;
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="container">
            <div class="nav-content">
                <div class="logo">
                    BENIN EXCELLENCE
                </div>
                <div class="nav-links">
                    <a href="{{ route('dashboard') }}">Tableau de Bord</a>
                    <a href="{{ route('livres.index') }}">Livres</a>
                    <a href="{{ route('abonnes.index') }}">Abonnés</a>
                    <a href="{{ route('abonnements.index') }}">Abonnements</a>
                    <a href="{{ route('prets.index') }}">Prêts</a>
                    {{-- <a href="#">Rapports</a> --}}
                </div>
            </div>
        </div>
    </nav>

    <section class="hero">
        <div class="container">
            <div class="hero-content">
                <h1>👋 Bienvenue sur la page  Administrative</h1>
                <h2>Bibliothèque <strong>BENIN EXCELLENCE</strong></h2>
                
                <div class="stats-grid">
                    <div class="stat-card">
                        <h3>15,000+</h3>
                        <p>Livres en Collection</p>
                    </div>
                    <div class="stat-card">
                        <h3>5,000+</h3>
                        <p>Membres Actifs</p>
                    </div>
                    <div class="stat-card">
                        <h3>120,000+</h3>
                        <p>Prêts Annuels</p>
                    </div>
                    <div class="stat-card">
                        <h3>98%</h3>
                        <p>Taux de Satisfaction</p>
                    </div>
                </div>

                <div class="buttons" style="margin-top: 2rem;">
                    <a href="{{route('dashboard')}}" class="btn btn-primary">Accéder au Tableau de Bord</a>
                    <a href="#All" class="btn btn-outline">Explorer les Fonctionnalités</a>
                </div>
            </div>
        </div>
    </section>

    <div class="carousel">
        <div class="carousel-slide active">
            <img src="https://images.pexels.com/photos/1290141/pexels-photo-1290141.jpeg" alt="Bibliothèque">
            <div class="carousel-caption">
                <h3>Une collection diversifiée pour tous les lecteurs</h3>
            </div>
        </div>
        <div class="carousel-slide">
            <img src="https://images.pexels.com/photos/159711/books-bookstore-book-reading-159711.jpeg" alt="Bibliothèque">
            <div class="carousel-caption">
                <h3>Des milliers d'ouvrages à découvrir</h3>
            </div>
        </div>
        <div class="carousel-slide">
            <img src="https://images.pexels.com/photos/256431/pexels-photo-256431.jpeg" alt="Bibliothèque">
            <div class="carousel-caption">
                <h3>Un espace moderne dédié au savoir</h3>
            </div>
        </div>
        <div class="carousel-buttons">
            <button class="carousel-dot active"></button>
            <button class="carousel-dot"></button>
            <button class="carousel-dot"></button>
        </div>
    </div>

    <section class="features">
        <div class="container">
            <h2 id="All" style="text-align: center; font-size: 2rem; margin-bottom: 2rem;">Fonctionnalités Principales</h2>
            <div class="features-grid">
                <div class="feature-card">
                    <h3>Gestion des Livres</h3>
                    <p>Cataloguez et suivez tous les livres de votre collection avec facilité.</p>
                </div>
                <div class="feature-card">
                    <h3>Gestion des abonnés et abonnements</h3>
                    <p>Gérez les informations des abonnés, leur abonnément et leur historique d'emprunts.</p>
                </div>
                <div class="feature-card">
                    <h3>Suivi des Prêts</h3>
                    <p>Surveillez les emprunts actuels et les retours à venir.</p>
                </div>
                <div class="feature-card">
                    <h3>Statistiques</h3>
                    <p>Analysez les tendances de lecture et optimisez votre inventaire.</p>
                </div>
            </div>
        </div>
    </section>

    <footer class="footer">
        <div class="container">
            <div class="footer-grid">
                <div class="footer-links">
                    <h4>À Propos</h4>
                    <p style="color: #9ca3af; margin-bottom: 1rem;">
                        Votre bibliothèque de référence au service de l'excellence et du savoir depuis 1995.
                    </p>
                </div>
                <div class="footer-links">
                    <h4>Liens Rapides</h4>
                    <ul>
                        <li><a href="#">Accueil</a></li>
                        <li><a href="#">Catalogue</a></li>
                        <li><a href="#">Services</a></li>
                        <li><a href="#">Contact</a></li>
                    </ul>
                </div>
                <div class="footer-links">
                    <h4>Contact</h4>
                    <ul>
                        <li style="color: #9ca3af;">123 Avenue de la République</li>
                        <li style="color: #9ca3af;">Cotonou, Bénin</li>
                        <li style="color: #9ca3af;">+229 XX XX XX XX</li>
                        <li style="color: #9ca3af;">contact@beninexcellence.org</li>
                    </ul>
                </div>
            </div>
            <div class="copyright">
                <p>&copy; 2025 Bibliothèque BENIN EXCELLENCE. Tous droits réservés.</p>
            </div>
        </div>
    </footer>

    <script>
        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 10) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });

        // Carousel functionality
        const slides = document.querySelectorAll('.carousel-slide');
        const dots = document.querySelectorAll('.carousel-dot');
        let currentSlide = 0;

        function showSlide(index) {
            slides.forEach(slide => slide.classList.remove('active'));
            dots.forEach(dot => dot.classList.remove('active'));
            
            slides[index].classList.add('active');
            dots[index].classList.add('active');
        }

        dots.forEach((dot, index) => {
            dot.addEventListener('click', () => {
                currentSlide = index;
                showSlide(currentSlide);
            });
        });

        // Auto-advance carousel
        setInterval(() => {
            currentSlide = (currentSlide + 1) % slides.length;
            showSlide(currentSlide);
        }, 5000);
    </script>
</body>
</html>