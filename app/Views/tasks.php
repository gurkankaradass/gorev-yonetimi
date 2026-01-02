<?= $this->extend('layout') ?>

<?= $this->section('content') ?>

<div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-xl font-semibold mb-4">Görevler</h2>

    <div x-data="{open: false}"
        x-transition
        class="mt-4 p-4 border rounded bg-gray-50 shadow-inner">
        <form action="<?= base_url('tasks/create') ?>" method="POST">
            <?= csrf_field() ?> <div class="mb-3">
                <label class="block text-sm font-medium mb-1">Görev Başlığı</label>
                <input type="text" name="title" required class="w-full p-2 border rounded focus:ring-2 focus:ring-blue-500 outline-none">
            </div>

            <div class="mb-3">
                <label class="block text-sm font-medium mb-1">Açıklama</label>
                <textarea name="description" class="w-full p-2 border rounded outline-none" rows="2"></textarea>
            </div>

            <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700 transition">
                Kaydet
            </button>
        </form>
    </div>

    <ul class="mt-6 divide-y divide-gray-200">
        <?php if (!empty($tasks)): ?>
            <?php foreach ($tasks as $task): ?>
                <li class="py-3 justify-between items-center group">
                    <div>
                        <h3 class="font-medium <?= $task['status'] === 'complated' ? 'line-through text-gray-400' : '' ?>">
                            <?= esc($task['title']) ?>
                        </h3>
                        <p class="text-sm text-gray-500"><?= esc($task['description']) ?></p>
                    </div>

                    <div class="flex items-center gap-2">
                        <span class="text-sm px-2 py-1 rounded <?= $task['status'] === 'complated' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' ?>">
                            <?= $task['status'] === 'complated' ? 'Tamamlandı' : "Beklemede" ?>
                        </span>
                    </div>
                </li>
            <?php endforeach; ?>
        <?php else: ?>
            <li class="py-4 text-center text-gray-500 italic">Henüz bir görev eklenmemiş.</li>
        <?php endif; ?>
    </ul>
</div>

<?= $this->endSection() ?>