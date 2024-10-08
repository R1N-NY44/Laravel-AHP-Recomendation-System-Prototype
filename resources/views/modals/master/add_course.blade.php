
    <!-- Walk as if you are kissing the Earth with your feet. - Thich Nhat Hanh -->
    <dialog id="importMasterCourse" class="modal">
        <div class="modal-box relative max-w-[30%]">
            <div class="mb-4 flex w-full items-center">
                <button class="btn btn-sm btn-circle btn-outline btn-warning left-4 top-4 text-lg">i</button>
                <h3 class="grow text-center text-xl font-bold">Tambah Matakuliah</h3>
                <form method="dialog"><button class="btn btn-sm btn-circle btn-outline btn-error right-4 top-4">✕</button>
                </form>
            </div>

            <form class="default-form flex flex-col items-center" action="{{ route('master.course.store') }}" function-callback="afterAction">
                @csrf
                <input type="text" placeholder="Type here" name="name" class="input input-bordered input-info w-full max-w-xs" />
                <button type="submit" id="modal-button" class="btn btn-accent mt-4 w-full max-w-xs">Save</button>                
            </form>

        </div>
    </dialog>
    </div>
