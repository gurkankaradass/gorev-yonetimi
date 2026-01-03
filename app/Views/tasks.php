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
                        <div class="flex">
                            <h3 class="font-medium <?= $task['status'] === 'complated' ? 'line-through text-gray-400' : '' ?>">
                                <?= esc($task['title']) ?>
                            </h3>
                            <span class="text-[10px] uppercase font-bold ml-3 px-2 py-1 rounded <?= $task['status'] === 'completed' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' ?>">
                                <?= $task['status'] === 'completed' ? 'Tamamlandı' : 'Beklemede' ?>
                            </span>
                            <div class="flex items-center gap-2">
                                <a href="<?= base_url('tasks/complete/' . $task['id']) ?>"
                                    class="p-1 rounded-full hover:bg-gray-100 transition shadow-sm"
                                    title="Durumu Değiştir">
                                    <?php if ($task['status'] === 'completed'): ?>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-500" fill-none viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    <?php else: ?>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-300 hover:text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    <?php endif; ?>
                                </a>
                                <a href="<?= base_url('tasks/delete/' . $task['id']) ?>"
                                    onclick="return confirm('Bu görevi silmek istediğinize emin misiniz?')"
                                    class="p-1 rounded-full hover:bg-red-100 text-gray-300 hover:text-red-500 transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                        <p class="text-sm text-gray-500"><?= esc($task['description']) ?></p>
                    </div>



                </li>
            <?php endforeach; ?>
        <?php else: ?>
            <li class="py-4 text-center text-gray-500 italic">Henüz bir görev eklenmemiş.</li>
        <?php endif; ?>
    </ul>
</div>

<?= $this->endSection() ?>