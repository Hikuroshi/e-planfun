@extends('layouts.main')

@section('css')
<link rel="stylesheet" href="/assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="/assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="/assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

<link rel="stylesheet" href="/assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
@endsection

@section('container')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="row align-items-center">
                    <div class="col-6">
                        <h3 class="card-title">Tabel data Usulan</h3>
                    </div>
                    <div class="col-6 text-right">
                        <a class="btn btn-success btn-sm" href="/dashboard/usulans/create">
                            <i class="fas fa-plus"></i>
                            Tambah Usulan
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th style="width: 20px">No</th>
                            <th>Kode Rekening</th>
                            <th>Uraian</th>
                            <th>Jumlah</th>
                            <th>Status</th>
                            @can('operator')
                            <th style="width: 200px">Aksi</th>
                            @endcan
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($usulans as $usulan)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $usulan->kodeRekening->kode }}</td>
                            <td>{{ $usulan->kodeRekening->uraian }}</td>
                            <td>{{ $usulan->kodeRekening->anggaran->jumlah }}</td>
                            <td class="project-state">
                                <h5>
                                    <span class="badge badge-{{ $usulan->status_verifikasi == 'Disetujui' ? 'success' : 'danger' }}">{{ $usulan->verifikasi }}</span>
                                </h5>
                            </td>
                            @can('operator')
                            <td class="project-actions text-right">
                                <a class="btn btn-primary btn-sm" href="/dashboard/usulans/{{ $usulan->slug }}">
                                    <i class="fas fa-folder"></i>
                                    View
                                </a>
                                <a class="btn btn-info btn-sm" href="/dashboard/usulans/{{ $usulan->slug }}/edit">
                                    <i class="fas fa-pencil-alt"></i>
                                    Edit
                                </a>
                                <form action="/dashboard/usulans/{{ $usulan->slug }}" method="post" class="d-inline">
                                    @method('delete')
                                    @csrf
                                    <button class="btn btn-danger btn-sm swalDelete" data-title="{{ $usulan->kodeRekening->uraian }}">
                                        <i class="fas fa-trash"></i>
                                        Delete
                                    </button>
                                </form>
                            </td>
                            @endcan
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js')
<script src="/assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="/assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="/assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="/assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="/assets/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="/assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="/assets/plugins/jszip/jszip.min.js"></script>
<script src="/assets/plugins/pdfmake/pdfmake.min.js"></script>
<script src="/assets/plugins/pdfmake/vfs_fonts.js"></script>
<script src="/assets/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="/assets/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="/assets/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

<script src="/assets/plugins/sweetalert2/sweetalert2.min.js"></script>

@if(session()->has('success'))
<script>
    $(document).ready(function() {
        var Toast = Swal.mixin({
            toast: true,
            position: 'top',
            showConfirmButton: false,
            timer: 5000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        });
        
        Toast.fire({
            icon: 'success',
            title: '{{ session('success') }}'
        });
    });
</script>
@endif

<script>
    $(function () {
        $("#example1").DataTable({
            "responsive": true, "lengthChange": false, "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
    
    $(document).ready(function() {
        $('.swalDelete').click(function(e) {
            e.preventDefault();
            var title = $(this).data('title');
            
            Swal.fire({
                title: 'Hapus ' + title + '?',
                html: "Apakah kamu yakin ingin menghapus <b>" + title + "</b>? Data yang sudah dihapus tidak bisa dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus',
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