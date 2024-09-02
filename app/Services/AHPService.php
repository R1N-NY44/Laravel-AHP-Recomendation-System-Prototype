<?php

namespace App\Services;

class AHPService
{
    public function ahpSederhana()
    {
        // 1. Inisialisasi Data
        $kriteria = ["Pengalaman", "Keterampilan Teknis", "Komunikasi"];
        $alternatif = ["Kandidat A", "Kandidat B", "Kandidat C", "Kandidat D"];

        // 2. Proses Perbandingan Kriteria
        $matriksKriteria = [
            [1, 2, 3],
            [1/2, 1, 2],
            [1/3, 1/2, 1]
        ];

        [$bobotKriteria, $cr] = $this->hitungPrioritasDanKonsistensi($matriksKriteria);

        $output = [];

        if ($cr > 0.1) {
            $output['warning'] = "Peringatan: Rasio Konsistensi > 0.1. Penilaian mungkin tidak konsisten.";
        }
        $output['bobotKriteria'] = array_map(function($v) { return number_format($v, 4); }, $bobotKriteria);
        $output['rasioKonsistensi'] = number_format($cr, 4);

        // 3. Penilaian Alternatif
        $nilaiAlternatif = [
            [7, 9, 6, 8],
            [8, 7, 8, 7],
            [6, 8, 9, 7]
        ];

        // 4. Hitung Nilai Akhir Alternatif
        $nilaiAkhir = $this->dotProduct($bobotKriteria, $nilaiAlternatif);

        // 5. Perangkingan Alternatif
        $peringkat = [];
        foreach ($alternatif as $key => $alt) {
            $peringkat[] = [$alt, $nilaiAkhir[$key]];
        }
        usort($peringkat, function($a, $b) {
            return $b[1] <=> $a[1];
        });

        // 6. Tampilkan Hasil
        $output['hasilPeringkat'] = [];
        foreach ($peringkat as $rank => $data) {
            $output['hasilPeringkat'][] = [
                'rank' => $rank + 1,
                'kandidat' => $data[0],
                'nilai' => number_format($data[1], 4)
            ];
        }

        dd($output);
    }

    private function hitungPrioritasDanKonsistensi($matriks)
    {
        $n = count($matriks);

        // Hitung jumlah kolom
        $jumlahKolom = array_map(function($col) {
            return array_sum($col);
        }, $this->transposeMatrix($matriks));

        // Normalisasi matriks
        $matriksNormal = [];
        foreach ($matriks as $row) {
            $matriksNormal[] = array_map(function($val, $key) use ($jumlahKolom) {
                return $val / $jumlahKolom[$key];
            }, $row, array_keys($row));
        }

        // Hitung prioritas (bobot)
        $prioritas = array_map(function($row) {
            return array_sum($row) / count($row);
        }, $matriksNormal);

        // Hitung λ_max (nilai eigen maksimum)
        $λMax = array_sum(array_map(function($jk, $p) {
            return $jk * $p;
        }, $jumlahKolom, $prioritas));

        // Hitung Consistency Index (CI)
        $ci = ($λMax - $n) / ($n - 1);

        // Hitung Consistency Ratio (CR)
        $ri = [1 => 0, 2 => 0, 3 => 0.58, 4 => 0.9, 5 => 1.12, 6 => 1.24, 7 => 1.32, 8 => 1.41, 9 => 1.45, 10 => 1.49];
        $cr = $ci / $ri[$n];

        return [$prioritas, $cr];
    }

    private function transposeMatrix($matrix)
    {
        return array_map(null, ...$matrix);
    }

    private function dotProduct($a, $b)
    {
        return array_map(function($bCol) use ($a) {
            return array_sum(array_map(function($aVal, $bVal) {
                return $aVal * $bVal;
            }, $a, $bCol));
        }, $this->transposeMatrix($b));
    }
}
