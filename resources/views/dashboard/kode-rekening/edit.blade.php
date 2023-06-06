@extends('layouts.main')

@section('css')
<link rel="stylesheet" href="/assets/plugins/select2/css/select2.min.css">
<link rel="stylesheet" href="/assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
@endsection

@section('container')

<div class="row">
    <div class="col-md-6">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">
                    <a href="/dashboard/kode-rekenings" class="text-reset">
                        <i class="fas fa-reply mr-1"></i>
                        Kembali
                    </a>        
                </h3>
            </div>
            <form action="/dashboard/kode-rekenings/{{ $kodeRekening->slug }}" method="post">
                @csrf
                @method('put')
                
                <div class="card-body">
                    <div class="form-group">
                        <label for="kegiatan">Kegiatan <span class="text-danger">*</span></label>
                        <select name="kegiatan_id" id="kegiatan" class="form-control select2bs4 @error('kegiatan_id') is-invalid @enderror" style="width: 100%;">
                            <option value="">Pilih Kegiatan</option>
                            @foreach ($kegiatans as $kegiatan)
                            <option value="{{ $kegiatan->id }}" @selected(old('kegiatan_id', $kodeRekening->kegiatan_id) == $kegiatan->id)>
                                {{ $kegiatan->nama }}
                            </option>
                            @endforeach
                        </select>
                        @error('kegiatan_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="barang">Barang <span class="text-danger">*</span></label>
                        <select name="barang_id[]" id="barang" class="select2bs4 @error('barang_id') is-invalid @enderror" multiple="multiple" data-placeholder="Select a State" style="width: 100%;">
                            @foreach ($barangs as $barang)
                            <option value="{{ $barang->id }}" @selected(in_array($barang->id, old('barang_id', $kodeRekening->barangs->pluck('id')->toArray())))>
                                {{ $barang->nama }}
                            </option>
                            @endforeach
                        </select>
                        @error('barang_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="anggaran">Anggaran <span class="text-danger">*</span></label>
                        <select name="anggaran_id" id="anggaran" class="form-control select2bs4 @error('anggaran_id') is-invalid @enderror" style="width: 100%;">
                            <option value="">Pilih Anggaran</option>
                            @foreach ($anggarans as $anggaran)
                            <option value="{{ $anggaran->id }}" @selected(old('anggaran_id', $kodeRekening->anggaran_id) == $anggaran->id)>
                                {{ $anggaran->keperluan }}
                            </option>
                            @endforeach
                        </select>
                        @error('anggaran_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="uraian">Uraian <span class="text-danger">*</span></label>
                        <input name="uraian" type="text" id="uraian" class="form-control @error('uraian') is-invalid @enderror" value="{{ old('uraian', $kodeRekening->uraian) }}" placeholder="Masukan uraian...">
                        @error('uraian')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                
                <div class="card-footer">
                    <button type="reset" class="btn btn-secondary">Reset</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('js')
<script src="/assets/plugins/select2/js/select2.full.min.js"></script>    

<script>
    $(function () {        
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })
    })
</script>
@endsection