<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddTrackRequest;
use App\Models\Tracking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TruckTrackingController extends BaseController
{
    public function getAllData()
    {
        $data = Tracking::get();
        return $this->sendResponse($data, "Ambil Data Berhasil");
    }

    public function getById($id)
    {
        $data = Tracking::find($id);
        return $this->sendResponse($data, "Data Berhasil Di Ambil");
    }

    public function store(AddTrackRequest $request)
    {
        $data = Tracking::create([
            "no_pol" => $request->nopol,
            "driver" => $request->nama,
            "no_surat_jalan" => $request->nosurat,
        ]);

        return $this->sendResponse($data, "Data Berhasil Ditambahkan");
    }

    public function destroy($id){
        $track = Tracking::find($id);
        if (Storage::disk('public')->exists('images/' . $track->foto)) {
            Storage::disk('public')->delete('images/' . $track->foto);
        }
        $track->delete();

        return $this->sendResponse([], "Data Berhasil Di Hapus");
    }

    public function update(Request $request, $id)
    {
        $file = $request->file('gambar');
        $track = Tracking::find($id);
        try {
            if (@$file->hashName() != null) {
                if (Storage::disk('public')->exists('images/' . $track->foto)) {
                    Storage::disk('public')->delete('images/' . $track->foto);
                }
                $name = $file->hashName();
                $file->storeAs('public/images', $name);
            }
        } catch (\Throwable $th) {
            $name = $track->foto;
        }

        $track->update([
            "suhu" => $request->suhu,
            "foto" => $name
        ]);

        return $this->sendResponse([], "Data Berhasil Di Update");
    }
}
