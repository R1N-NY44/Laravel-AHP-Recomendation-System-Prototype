<div>
    <!-- Nothing in life is to be feared, it is only to be understood. Now is the time to understand more, so that we may fear less. - Marie Curie -->
    <div class="container mx-auto">
        <h2 class="text-2xl font-bold mb-6 text-gray-700">Lowongans</h2>
        <div class="shadow-xl rounded-md p-2 overflow-hidden">
            <table id="lowongansTable" class="min-w-full leading-normal pt-2">
                <thead>
                    <tr>
                        <th class="px-5 py-3 bg-gray-100 text-gray-600 text-left text-xs font-semibold uppercase tracking-wider">
                            ID
                        </th>
                        <th class="px-5 py-3 bg-gray-100 text-gray-600 text-left text-xs font-semibold uppercase tracking-wider">
                            Judul
                        </th>
                        <th class="px-5 py-3 bg-gray-100 text-gray-600 text-left text-xs font-semibold uppercase tracking-wider">
                            Deskripsi
                        </th>
                        <th class="px-5 py-3 bg-gray-100 text-gray-600 text-left text-xs font-semibold uppercase tracking-wider">
                            Tanggal Dibuat
                        </th>
                    </tr>
                </thead>
                <tbody>

                    <tr class="border-b">
                        <td class="px-5 py-5 bg-white text-sm">
                            <p class="text-gray-900 whitespace-no-wrap">1</p>
                        </td>
                        <td class="px-5 py-5 bg-white text-sm">
                            <p class="text-gray-900 whitespace-no-wrap">Lowongan Developer</p>
                        </td>
                        <td class="px-5 py-5 bg-white text-sm">
                            <p class="text-gray-900 whitespace-no-wrap">Mencari developer yang berpengalaman.</p>
                        </td>
                        <td class="px-5 py-5 bg-white text-sm">
                            <p class="text-gray-900 whitespace-no-wrap">01/09/2023</p>
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#lowongansTable').DataTable();
        });
    </script>
</div>
