<div>
    <!-- It is quality rather than quantity that matters. - Lucius Annaeus Seneca -->
    <div class="container mx-auto">
        <div class="rounded-md p-2 overflow-hidden">
            <table id="tb_lowongan" class="min-w-full leading-normal pt-2">
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
            $('#tb_lowongan').DataTable();
        });
    </script>
</div>
