<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Pendaftar;
use App\Pelajar;
use Auth;
use Alert;
use App\Kelas;
use App\Role;

class PenggunaController extends Controller
{
    public function hapusPengguna($id){
        $pengguna = User::find($id);
        $pengguna->delete();
        Alert::toast('Pengguna Berhasil Dihapus','success');
        return redirect()->back();
    }

    public function penggunaPendaftar(){
        $user = Auth::user()->nama;
        $pendaftar = User::where('role_id', 5)
                    ->orderBy('users.id', 'desc')
                    ->get();

        return view('pengguna.pendaftar.penggunapendaftar', compact('user','pendaftar'));
    }

    public function lihatPendaftar($id){
        $user = Auth::user()->nama;
        $pendaftar = Pendaftar::join('users','users.id','=','adm_pendaftars.pendaftar')
                                ->select('users.nama','users.email','adm_pendaftars.pendaftar','adm_pendaftars.tempat_lahir','adm_pendaftars.tanggal_lahir','adm_pendaftars.alamat','adm_pendaftars.sekolah','adm_pendaftars.wa',
                                            'adm_pendaftars.wali','adm_pendaftars.wa_wali','adm_pendaftars.foto','adm_pendaftars.markas')
                                ->where('adm_pendaftars.pendaftar', $id)
                                ->first();
        $kelas = Kelas::all();

        return view('pengguna.pendaftar.lihat', compact('pendaftar','user','kelas'));
    }

    public function migrasiPendaftar($id, Request $request){
        $pendaftar = Pendaftar::where('pendaftar', $id)->first();
        Pelajar::create([
            'pelajar_id' => $pendaftar->pendaftar,
            'tempat_lahir' => $pendaftar->tempat_lahir,
            'tanggal_lahir' => $pendaftar->tanggal_lahir,
            'alamat' => $pendaftar->alamat,
            'nik' => $pendaftar->nik,
            'nisn' => $pendaftar->nisn,
            'sekolah' => $pendaftar->sekolah,
            'wa' => $pendaftar->wa,
            'ibu' => $pendaftar->ibu,
            'wali' => $pendaftar->wali,
            'wa_wali' => $pendaftar->wa_wali,
            'foto' => $pendaftar->foto,
            'markas' => $pendaftar->markas,
        ]);
        $pendaftar->delete();
        $akun = User::find($id);
        $akun->update([
            'kelas_id' => $request->kelas_id,
            'nomor_registrasi' => $request->nomor_registrasi,
            'role_id' => 4,
        ]);

        Alert::toast('Migrasi Pendaftar ke Pelajar Berhasil');
        return redirect()->route('admin.penggunapelajar');

    }

    public function penggunaPelajar(){
        $user = Auth::user()->nama;
        $pelajar = User::join('kelas','kelas.id','=','users.kelas_id')
                    ->select('users.id','users.nama','kelas.nama as kelas','users.nomor_registrasi','users.email','users.updated_at')
                    ->where('role_id', 4)
                    ->orderBy('users.updated_at', 'desc')
                    ->get();

        return view('pengguna.pelajar.penggunapelajar', compact('user','pelajar'));
    }

    public function lihatPelajar($id){
        $user = Auth::user()->nama;
        $pelajar = Pelajar::join('users','users.id','=','adm_pelajars.pelajar_id')
                                ->select('users.id','users.nama','users.email', 'adm_pelajars.nik','adm_pelajars.nisn','adm_pelajars.ibu','adm_pelajars.tempat_lahir','adm_pelajars.tanggal_lahir','adm_pelajars.alamat','adm_pelajars.sekolah','adm_pelajars.wa',
                                            'adm_pelajars.wali','adm_pelajars.wa_wali','adm_pelajars.foto','adm_pelajars.markas')
                                ->where('adm_pelajars.pelajar_id', $id)
                                ->first();

        return view('pengguna.pelajar.lihat', compact('pelajar','user'));
    }

    public function editPelajar($id){
        $user = Auth::user()->nama;
        $pelajar = User::find($id);
        $kelas = Kelas::all();
        $roles = Role::all();
        return view('pengguna.pelajar.edit', compact('pelajar','kelas','user','roles'));
    }

