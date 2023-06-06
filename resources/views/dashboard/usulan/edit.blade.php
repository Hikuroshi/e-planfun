@extends('layouts.main')

@section('container')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>General Form</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">General Form</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Input Usulan</h3>
                        </div>
                        <form action="/dashboard/usulans/{{ $usulan->slug }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="kode_rekening">Kode Rekening <span class="text-danger">*</span></label>
                                    <select name="kode_rekening_id" id="kode_rekening" class="form-control select2bs4 @error('kode_rekening_id') is-invalid @enderror" style="width: 100%;">
                                        <option value="">Pilih Kode Rekening</option>
                                        @foreach ($kode_rekenings as $kode_rekening)
                                        <option value="{{ $kode_rekening->id }}" @selected(old('kode_rekening_id', $usulan->kode_rekening_id) == $kode_rekening->id)>
                                            {{ $kode_rekening->kode }}
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('kode_rekening_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                
                                <div class="form-group">
                                    <label for="keterangan">Keterangan <span class="text-danger">*</span></label>
                                    <input name="keterangan" type="text" id="keterangan" class="form-control @error('keterangan') is-invalid @enderror" value="{{ old('keterangan', $usulan->keterangan) }}" placeholder="Masukan keterangan...">
                                    @error('keterangan')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                
                                <div class="form-group">
                                    <label for="data_pendukung">Data Pendukung</label>
                                    <div class="custom-file">
                                        <input type="hidden" name="old_data_pendukung" value="{{ $usulan->data_pendukung }}">
                                        <input type="file" class="custom-file-input @error('data_pendukung') is-invalid @enderror" accept="application/pdf" id="data_pendukung" name="data_pendukung">
                                        <label class="custom-file-label" for="data_pendukung">Pilih File</label>
                                    </div>
                                    @error('data_pendukung')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection

@section('js')
<script src="/assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>

<script>
    $(function () {        
        bsCustomFileInput.init();
    });
</script>
@endsection