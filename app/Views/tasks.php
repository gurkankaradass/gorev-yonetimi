<?= $this->extend('layout') ?>

<?= $this->section('content') ?>

<div x-data="todoApp(<?= htmlspecialchars(json_encode($tasks)) ?>)" class="max-w-4xl mx-auto space-y-6">
    <div class="bg-white p-4 rounded-xl shadow-sm border flex flex-col md:flex-row gap-4 justify-between items-center">
        <div class="relative w-full md:w-1/2">
            <input type="text" x-model="search" placeholder="Görevlerde veya açıklamalarda ara..." class="w-full pl-10 pr-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none transition">
            <span class="absolute left-3 top-2.5 text-gray-400 font-bold">🔍</span>
        </div>

        <div class="flex gap-2">
            <button @click="filterStatus = 'all'" :class="filterStatus === 'all' ? 'bg-blue-600 text-white' : 'bg-gray-100'" class="px-4 py-2 rounded-lg text-sm transition">Hepsi</button>
            <button @click="filterStatus = 'pending'" :class="filterStatus === 'pending' ? 'bg-blue-600 text-white' : 'bg-gray-100'" class="px-4 py-2 rounded-lg text-sm transition">Bekleyenler</button>
            <button @click="filterStatus = 'completed'" :class="filterStatus === 'completed' ? 'bg-blue-600 text-white' : 'bg-gray-100'" class="px-4 py-2 rounded-lg text-sm transition">Tamamlananlar</button>
        </div>
    </div>

    <div class="text-right">
        <button @click="openForm = !openForm" class="bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700 transition shadow-md">
            + Yeni Görev
        </button>
    </div>

    <div x-show="openForm"
        x-transition
        class="bg-white p-6 rounded-xl border shadow-sm">
        <form action="<?= base_url('tasks/create') ?>" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <?= csrf_field() ?>
            <div class="md:col-span-2">
                <label class="text-sm font-semibold">Başlık</label>
                <input type="text" name="title" required class="w-full p-2 border rounded mt-1">
            </div>
            <div>
                <label class="text-sm font-semibold">Kategori</label>
                <select name="category_id" class="w-full p-2 border rounded mt-1">
                    <?php foreach ($categories as $cat): ?>
                        <option value="<?= $cat['id'] ?>"><?= $cat['name'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div>
                <label class="text-sm font-semibold">Açıklama</label>
                <input type="text" name="description" class="w-full p-2 border rounded mt-1">
            </div>
            <button type="submit" class="md:col-span-2 bg-green-600 text-white py-2 rounded-lg font-bold">
                Kaydet
            </button>
        </form>
    </div>

    <div class="grid gap-4">
        <template x-for="task in filteredTasks" :key="task.id">
            <div class="bg-white p-4 rounded-xl border shadow-sm flex justify-between items-center transition hover:shadow-md">
                <div class="flex items-center gap-4">
                    <span :class="task.category_color" class="w-2 h-10 rounded-full"></span>
                    <div>
                        <h3 :class="task.status === 'completed' ? 'line-through text-gray-400' : 'font-bold text-gray-800'" x-text="task.title"></h3>
                        <div class="flex gap-2 items-center">
                            <span class="text-[10px] font-bold uppercase tracking-wider text-gray-400" x-text="task.category_name || 'Genel'"></span>
                            <span class="text-gray-300">•</span>
                            <p class="text-xs text-gray-500" x-text="task.description"></p>
                        </div>
                    </div>
                </div>

                <div class="flex gap-3">
                    <a :href="'<?= base_url('tasks/complete/') ?>' + task.id" class="text-green-500 hover:scale-110 transition">✔</a>
                    <a :href="'<?= base_url('tasks/delete/') ?>' + task.id" onclick="return confirm('Silmek istediğinize emin misiniz?')" class="text-red-400 hover:scale-110 transition">🗑</a>
                </div>
            </div>
        </template>

        <div x-show="filteredTasks.length === 0" class="text-center py-10 text-gray-400 italic">
            Aradığınız kriterlere uygun görev bulunamadı.
        </div>
    </div>
</div>

<script>
    function todoApp(initialTasks) {
        return {
            tasks: initialTasks,
            search: '',
            filterStatus: 'all',
            openForm: false,

            // Burası Alpine'in "Büyüsü": filteredTasks değiştikçe ekran otomatik yenilenir
            get filteredTasks() {
                return this.tasks.filter(task => {
                    const title = task.title.toLowerCase();
                    const desc = (task.description || '').toLowerCase();
                    const query = this.search.toLowerCase();

                    const matchesSearch = title.includes(query) || desc.includes(query);
                    const matchesStatus = this.filterStatus == 'all' || task.status === this.filterStatus;

                    return matchesSearch && matchesStatus;
                });
            }
        }
    }
</script>

<?= $this->endSection() ?>