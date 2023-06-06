@extends('layouts.main')

@section('container')

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <a href="/dashboard/verifikasi-usulan" class="text-reset">
                        <i class="fas fa-reply mr-1"></i>
                        Kembali
                    </a>        
                </h3>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th style="width: 200px">Kode Rekening</th>
                            <td>{{ $usulan->kodeRekening->kode }}</td>
                        </tr>
                        <tr>
                            <th>Kegiatan</th>
                            <td>{{ $usulan->kodeRekening->kegiatan->nama }}</td>
                        </tr>
                        <tr>
                            <th>Barang</th>
                            <td>
                                <ul>
                                    @foreach ($usulan->kodeRekening->barangs as $barang)
                                    <li>{{ $barang->nama }}</li>
                                    @endforeach
                                </ul>
                            </td>
                        </tr>
                        <tr>
                            <th>Anggaran</th>
                            <td>{{ $usulan->kodeRekening->anggaran->jumlah }}</td>
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
                                    <span class="badge badge-{{ $usulan->status_verifikasi == 'Disetujui' ? 'success' : 'danger' }}">{{ $usulan->verifikasi }}</span>
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

@endsection