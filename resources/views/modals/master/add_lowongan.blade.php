<div>
    <dialog id="import_lowongan" class="modal">
        <div class="modal-box w-11/12 max-w-[55%]">
            <div class="mb-4 flex w-full items-center">
                <button class="btn btn-sm btn-circle btn-outline btn-warning left-4 top-4 text-lg">i</button>
                <h3 class="grow text-center text-xl font-bold">Tambah Lowongan</h3>
                <form method="dialog"><button class="btn btn-sm btn-circle btn-outline btn-error right-4 top-4">✕</button>
                </form>
            </div>

            <form action="" method="POST" class="flex min-w-full flex-col">
                @csrf
                <label class="input input-bordered mb-5 flex items-center gap-4">
                    Nama Lowongan
                    <input type="text" name="job_name" class="grow" placeholder="Bikin Kopi" />
                </label>
                <div id="criteria-container" class="overflow-scroll max-h-[40%]">
                    <div class="criteria-item mx-auto flex min-w-[90%] items-center justify-between rounded-2xl bg-[#e5e5e5] p-3 mb-6">
                        <select name="courses[]" class="select select-bordered w-full max-w-sm items-center text-lg font-bold">
                            <option disabled selected>Matakuliah</option>
                            <option>Implementasi Struktur Data</option>
                            <option>Pemrograman Berbasis Object</option>
                            <option>Sistem Basis Data 1</option>
                        </select>
                        <div class="min-w-[50%]">
                            <h1 class="text-base font-bold">Rentang Nilai</h1>
                            <input type="range" name="scores[]" min="10" max="100" value="10" class="range range-sm" step="10">
                            <div class="ml-1 flex w-full justify-between px-2 text-base font-semibold">
                                <span>10</span><span>20</span><span>30</span><span>40</span><span>50</span><span>60</span><span>70</span><span>80</span><span>90</span><span>100</span>
                            </div>
                        </div>
                        {{-- <button type="button" class="remove-criteria btn btn-error btn-">Hapus</button> --}}
                        <button type="button" class="remove-criteria btn btn-sm btn-circle btn-outline btn-error">✕</button>
                    </div>
                </div>
                <button type="button" id="add-criteria" class="btn btn-primary mt-4">Tambah Kriteria</button>
                <button type="submit" class="btn btn-success mt-4">Simpan</button>
            </form>
        </div>
    </dialog>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const container = document.getElementById('criteria-container');
        const addButton = document.getElementById('add-criteria');

        addButton.addEventListener('click', function() {
            const newItem = container.children[0].cloneNode(true);
            newItem.querySelector('select').selectedIndex = 0;
            newItem.querySelector('input[type="range"]').value = 10;
            container.appendChild(newItem);
        });

        container.addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-criteria')) {
                if (container.children.length > 1) {
                    e.target.closest('.criteria-item').remove();
                } else {
                    alert('Anda harus memiliki setidaknya satu kriteria.');
                }
            }
        });
    });
    </script>
</div>
