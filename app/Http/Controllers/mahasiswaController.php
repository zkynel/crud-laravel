<?php

namespace App\Http\Controllers;

use App\Models\mahasiswa;
use App\Http\Requests\StoreMahasiswaRequest;
use App\Http\Requests\UpdateMahasiswaRequest;
use App\Http\Requests\MahasiswaRequest;

use App\Services\MahasiswaService;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session as FacadesSession;

class mahasiswaController extends Controller
{
    protected $mahasiswaService;

    public function __construct(MahasiswaService $mahasiswaService)
    {
        $this->mahasiswaService = $mahasiswaService;
    }

    public function index(MahasiswaRequest $request)
    {
        $katakunci = $request->katakunci();
        $data = $this->mahasiswaService->getMahasiswa($katakunci);

        return view('mahasiswa.index', compact('data'));
    }

    public function create()
    {
        return view('mahasiswa.create');
    }


    public function store(StoreMahasiswaRequest $request)
    {
        $mahasiswa = mahasiswa::create([
            'nim' => $request->nim,
            'nama' => $request->nama,
            'jurusan' => $request->jurusan,
        ]);

        return redirect()->route('mahasiswa.index')->with('success', 'Berhasil Menambahkan Data!');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $data = mahasiswa::where('nim', $id)->first();
        
        return view('mahasiswa.edit')->with('data', $data);
    }

   
    public function update(UpdateMahasiswaRequest $request, string $id)
    {
        $data = [
            'nama' => $request->nama,
            'jurusan' => $request->jurusan,
        ];
    
        Mahasiswa::where('nim', $id)->update($data);

        return redirect()->to('mahasiswa')->with('success', 'Berhasil Melakukan Update Data!');
    }

    public function destroy($id)
    {
        mahasiswa::where('nim', $id)->delete();

        return redirect()->to('mahasiswa')->with('success', 'Berhasil Melakukan Delete Data!');
    }
}
