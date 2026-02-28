
<div class="modal fade" id="Tambah" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">

				<h4 class="modal-title" id="myModalLabel">Tambah data?</h4>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			</div>
			<div class="modal-body">
				<form action="{{ asset('admin/user/tambah') }}" enctype="multipart/form-data" method="post" accept-charset="utf-8">
{{ csrf_field() }}
				<div class="form-group row">
					<label class="col-sm-3 control-label text-right">Nama lengkap</label>
					<div class="col-sm-9">
						<input type="text" name="nama" class="form-control" placeholder="Nama lengkap" value="{{ old('nama') }}" required>
					</div>
				</div>

				<div class="form-group row">
					<label class="col-sm-3 control-label text-right">Email</label>
					<div class="col-sm-9">
						<input type="email" name="email" class="form-control" placeholder="Email" value="{{ old('email') }}" required>
					</div>
				</div>				

				<div class="form-group row">
					<label class="col-sm-3 control-label text-right">Username</label>
					<div class="col-sm-9">
						<input type="text" name="username" class="form-control" placeholder="Username" value="{{ old('username') }}" required>
					</div>
				</div>

				<div class="form-group row">
					<label class="col-sm-3 control-label text-right">Password</label>
					<div class="col-sm-9">
						<div class="input-group">
							<input type="password" name="password" id="password" class="form-control" placeholder="Password" value="{{ old('password') }}" required>
							<div class="input-group-append">
								<button type="button" class="btn btn-outline-secondary" onclick="togglePassword('password', 'eye-icon-password')">
									<i id="eye-icon-password" class="fa fa-eye"></i>
								</button>
							</div>
						</div>
					</div>
				</div>


				<div class="form-group row">
					<label class="col-sm-3 control-label text-right">Level Hak Akses</label>
					<div class="col-sm-9">
						<select name="akses_level" class="form-control">
							<option value="Admin">Admin</option>
							<option value="User">User</option>
						</select>
					</div>
				</div>

				<div class="form-group row">
					<label class="col-sm-3 control-label text-right">Upload foto profil</label>
					<div class="col-sm-9">
						<input type="file" name="gambar" class="form-control" placeholder="Upload Foto" value="{{ old('gambar') }}">
					</div>
				</div>

				<div class="form-group row">
					<label class="col-sm-3 control-label text-right"></label>
					<div class="col-sm-9">
						<div class="form-group pull-right btn-group">
							<input type="submit" name="submit" class="btn btn-primary " value="Simpan Data">
							<input type="reset" name="reset" class="btn btn-success " value="Reset">
							<button type="button" class="btn btn-danger " data-dismiss="modal">Close</button>
						</div>
					</div>
					<div class="clearfix"></div>
				</div>
				</form>

			</div>
		</div>
	</div>
</div>

<script>
function togglePassword(inputId, iconId) {
    const passwordInput = document.getElementById(inputId);
    const eyeIcon = document.getElementById(iconId);
    
    if (passwordInput.type === "password") {
        passwordInput.type = "text";
        eyeIcon.classList.remove('fa-eye');
        eyeIcon.classList.add('fa-eye-slash');
    } else {
        passwordInput.type = "password";
        eyeIcon.classList.remove('fa-eye-slash');
        eyeIcon.classList.add('fa-eye');
    }
}
</script>
