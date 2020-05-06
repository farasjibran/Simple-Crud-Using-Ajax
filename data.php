<table id="example" class="table table-striped table-bordered" style="width: 100%">
    <thead>
        <tr>
            <td>No</td>
            <td>Nama Siswa</td>
            <td>Alamat</td>
            <td>Jurusan</td>
            <td>Jenis Kelamin</td>
            <td>Tanggal Masuk</td>
            <td>Action</td>
        </tr>
    </thead>
    <tbody>
        <?php
        include 'koneksi.php';
        $i = 1;
        $querysql = "SELECT * FROM `tbl_siswa` ORDER BY `nama_siswa` ASC";
        $prepare = $conn->prepare($querysql);
        $prepare->execute();
        $result = $prepare->get_result();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $id = $row['id'];
                $nama_siswa = $row['nama_siswa'];
                $alamat = $row['alamat'];
                $jurusan = $row['jurusan'];
                $jenis_kelamin = $row['jenis_kelamin'];
                $tgl_masuk = $row['tgl_masuk'];
        ?>
                <tr>
                    <td><?php echo $i++; ?></td>
                    <td><?php echo $nama_siswa; ?></td>
                    <td><?php echo $alamat ?></td>
                    <td><?php echo $jurusan ?></td>
                    <td><?php echo $jenis_kelamin ?></td>
                    <td><?php echo $tgl_masuk ?></td>
                    <td>
                        <button id="<?php echo $id; ?>" class="btn btn-success btn-sm edit_data">
                            <i class="fa fa-edit">Edit</i>
                        </button>
                        <button id="<?php echo $id; ?>" class="btn btn-danger btn-sm hapus_data">
                            <i class="fa fa-trash">Hapus</i>
                        </button>
                    </td>
                </tr>
            <?php }
        } else { ?>
            <tr>
                <td colspan="7">Tidak Ada Data Ditemukan!</td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<script type="text/javascript">
    $(document).ready(function() {
        $('#example').DataTable();
    });

    function reset() {
        document.getElementById("err_nama_siswa").innerHTML = "";
        document.getElementById("err_alamat").innerHTML = "";
        document.getElementById("err_jurusan").innerHTML = "";
        document.getElementById("err_tanggal_masuk").innerHTML = "";
        document.getElementById("err_kel").innerHTML = "";
    }

    $(document).on('click', '.edit_data', function() {
        var id = $(this).attr('id');
        $.ajax({
            type: 'POST',
            url: "get_data_all.php",
            data: {
                id: id
            },
            dataType: 'json',
            success: function(response) {
                reset();
                document.getElementById("id").value = response.id;
                document.getElementById("nama_siswa").value = response.nama_siswa;
                document.getElementById("jurusan").value = response.jurusan;
                document.getElementById("tanggal_masuk").value = response.tgl_masuk;
                document.getElementById("alamat").value = response.alamat;
                if (response.jenis_kelamin == "Laki-laki") {
                    document.getElementById("kel1").checked = true;
                } else {
                    document.getElementById("kel2").checked = true;
                }
            },
            error: function(respose) {
                console.log(respose.responseText)
            }
        });
    });

    $(document).on('click', '.hapus_data', function() {
        var id = $(this).attr('id');
        $.ajax({
            type: 'POST',
            url: "hapus_data.php",
            data: {
                id: id
            },
            success: function() {
                $('.data').load("data.php");
            },
            error: function(response) {
                console.log(response.responseText);
            }
        });
    });
</script>