    public function updatePelajar($id, Request $request){
        $pelajar = User::find($id);
        if($request->password){
            $pelajar->update($request->all());
            Alert::toast('Update Pelajar Berhasil','success');
            return redirect()->route('admin.penggunapelajar');
        }else{
            $pelajar->update([
                'nama' => $request->nama,
                'nomor_registrasi' => $request->nomor_registrasi,
                'email' => $request->email,
                'kelas_id' => $request->kelas_id,
                'role_id' => $request->role_id,
            ]);
            Alert::toast('Update Pelajar Berhasil','success');
            return redirect()->route('admin.penggunapelajar');
        }
    }

    public function editDataPelajar($id){
        $user = Auth::user()->nama;
        $data = User::select('nama', 'email', 'nomor_registrasi')->where('id', $id)->first();
        $pelajar = Pelajar::where('pelajar_id', $id)->first();
        return view('pengguna.pelajar.editdata', compact('user','pelajar','data'));
    }

    public function updateDataPelajar($id, Request $request){
        $pelajar = Pelajar::find($id);
        if($request->foto){
            $request->validate([
                'foto' => 'mimes:jpg,jpeg,png|dimensions:ratio=3/2|size:500',
            ]);
            $pelajar->update($request->all());
            Alert::toast('Update Data Berhasil','success');
            return redirect()->route('admin.penggunapelajar.lihat',$id);
        }else{
            $pelajar->update([
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
                'alamat' => $request->alamat,
                'nik' => $request->nik,
                'nisn' => $request->nisn,
                'sekolah' => $request->sekolah,
                'wa' => $request->wa,
                'ibu' => $request->ibu,
                'wali' => $request->wali,
                'wa_wali' => $request->wa_wali,
                'markas' => $request->markas,
            ]);
            Alert::toast('Update Data Berhasil','success');
            return redirect()->route('admin.penggunapelajar.lihat',$pelajar->pelajar_id);
        }
    }

    public function suspendPelajar($id){
        $pelajar = User::find($id);
        $pelajar->update([
            'role_id' => 6,
        ]);
        Alert::toast('Akun Pelajar Disuspend','success');
        return redirect()->route('admin.penggunapelajar');
    }

    public function destroyPelajar($id){
        $pelajar = User::find($id);
        $pelajar->delete();
        Alert::toast('Hapus Pelajar Berhasil','success');
        return redirect()->route('admin.penggunapelajar');
    }

    // Belum Selesai

    public function penggunaPelajarSuspend(Request $request){
        $user = Auth::user()->nama;
        $pelajar = User::join('kelas','kelas.id','=','users.kelas_id')
                    ->select('users.id','users.nama','kelas.nama as kelas','users.nomor_registrasi','users.email','users.updated_at')
                    ->where('role_id', 6)
                    ->orderBy('users.updated_at', 'desc')
                    ->get();
        return view('pengguna.suspend.suspended', compact('user','pelajar'));
    }

    public function lihatSuspended($id){
        $user = Auth::user()->nama;
        $pelajar = Pelajar::join('users','users.id','=','adm_pelajars.pelajar_id')
                                ->select('users.id','users.nama','users.email', 'adm_pelajars.nik','adm_pelajars.nisn','adm_pelajars.ibu','adm_pelajars.tempat_lahir','adm_pelajars.tanggal_lahir','adm_pelajars.alamat','adm_pelajars.sekolah','adm_pelajars.wa',
                                            'adm_pelajars.wali','adm_pelajars.wa_wali','adm_pelajars.foto','adm_pelajars.markas')
                                ->where('adm_pelajars.pelajar_id', $id)
                                ->first();

        return view('pengguna.suspend.lihat', compact('pelajar','user'));
    }

    public function cabutSuspendPelajar($id){
        $pengguna = User::find($id);
        $pengguna->update([
            'role_id' => 4,
        ]);
        Alert::toast('Suspend Dicabut','success');
        return redirect()->route('admin.penggunapelajar');
    }

    public function hapusSuspendPelajar($id){
        $pelajar = User::find($id);
        $pengguna->delete();
        Alert::toast('Data Berhasil Dihapus','success');
        return redirect()->route('admin.penggunasuspend');
    }



    public function penggunaPendidik(){
        $user = Auth::user()->nama;
        $pendidik = User::where('role_id', 3)
                    ->orderBy('users.id', 'desc')
                    ->get();

        return view('pengguna.pendidik.penggunapendidik', compact('user','pendidik'));
    }
}
