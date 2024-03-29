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
                    <a href="/dashboard/users" class="text-reset">
                        <i class="fas fa-reply mr-1"></i>
                        Kembali
                    </a>        
                </h3>
            </div>
            <form action="/dashboard/users/{{ $user->username }}" method="post">
                @csrf
                @method('put')
                
                <div class="card-body">
                    <div class="form-group">
                        <label for="nama">Nama User <span class="text-danger">*</span></label>
                        <input name="nama" type="text" id="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama', $user->nama) }}" placeholder="Masukan nama user..." autofocus>
                        @error('nama')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="username">Username <span class="text-danger">*</span></label>
                        <input name="username" type="text" id="username" class="form-control @error('username') is-invalid @enderror" value="{{ old('username', $user->username) }}" placeholder="Masukan username user...">
                        @error('username')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="role" class="form-label">Role <span class="text-danger">*</span></label>
                        <select name="role_id" id="role" class="form-control select2bs4 @error('role_id') is-invalid @enderror">
                            <option value="">Pilih Role</option>
                            @foreach ($roles as $role)
                            <option value="{{ $role->id }}" @selected(old('role_id', $user->role_id) == $role->id)>
                                {{ $role->nama }}
                            </option>
                            @endforeach
                        </select>
                        @error('role_id')
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