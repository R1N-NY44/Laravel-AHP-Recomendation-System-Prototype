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

@section('page_script')
    <script>
        $(document).ready(function() {
            courseList();
        });        

        function courseList() {
            var table = $('#table-master-table-master-posisi-magang').DataTable({
                ajax: `{{ route('master.course.show') }}`,
                serverSide: false,
                processing: true,
                deferRender: true,
                type: 'GET',
                destroy: true,
                columns: [{
                        data: 'DT_RowIndex'
                    },

                    {
                        data: 'name',
                        name: 'name'
                    },    
                    {
                        data: 'status',
                        name: 'status'
                    },              
                    {
                        data: 'action',
                        name: 'action'
                    }
                ]
            });
        }

        function edit(e) {
            let id = e.attr('data-id');

            let action = `{{ route('master.course.update', ['id' => ':id']) }}`.replace(':id', id);
            var url = `{{ route('master.course.edit', ['id' => ':id']) }}`.replace(':id', id);
            let modal = $('#importMasterCourse');
            modal.find(".modal-title").html("Edit Posisi Magang");
            modal.find('form').attr('action', action);
            modal.modal('show');

            $.ajax({
                type: 'GET',
                url: url,
                success: function(response) {
                    $('#name').val(response.name);
                }
            });
        }

        function afterAction(response) {
            $("#importMasterCourse").modal("hide");
            afterUpdateStatus(response);
        }

        function afterUpdateStatus(response) {
            $('#table-master-table-master-posisi-magang').DataTable().ajax.reload();            
        }

        $("#importMasterCourse").on("hide.bs.modal", function() {
            $(this).find(".modal-title").html("Tambah Posisi Magang");
            $(this).find('form').attr('action', "{{ route('master.course.store') }}");
        });
    </script>
@endsection

