<?php

namespace App\Services;

use App\Models\Mahasiswa;

class MahasiswaService
{
    protected $jumlahbaris;

    public function __construct()
    {
        $this->jumlahbaris = env('PAGINATION_COUNT', 10);
    }

    public function getMahasiswa($katakunci = null)
    {
        return Mahasiswa::when($katakunci, function ($query, $katakunci) {
            return $query->where('nim', 'like', "%$katakunci%")
                ->orWhere('nama', 'like', "%$katakunci%")
                ->orWhere('jurusan', 'like', "%$katakunci%");
        })
            ->orderBy('nim', 'desc')
            ->paginate($this->jumlahbaris);
    }
}
