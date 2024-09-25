<?php

namespace App\Http\Controllers;

use Alert;
use App\Models\{Doctor, Poli};
use App\Http\Requests\DoctorRequest;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Hapus dokter';
        $text = 'Apakah Anda ingin menghapus dokter?';
        confirmDelete($title, $text);
        return view('doctors.index', ['doctors' => Doctor::orderBy('doctors.name', 'asc')->paginate(20)]);
    }
    public function schedule()
    {
        return view('dokter', ['doctors' => Doctor::orderBy('doctors.name', 'asc')->paginate(25)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('doctors.create', [
            'doctor' => new Doctor(),
            'polis' => Poli::get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreDoctorRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DoctorRequest $request)
    {
        $request->validate([
            'pp' => 'image|mimes:jpeg,png,jpg,svg|max:2048'
        ]);
        $attr = $request->all();
        $slug = \Str::Slug(request('name'));
        $attr['slug'] = $slug;
        $pp = request()->file('pp') ? request()->file('pp')->store("images/doctors") : null;
        
        $attr['poli_id'] = request('poli');
        $attr['pp'] = $pp;
        Doctor::create($attr);
        session()->flash('success', 'Dokter berhasil dibuat!');
        return redirect('doctors');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function show(Doctor $doctor)
    {
        return view('doctors.show', compact('doctor'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function edit(Doctor $doctor)
    {
        return view('doctors.edit', [
            'doctor'=> $doctor,
            'polis' => Poli::get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDoctorRequest  $request
     * @param  \App\Models\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function update(DoctorRequest $request, Doctor $doctor)
    {
        $request->validate([
            'pp' => 'image|mimes:jpeg,png,jpg,svg|max:2048'
        ]);
        if (request()->file('pp')) {
            \Storage::delete($doctor->pp);
            $pp = request()->file('pp')->store('images/doctors');
        } else {
            $pp = $doctor->pp;
        }
        $attr = $request->all();
        $attr['poli_id'] = request('poli');
        $attr['pp'] = $pp;
        $doctor->update($attr);
        session()->flash('success', 'Dokter berhasil diupdate!');
        return redirect('doctors');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Doctor $doctor)
    {
        \Storage::delete($doctor->pp);
        $doctor->delete();
        session()->flash('success', 'Dokter berhasil dihapus!');
        return redirect('doctors');
    }
}
