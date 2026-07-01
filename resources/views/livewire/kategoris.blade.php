<div>
    @section('page-title', 'Kategori Barang')
    @section('page-description', 'Kelola kategori barang toko Anda')

    <div class="flex items-center justify-end mb-3">
        <button onclick="Livewire.dispatch('reset-form'); document.getElementById('modal-kategori').classList.remove('hidden')"
            class="bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white p-2 sm:px-5 rounded-xl font-medium transition-all duration-300 shadow-lg shadow-blue-500/25 hover:shadow-blue-500/40 flex items-center justify-center gap-2 text-sm sm:text-base w-full sm:w-auto">
            <i class="fa-solid fa-plus"></i> Tambah Kategori
        </button>
    </div>

    <livewire:kategori-list />

    <div id="modal-kategori" class="hidden fixed inset-0 z-50 flex items-center justify-center">
        <div class="absolute inset-0 bg-slate-900/40 backdrop-blur-sm"
            onclick="document.getElementById('modal-kategori').classList.add('hidden')">
        </div>

        <div class="relative bg-white rounded-2xl shadow-xl w-full max-w-md mx-4 p-6 z-10">


            <livewire:kategori-form />

        </div>
    </div>
</div>
@script
    <script>
        window.addEventListener('close-modal', () => {
            document.getElementById('modal-kategori').classList.add('hidden');
        });

        window.addEventListener('close-modal', () => {
            document.getElementById('modal-kategori').classList.add('hidden');
        });

        // Auto hide flash message setelah 3 detik
        document.addEventListener('livewire:navigated', autoHideFlash);
        document.addEventListener('DOMContentLoaded', autoHideFlash);
        document.addEventListener('livewire:updated', autoHideFlash);

        function autoHideFlash() {
            const flash = document.querySelectorAll('[data-flash]');
            flash.forEach(el => {
                setTimeout(() => {
                    el.style.transition = 'opacity 0.5s ease';
                    el.style.opacity = '0';
                    setTimeout(() => el.remove(), 500);
                }, 3000);
            });
        }

        window.addEventListener('open-modal', () => {
            document.getElementById('modal-kategori').classList.remove('hidden');
        });

        window.addEventListener('close-modal', () => {
            document.getElementById('modal-kategori').classList.add('hidden');
        });
    </script>
@endscript
