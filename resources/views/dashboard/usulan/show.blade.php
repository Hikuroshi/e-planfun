@extends('layouts.main')

@section('container')

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <a href="/dashboard/usulans" class="text-reset">
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
                <a class="btn btn-info btn-sm" href="/dashboard/usulans/{{ $usulan->slug }}/edit">
                    <i class="fas fa-pencil-alt"></i>
                    Edit
                </a>
                <form action="/dashboard/usulans/{{ $usulan->slug }}" method="post" class="d-inline">
                    @method('delete')
                    @csrf
                    <button class="btn btn-danger btn-sm" onclick="confirm('Apakah yakin ingin menghapus?')">
                        <i class="fas fa-trash"></i>
                        Delete
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