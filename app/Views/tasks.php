<?= $this->extend('layout') ?>

<?= $this->section('content') ?>

<div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-xl font-semibold mb-4">Görevler</h2>

    <div x-data="{open: false}">
        <button @click="open = !open" class="bg-green-500 text-white px-4 py-2 rounded">
            Yeni Görev Ekle
        </button>

        <div x-show="open" class="mt-4 p-4 border rounded bg-gray-50">
            <p>Burada görev ekleme formu olacak (Çok yakında!)</p>
        </div>
    </div>

    <ul class="mt-6 divide-y divide-gray-200">
        <li class="py-3 justify-between items-center">
            <span>Örnek Görev: Migration tamamla</span>
            <span class="text-xs bg-yellow-100 text-yellow-800 px-2 py-1 rounded">Beklemede</span>
        </li>
    </ul>
</div>

<?= $this->endSection() ?>