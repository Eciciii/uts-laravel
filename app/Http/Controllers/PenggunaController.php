<?php

namespace App\Http\Controllers;

use App\Models\Pengguna;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PenggunaController extends Controller
{
    /**
     * index
     *
     * @return View
     */
    public function index(): View
    {
        $penggunas = Pengguna::latest()->paginate(5);
        return view('penggunas.index', compact('penggunas'));
    }

    /**
     * create
     *
     * @return View
     */
    public function create(): View
    {
        return view('penggunas.create');
    }

    /**
     * store
     *
     * @param  Request  $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $this->validate($request, [
            'nama_lengkap' => 'required',
            'alamat' => 'required',
            'jenis_kelamin' => 'required',
            'username' => 'required|unique:penggunas',
            'password' => 'required'
        ]);

        Pengguna::create($request->all());

        return redirect()->route('penggunas.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    /**
     * show
     *
     * @param  int  $id
     * @return View
     */
    public function show(int $id): View
    {
        $pengguna = Pengguna::findOrFail($id);
        return view('penggunas.show', compact('pengguna'));
    }

    /**
     * edit
     *
     * @param  int  $id
     * @return View
     */
    public function edit(int $id): View
    {
        $pengguna = Pengguna::findOrFail($id);
        return view('penggunas.edit', compact('pengguna'));
    }

    /**
     * update
     *
     * @param  Request  $request
     * @param  int  $id
     * @return RedirectResponse
     */
    public function update(Request $request, int $id): RedirectResponse
    {
        $this->validate($request, [
            'nama_lengkap' => 'required',
            'alamat' => 'required',
            'jenis_kelamin' => 'required',
            'username' => 'required|unique:penggunas,username,'.$id,
            'password' => 'required'
        ]);

        $pengguna = Pengguna::findOrFail($id);
        $pengguna->update($request->all());

        return redirect()->route('penggunas.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    /**
     * destroy
     *
     * @param  int  $id
     * @return RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        $pengguna = Pengguna::findOrFail($id);
        $pengguna->delete();
        return redirect()->route('penggunas.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
