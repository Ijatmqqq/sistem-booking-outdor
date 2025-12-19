<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>RentTrail - Register</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                    <div class="col-lg-12">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                            </div>
                            <form class="user" method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                                @csrf

                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" name="name"
                                        placeholder="Nama Akun" required>
                                </div>

                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" name="nama_lengkap"
                                        placeholder="Nama Lengkap" required>
                                </div>

                                <div class="form-group">
                                    <label>Foto Profil</label>
                                    <input type="file" class="form-control" name="foto_profil" id="fotoProfil" accept="image/*" required>
                                </div>

                                <div class="mt-2">
                                    <img id="previewProfil" src="#" alt="Preview Foto Profil" style="max-width: 300px; display: none; border: 1px solid #ccc; padding: 5px;">
                                </div>

                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" name="nik"
                                        placeholder="NIK" required>
                                </div>

                                <div class="form-group">
                                    <textarea class="form-control form-control-user" name="alamat"
                                        placeholder="Alamat Lengkap" required></textarea>
                                </div>

                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" name="no_hp"
                                        placeholder="Nomor HP" required>
                                </div>

                                <div class="form-group">
                                    <label>Foto KTP</label>
                                    <input type="file" class="form-control" name="foto_ktp" id="fotoKTP" accept="image/*" required>
                                </div>

                                <div class="mt-2">
                                    <img id="previewKTP" src="#" alt="Preview Foto KTP" style="max-width: 300px; display: none; border: 1px solid #ccc; padding: 5px;">
                                </div>

                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" name="pekerjaan"
                                        placeholder="Pekerjaan" required>
                                </div>

                                <div class="form-group">
                                    <input type="email" class="form-control form-control-user" name="email"
                                        placeholder="Email Address" required>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="password" class="form-control form-control-user" name="password"
                                            placeholder="Password" required>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="password" class="form-control form-control-user" name="password_confirmation"
                                            placeholder="Ulangi Password" required>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary btn-user btn-block">
                                    Daftar
                                </button>
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="/">Already have an account? Login!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script>
        document.getElementById('fotoProfil').addEventListener('change', function (event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    const img = document.getElementById('previewProfil');
                    img.src = e.target.result;
                    img.style.display = 'block';
                }
                reader.readAsDataURL(file);
            }
        });
        document.getElementById('fotoKTP').addEventListener('change', function (event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    const img = document.getElementById('previewKTP');
                    img.src = e.target.result;
                    img.style.display = 'block';
                }
                reader.readAsDataURL(file);
            }
        });
    </script>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.js"></script>

</body>

</html>