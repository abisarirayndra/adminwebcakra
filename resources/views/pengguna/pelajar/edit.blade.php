@extends('master.master')

@section('title')
    <title>Administrasi - Cakra Krisna Manggala</title>
@endsection

@section('content')
<div class="container">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <h5><i class="fas fa-hashtag text-warning"></i> Edit Pengguna Pelajar</h5>
            <div class="p-3 mt-3">
                <form class="user" action="{{ route('admin.penggunapelajar.update', [$pelajar->id]) }}" method="POST">
                    @csrf
                    <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" class="form-control" name="nama" value="{{$pelajar->nama}}">
                    </div>
                    <div class="form-group">
                        <label>No. Registrasi</label>
                        <input type="text" class="form-control" name="nomor_registrasi" value="{{$pelajar->nomor_registrasi}}">
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" readonly value="{{$pelajar->email}}">
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" onclick="return confirm('Anda yakin ingin mengganti password ?')">
                    </div>
                    <div class="form-group">
                        <label>Kelas</label>
                        <select name="kelas_id" class="form-control">
                            @foreach ($kelas as $item)
                                <option value="{{ $item->id }}"  @if($item->id == $pelajar->kelas_id) {{'selected="selected"'}} @endif>{{ $item->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Role</label>
                        <select name="role_id" class="form-control">
                            @foreach ($roles as $item)
                                <option value="{{ $item->id }}"  @if($item->id == $pelajar->role_id) {{'selected="selected"'}} @endif>{{ $item->role }}</option>
                            @endforeach
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
