<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP CRUD</title>
    <!-- Link Bootsrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <!-- Link Datatable -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
    <!-- Link Font Awesome  -->
    <script src="https://kit.fontawesome.com/94f5154929.js" crossorigin="anonymous"></script>
    <!-- My Css -->
    <link rel="stylesheet" href="style/style.css">
</head>

<body>
    <!-- Nav -->
    <nav class="navbar navbar-dark bg-danger">
        <a class="navbar-brand" href="index.php" style="color: #fff;">
            CORONA SOFTWARE
        </a>
    </nav>
    <div class="container">
        <h2 align="center" style="margin: 30px;">
            CRUD AJAX
        </h2>

        <!-- form -->
        <form id="form-data" class="form-data" method="post">
            <div class="row">
                <!-- nama siswa -->
                <div class="col-sm-3">
                    <div class="form-group">
                        <label for="">Nama Siswa</label>
                        <input type="hidden" name="id" id="id">
                        <input type="text" name="nama_siswa" id="nama_siswa" class="form-control" required="true">
                        <p class="text-danger" id="err_nama_siswa"></p>
                    </div>
                </div>

                <!-- jurusan -->
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Jurusan</label>
                        <select name="jurusan" id="jurusan" class="form-control" required="true">
                            <option value=""></option>
                            <option value="Rekayasa Perangkat Lunak">Rekayasa Perangkat Lunak</option>
                            <option value="Multimedia">Multimedia</option>
                            <option value="Teknik Komputer Dan Jaringan">Teknik Komputer Dan Jaringan</option>
                            <option value="Broadcasting">Broadcasting</option>
                            <option value="Broadcasting">Teknik Elektronika Industri</option>
                        </select>
                        <p class="text-danger" id="err_jurusan"></p>
                    </div>
                </div>

                <!-- tanggal masuk -->
                <div class="col-sm-3">
                    <div class="form-group">
                        <label for="">Tanggal Masuk</label>
                        <input type="text" name="tanggal_masuk" id="tanggal_masuk" class="form-control" required="true">
                        <p class="text-danger" id="err_tanggal_masuk"></p>
                    </div>
                </div>

                <!-- jenis kelamin -->
                <div class="col-sm-3">
                    <div class="form-group">
                        <label for="">Jenis Kelamin</label>
                        <div>
                            <input type="radio" name="kel" id="kel1" value="Laki-laki" required="true"> Laki-Laki
                            <input type="radio" name="kel" id="kel2" value="Perempuan" required="true"> Perempuan
                        </div>
                    </div>
                    <p class="text-danger" id="err_kel"></p>
                </div>
            </div>

            <!-- alamat -->
            <div class="form-group">
                <label for="">Alamat</label>
                <textarea type="text" name="alamat" id="alamat" class="form-control" required="true"></textarea>
                <p class="text-danger" id="err_alamat"></p>
            </div>

            <!-- button -->
            <div class="form-group">
                <button type="button" name="simpan" id="simpan" class="btn btn-primary btn-sm">
                    <i class="fa fa-save"></i> Simpan
                </button>
            </div>
        </form>
        <hr>

        <!-- data -->
        <div class="data"></div>

    </div>

    <!-- footer -->
    <div class="text-center mb-4 mt-3">© <?php echo date('Y'); ?> Copyright:
        <a href="index.php">Corona Software</a>
    </div>

    <!-- Script JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <!-- Script Bootstrap -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <!-- Script DataTable -->
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>

    <!-- My Script -->
    <script type="text/javascript">
        $(document).ready(function() {
            $('.data').load("data.php");
            $('#simpan').click(function() {
                var data = $('.form-data').serialize();

                //   variable untuk mengambil data yang telah diinputkan didalam form dan selanjutnya akan di simpan kedalam var
                var nama_siswa = document.getElementById("nama_siswa").value;
                var jurusan = document.getElementById("jurusan").value;
                var tanggal_masuk = document.getElementById("tanggal_masuk").value;
                var kel1 = document.getElementById("kel1").value;
                var kel2 = document.getElementById("kel2").value;
                var alamat = document.getElementById("alamat").value;


                // if atau pengecualian apabila form tidak diisi maka akan keluar tulisan error
                if (nama_siswa == "") {
                    document.getElementById("err_nama_siswa").innerHTML = "Nama Siswa Harus Anda Isi!";
                } else {
                    document.getElementById("err_nama_siswa").innerHTML = "";
                }

                if (jurusan == "") {
                    document.getElementById("err_jurusan").innerHTML = "Jurusan Harus Anda Isi!";
                } else {
                    document.getElementById("err_jurusan").innerHTML = "";
                }

                if (tanggal_masuk == "") {
                    document.getElementById("err_tanggal_masuk").innerHTML = "Tanggal Masuk Harus Anda Isi!";
                } else {
                    document.getElementById("err_tanggal_masuk").innerHTML = "";
                }

                if (document.getElementById("kel1").checked == false && document.getElementById("kel2").checked == false) {
                    document.getElementById("err_kel").innerHTML = "Jenis Kelamin Harus Anda Isi!";
                } else {
                    document.getElementById("err_kel").innerHTML = "";
                }

                if (alamat == "") {
                    document.getElementById("err_alamat").innerHTML = "Alamat Harus Anda Isi!";
                } else {
                    document.getElementById("err_alamat").innerHTML = "";
                }

                // if selanjutnya adalah untuk ajax nya sendiri
                if (nama_siswa != "" && alamat != "" && jurusan != "" && tanggal_masuk != "" && (document.getElementById("kel1").checked == true || document.getElementById("kel2").checked == true)) {
                    $.ajax({
                        type: 'POST',
                        url: "form_action.php",
                        data: data,
                        success: function() {
                            $('.data').load("data.php");
                            document.getElementById("id").value = "";
                            document.getElementById("form-data").reset();
                        },
                        error: function(response) {
                            console.log(response.responseText);
                        }
                    });
                }
            });
        });
    </script>
</body>

</html>