<div>

    <div class="w-full bg-[#eeeeee] p-4 rounded-xl shadow-xl mb-8">
        <div class="flex justify-between px-3">
            <h1 class="text-3xl font-bold mb-6 text-gray-700">Lowongan</h1>
            <button class="btn" onclick="import_lowongan.showModal()">Tambah Lowongan</button>
        </div>
        @include('table.tb_lowongan')
    </div>

    <div class="w-full bg-[#eeeeee] p-4 rounded-xl shadow-xl mb-8">
        <div class="flex justify-between px-3">
            <h1 class="text-3xl font-bold mb-6 text-gray-700">Kandidat</h1>
            <button class="btn" onclick="importAltModal.showModal()">Tambah Kandidat</button>
        </div>
        @include('table.tb_internship')
    </div>

</div>
