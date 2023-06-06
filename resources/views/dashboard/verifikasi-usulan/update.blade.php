@extends('layouts.main')

@section('container')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Simple Tables</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Simple Tables</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Bordered Table</h3>
                        </div>
                        <div class="card-body table-responsive">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th style="width: 200px">Judul</th>
                                        <td>{{ $usulan->judul }}</td>
                                    </tr>
                                    <tr>
                                        <th>Kode Rekening</th>
                                        <td>{{ $usulan->kode_rekening }}</td>
                                    </tr>
                                    <tr>
                                        <th>Kegiatan</th>
                                        <td>{{ $usulan->kegiatan }}</td>
                                    </tr>
                                    <tr>
                                        <th>Barang</th>
                                        <td>{{ $usulan->barang }}</td>
                                    </tr>
                                    <tr>
                                        <th>Anggaran</th>
                                        <td>{{ $usulan->anggaran }}</td>
                                    </tr>
                                    <tr>
                                        <th>Keterangan</th>
                                        <td>{{ $usulan->keterangan }}</td>
                                    </tr>
                                    <tr>
                                        <th>Data Pendukung</th>
                                        <td><a href="{{ asset('storage/' . $usulan->data_pendukung) }}" download="Data-Pendukung">Data Pendukung</a></td>
                                    </tr>
                                    <tr>
                                        <th>Status</th>
                                        <td class="project-state">
                                            <h5>
                                                <span class="badge badge-{{ $usulan->status_verifikasi == 'Disetujui' ? 'success' : 'danger' }}">{{ $verif }}</span>
                                            </h5>                                       
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Keterangan Verifikasi</th>
                                        <td>{{ $usulan->keterangan_verifikasi }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer">
                            <form action="/dashboard/verifikasi-usulan/{{ $usulan->slug }}" method="post" class="d-inline">
                                @method('put')
                                @csrf
                                
                                <div class="form-group">
                                    <label for="keterangan_verifikasi">Keterangan Verifikasi</label>
                                    <textarea class="form-control" rows="3" placeholder="Keterangan verifikasi" style="height: 97px;" id="keterangan_verifikasi" name="keterangan_verifikasi"></textarea>
                                </div>
                                
                                <button class="btn btn-success btn-sm" type="submit" name="status_verifikasi" value="Disetujui" onclick="confirm('Apakah yakin ingin menyetujui?')">
                                    <i class="fas fa-check"></i>
                                    Setuju
                                </button>
                                <button class="btn btn-danger btn-sm" type="submit" name="status_verifikasi" value="Ditolak" onclick="confirm('Apakah yakin ingin menolak?')">
                                    <i class="fas fa-times"></i>
                                    Tolak
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="embed-responsive embed-responsive-1by1">
                                <embed class="embed-responsive-item" src="{{ asset('storage/' . $usulan->data_pendukung) }}#toolbar=0&navpanes=0&scrollbar=0">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection