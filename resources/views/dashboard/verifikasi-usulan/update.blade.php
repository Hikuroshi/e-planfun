@extends('layouts.main')

@section('css')
<link rel="stylesheet" href="/assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
@endsection

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
                        <textarea class="form-control @error('keterangan_verifikasi') is-invalid @enderror" rows="3" placeholder="Keterangan verifikasi" style="height: 97px;" id="keterangan_verifikasi" name="keterangan_verifikasi" required>{{ old('keterangan') }}</textarea>
                        @error('keterangan_verifikasi')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    
                    <button class="btn btn-success btn-sm swalSetuju" name="status_verifikasi" value="Disetujui" data-title="{{ $usulan->kodeRekening->uraian }}">
                        <i class="fas fa-check"></i>
                        Setuju
                    </button>
                    <button class="btn btn-danger btn-sm swalTolak" name="status_verifikasi" value="Ditolak" data-title="{{ $usulan->kodeRekening->uraian }}">
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

@section('js')
<script src="/assets/plugins/sweetalert2/sweetalert2.min.js"></script>

<script>
    $(document).ready(function() {
        $('.swalSetuju').click(function(e) {
            e.preventDefault();
            var title = $(this).data('title');
            
            Swal.fire({
                title: 'Setuju dengan ' + title + '?',
                html: "Apakah kamu yakin setuju dengan <b>" + title + "</b>?",
                icon: 'success',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Setuju',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $(this).closest('form').submit();
                }
            });
        });
        $('.swalTolak').click(function(e) {
            e.preventDefault();
            var title = $(this).data('title');
            
            Swal.fire({
                title: 'Tolak ' + title + '?',
                html: "Apakah kamu yakin ingin menolak <b>" + title + "</b>?",
                icon: 'error',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Tolak',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $(this).closest('form').submit();
                }
            });
        });
    });
</script>
@endsection