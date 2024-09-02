<div>
    <dialog id="import_lowongan" class="modal">
        <div class="modal-box w-11/12 max-w-[55%]">
            <div class="mb-4 flex w-full items-center">
                <button class="btn btn-sm btn-circle btn-outline btn-warning left-4 top-4 text-lg">i</button>
                <h3 class="grow text-center text-xl font-bold">Tambah Lowongan</h3>
                <form method="dialog"><button class="btn btn-sm btn-circle btn-outline btn-error right-4 top-4">✕</button>
                </form>
            </div>

            <form class="default-form flex min-w-full flex-col" action="{{ route('master.internship.store') }}" method="POST">
                @csrf
                <label class="input input-bordered mb-5 flex items-center gap-4">
                    Nama Lowongan
                    <input type="text" name="name" class="grow" placeholder="Bikin Kopi" />
                </label>

                <div class="repeater-container">
                    <div id="criteria-container" data-repeater-list="criteria">
                        <div class="criteria-item mx-auto flex min-w-[90%] items-center justify-between rounded-2xl bg-[#e5e5e5] p-3 mb-6" data-repeater-item>
                            <select name="course" class="select select-bordered w-full max-w-sm items-center text-lg font-bold">
                                <option disabled selected>Matakuliah</option>
                                @foreach ($courses as $course)
                                    <option value="{{ $course->id_course }}">{{ $course->name }}</option>
                                @endforeach
                            </select>
                            <div class="min-w-[50%]">
                                <h1 class="text-base font-bold">Rentang Nilai</h1>
                                <input type="range" name="weight" min="10" max="100" value="10" class="range range-sm" step="10">
                                <div class="ml-1 flex w-full justify-between px-2 text-base font-semibold">
                                    <span>10</span><span>20</span><span>30</span><span>40</span><span>50</span><span>60</span><span>70</span><span>80</span><span>90</span><span>100</span>
                                </div>
                            </div>
                            <button data-repeater-delete type="button" class="remove-criteria btn btn-sm btn-circle btn-outline btn-error">✕</button>
                        </div>
                    </div>
                    <button data-repeater-create type="button" class="btn w-full btn-primary mt-4">Tambah Kriteria</button>
                </div>

                <button type="submit" class="btn btn-success mt-4">Simpan</button>
            </form>
        </div>
    </dialog>
</div>

<!-- Include jQuery and jQuery Repeater library -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.repeater/1.2.1/jquery.repeater.min.js"></script>

<!-- jQuery Repeater script -->
<script>
    $(document).ready(function() {
        $('.repeater-container').repeater({
            initEmpty: false,
            defaultValues: {
                'weights': 10
            },
            show: function() {
                $(this).slideDown();

                // Initialize select with default option
                $(this).find('select').val(null); // Deselect all options
                $(this).find('select option:first').prop('selected', true); // Select 'Matakuliah' option
            },
            hide: function(deleteElement) {
                // Prevent deletion if only one item remains
                if ($('.criteria-item').length > 1) {
                    if (confirm('Anda yakin ingin menghapus kriteria ini?')) {
                        $(this).slideUp(deleteElement);
                    }
                } else {
                    alert('Anda harus memiliki setidaknya satu kriteria.');
                }
            }
        });
    });
</script>
