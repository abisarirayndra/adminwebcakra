@extends('master.master')

@section('title')
    <title>Administrasi - Cakra Krisna Manggala</title>
@endsection

@section('content')
<div class="container">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <h5><i class="fas fa-hashtag text-warning"></i> Migrasi Data Pendaftar</h5>
            <div class="p-3 mt-3">
                <form class="user" action="" method="POST">
                    @csrf
                    {{-- <img src="{{ asset('img/pendaftar/'. $pendaftar->foto) }}" width="150" alt="">
                    <div class="form-group">
                        <label for="nama">Foto</label>

                        <input type="text" class="form-control" id="exampleFirstName"
                             name="nama_paket" required>
                    </div> --}}
                    <div class="form-group">
                            <label for="nama">Nama Siswa</label>
                            <input type="text" class="form-control" value="{{ $pendaftar->nama }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="nama">Status</label>
                        <select name="status" id="" class="form-control" required>
                            <option value="1">Aktif</option>
                            <option value="0">Tidak Aktif</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="nama">Kategori</label>
                        <select name="kategori" id="" class="form-control" required>
                            <option value="Kedinasan">Kedinasan</option>
                            <option value="TNI/Polri">TNI/Polri</option>
                        </select>
                    </div>
                    <div class="text-center mt-4">
                        <button class="btn btn-warning" type="submit">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
@endsection

@section('js')

@endsection
