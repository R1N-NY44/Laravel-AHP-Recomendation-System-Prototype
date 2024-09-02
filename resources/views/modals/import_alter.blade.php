<div>
    <!-- People find pleasure in different ways. I find it in keeping my mind clear. - Marcus Aurelius -->
    <dialog id="importAltModal" class="modal">
        <div class="modal-box relative max-w-[30%]">
            <div class="flex w-full items-center mb-4">
                <button class="btn btn-sm btn-circle btn-outline btn-warning left-4 top-4 text-lg">i</button>
                <h3 class="text-xl grow text-center font-bold">Import Mahasiswa</h3>
                <form method="dialog"><button class="btn btn-sm btn-circle btn-outline btn-error right-4 top-4">✕</button></form>
            </div>

            <form action="#" method="POST" onsubmit="return validateForm()" class="flex flex-col items-center">
                @csrf
                <input type="file" class="file-input file-input-sm file-input-bordered file-input-accent w-full max-w-xs" />
                <button type="submit" class="btn btn-accent mt-4 w-full max-w-xs">Save</button>
            </form>

        </div>
    </dialog>
</div>
