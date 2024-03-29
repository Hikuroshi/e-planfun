@extends('layouts.main')

@section('container')

<div class="row">
    <div class="col-md-6">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">
                    <a href="/dashboard/barangs" class="text-reset">
                        <i class="fas fa-reply mr-1"></i>
                        Kembali
                    </a>        
                </h3>
            </div>
            <form action="/dashboard/barangs" method="post">
                @csrf
                
                <div class="card-body">
                    <div class="form-group">
                        <label for="nama">Nama <span class="text-danger">*</span></label>
                        <input name="nama" type="text" id="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama') }}" placeholder="Masukan nama..." autofocus>
                        @error('nama')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="merek">Merek <span class="text-danger">*</span></label>
                        <input name="merek" type="text" id="merek" class="form-control @error('merek') is-invalid @enderror" value="{{ old('merek') }}" placeholder="Masukan merek...">
                        @error('merek')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="harga">Harga <span class="text-danger">*</span></label>
                        <input name="harga" type="number" id="harga" class="form-control @error('harga') is-invalid @enderror" value="{{ old('harga') }}" placeholder="Masukan harga...">
                        @error('harga')
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