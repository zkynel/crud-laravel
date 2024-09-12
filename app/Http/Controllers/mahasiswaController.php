<?php

namespace App\Http\Controllers;

use App\Models\mahasiswa;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session as FacadesSession;

class mahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {   
        $katakunci = $request->katakunci;
        $jumlahbaris = 4;
        if (strlen($katakunci)) {
        $data = mahasiswa::where('nim', 'like',"%katakunci%")
            ->orWhere('nama','like', "%katakunci%")
            ->orWhere('jurusan', 'like', "%katakunci%")
            ->paginate($jumlahbaris);
    }else{
        $data = mahasiswa::orderBy('nim', 'desc')->paginate($jumlahbaris);
    }
        return view('mahasiswa.index')->with('data', $data);
}
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('mahasiswa.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {   
        FacadesSession::flash('nim', $request->nim);
        FacadesSession::flash('nama', $request->nama);
        FacadesSession::flash('jurusan', $request->jurusan);
        
        $request->validate([
            'nim' => 'required|numeric|unique:mahasiswa,nim',
            'nama' => 'required',
            'jurusan' => 'required',
        ],[
            'nim.required'=>'NIM Wajib Di isi',
            'nim.numeric' => 'NIM Wajib Dalam Angka',
            'nim.unique' => 'NIM Yang Di isikan Sudah Ada Dalam Database',
            'nama.required'=>'Nama Wajib Di isi',
            'jurusan.required' => 'Jurusan Wajib Di isi',
        ]);
        $data = [
            'nim' => $request->nim,
            'nama' => $request->nama,
            'jurusan' => $request->jurusan,
        ];
        mahasiswa::create($data);
        return Redirect()->to('mahasiswa')->with('success','Berhasil Menambahkan Data!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = mahasiswa::where('nim', $id)->first();
        return view('mahasiswa.edit')->with('data', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama' => 'required',
            'jurusan' => 'required',
        ], [
            'nama.required' => 'Nama Wajib Di isi',
            'jurusan.required' => 'Jurusan Wajib Di isi',
        ]);
        $data = [
            'nama' => $request->nama,
            'jurusan' => $request->jurusan,
        ];
        mahasiswa::where('nim',$id)->update($data);
        return Redirect()->to('mahasiswa')->with('success', 'Berhasil Melakukan Update Data!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        mahasiswa::where('nim', $id)->delete();
        return redirect()->to('mahasiswa')->with('success', 'Berhasil Melakukan Delete Data!');
    }
}
