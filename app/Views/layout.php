<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Görev Yönetimi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="bg-gray-100 text-gray-900">
    <nav class="bg-blue-600 p-4 text-white shadow-lg">
        <div class="container mx-auto">
            <h1 class="text-2xl font-bold">Görev Takip Uygulaması</h1>
        </div>
    </nav>

    <main class="container mx-auto mt-10 p-4">
        <?= $this->renderSection('content') ?>
    </main>

    <footer class="mt-20 text-center text-gray-500 text-sm">
        CodeIgniter & Alpine.js Projesi - 2026
    </footer>

</body>

</html>