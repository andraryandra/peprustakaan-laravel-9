<div class="modal-body">
    <div class="row">
        <div class="col-sm-12">
            <div class="mb-3">
                <label class="nama">Nama</label>
                <input type="text" name="name" class="form-control @error('nama') is-invalid @enderror" value="{{ $detail->name }}">
            </div>
        </div><!-- Col -->
        <div class="col-sm-12">
            <div class="mb-3">
                <label class="username">Username</label>
                <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" value="{{ $detail->username }}">
            </div>
        </div><!-- Col -->
    </div><!-- Row -->
    <div class="row">
        <div class="col-sm-12">
            <div class="mb-3">
                <label class="form-label">email</label>
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ $detail->email }}">
            </div>
        </div><!-- Col -->
        <div class="col-sm-12">
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" value="{{ $detail->password }}">
            </div>
        </div><!-- Col -->
    </div><!-- Row -->
</div>
