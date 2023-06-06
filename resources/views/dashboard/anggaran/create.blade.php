@extends('layouts.main')

@section('container')

<div class="row">
    <div class="col-md-6">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">
                    <a href="/dashboard/anggarans" class="text-reset">
                        <i class="fas fa-reply mr-1"></i>
                        Kembali
                    </a>        
                </h3>
            </div>
            <form action="/dashboard/anggarans" method="post">
                @csrf
                
                <div class="card-body">
                    <div class="form-group">
                        <label for="keperluan">Keperluan <span class="text-danger">*</span></label>
                        <input name="keperluan" type="text" id="keperluan" class="form-control @error('keperluan') is-invalid @enderror" value="{{ old('keperluan') }}" placeholder="Masukan keperluan..." autofocus>
                        @error('keperluan')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="jumlah">Jumlah <span class="text-danger">*</span></label>
                        <input name="jumlah" type="number" id="jumlah" class="form-control @error('jumlah') is-invalid @enderror" value="{{ old('jumlah') }}" placeholder="Masukan jumlah...">
                        @error('jumlah')
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