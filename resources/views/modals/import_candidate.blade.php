

<div>
    <dialog id="importAltModal" class="modal">
        <div class="modal-box w-11/12 max-w-[55%]">
            <div class="mb-4 flex w-full items-center">
                <button class="btn btn-sm btn-circle btn-outline btn-warning left-4 top-4 text-lg">i</button>
                <h3 class="grow text-center text-xl font-bold">Tambah Lowongan</h3>
                <form method="dialog"><button class="btn btn-sm btn-circle btn-outline btn-error right-4 top-4">✕</button>
                </form>
            </div>

            <form class="default-form " action="{{ route('master.value.store') }}" method="POST">
                @csrf
                    <select id="internship-select" name="id_internship" 
                    class="select select-accent select-sm w-full mb-4 mt-2 ">
                    <option disabled selected>Select Internship</option>
                    @foreach ($internships as $internship)
                        <option value="{{ $internship->id_internship }}">{{ $internship->name }}</option>
                    @endforeach
                </select>

                <label class="input input-bordered mb-5 flex items-center gap-4">
                    Nim Kandidat
                    <input type="text" name="nim" class="grow" placeholder="67921361" />
                </label>             

                <label class="input input-bordered mb-5 flex items-center gap-4">
                    Nama Kandidat
                    <input type="text" name="name" class="grow" placeholder="Yogi" />
                </label>

                <label class="input input-bordered mb-5 flex items-center gap-4">
                    IPK Kandidat
                    <input type="number" name="ipk" class="grow" min="0" max="4.00" step="0.01" placeholder="3.50" />
                </label>
                

                <div class="repeater-container-candidate">
                    <div id="candidate-container" data-repeater-list="candidate">
                       
                    </div>                    
                </div>

                <button type="submit" class="btn btn-success mt-4 w-full">Simpan</button>
            </form>
        </div>
    </dialog>
</div>

<script>
    $(document).ready(function() {
        // Function to clear and append items manually
        function updateRepeaterContainer(criteria) {
            // Clear previous items
            $('#candidate-container').empty();
            
            // Append new items
            criteria.forEach(function(item) {
                // Create new repeater item
                const newItem = `
                        <div class="criteria-item mx-auto flex min-w-[90%] items-center justify-between rounded-2xl bg-[#e5e5e5] p-3 mb-6" data-repeater-item>
                            <select name="course" class="select select-bordered w-full max-w-sm items-center text-lg font-bold">
                                <option  selected value="${item.course_id}">${item.course_name}</option>
                            </select>
                            <div class="min-w-[50%]">
                                <h1 class="text-base font-bold">Rentang Nilai</h1>
                                <input type="range" name="weight" min="10" max="100" value="10" class="range range-sm" step="10">
                                <div class="ml-1 flex w-full justify-between px-2 text-base font-semibold">
                                    <span>10</span><span>20</span><span>30</span><span>40</span><span>50</span><span>60</span><span>70</span><span>80</span><span>90</span><span>100</span>
                                </div>
                            </div>                            
                        </div>
                `
                
                $('#candidate-container').append(newItem);
            });
        }
    
        // Initialize jQuery Repeater
        function initializeRepeater() {
            $('.repeater-container-candidate').repeater({
                initEmpty: false,
                show: function() {
                    $(this).slideDown();
                },
                hide: function(deleteElement) {
                    if ($('.repeater-item').length > 1) {
                        if (confirm('Anda yakin ingin menghapus kriteria ini?')) {
                            $(this).slideUp(deleteElement);
                        }
                    } else {
                        alert('Anda harus memiliki setidaknya satu kriteria.');
                    }
                }
            });
        }
    
        // Initial setup
        initializeRepeater();
    
        // Handle change event for internship selection
        $('#internship-select').change(function() {
            const internshipId = $(this).val();
            const url = `{{ route('master.internship.show', ['id' => ':id']) }}`.replace(':id', internshipId);
    
            if (internshipId) {
                $.ajax({
                    url: url,
                    method: 'GET',
                    success: function(data) {
                        console.log(data); // Debugging: check if data is correct
                        const criteria = data.criteria;
    
                        // Clear and reinitialize repeater
                        $('.repeater-container-candidate').repeater('destroy');
                        updateRepeaterContainer(criteria);
                        initializeRepeater(); // Reinitialize repeater after updating the DOM
                    },
                    error: function(xhr) {
                        console.error('Failed to fetch internship data.');
                    }
                });
            }
        });
    });
    </script>
    
