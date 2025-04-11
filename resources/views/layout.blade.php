<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Laravel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <!-- Barre de navigation -->
    <nav class="bg-black text-white p-4">
        <div class="container flex justify-between items-center">
            <div class="space-x-4">
                <a href="/" class="text-white text-xl">Blog</a>
                <a href="{{ route('articles.create') }}" class="text-white text-xl">Créer un article</a>
            </div>
        </div>
    </nav>

    <!-- Contenu de la page -->
    <div class="container mt-4">
        @yield('content') <!-- Le contenu spécifique de chaque vue -->
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>