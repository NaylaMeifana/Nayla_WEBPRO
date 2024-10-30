<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Form Data Barang</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
    </style>
</head>
<body>
    <h1>Tambah Barang</h1>
    <form method="post" action="">

        <label for="nama_barang">Nama Barang:</label><br>
        <input type="text" id="nama_barang" name="nama_barang" required><br><br>>

        <label for="kategori">Kategori:</label><br>
        <input type="text" id="kategori" name="kategori" required><br><br>

        <label for="harga_barang">Harga Barang:</label><br>
        <input type="number" id="harga_barang" name="harga_barang" required><br><br>

        <input type="submit" name="tambah" value="Tambah Barang">
    </form>
    
    <h2>Daftar Barang</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Barang</th>
                <th>Kategori</th>
                <th>Harga Barang</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            session_start();

            if (isset($_SESSION['id'])) {
                $_SESSION['id'] = [];
            }

            if (!isset($_SESSION['barang'])) {
                $_SESSION['barang'] = [];
            }

            if (isset($_POST['tambah'])) {
                $nama_barang = htmlspecialchars($_POST['nama_barang']);
                $kategori_barang = htmlspecialchars($_POST['kategori_barang']);
                $harga_barang = htmlspecialchars($_POST['harga_barang']);
                
                $barang_exist = false;
                foreach ($_SESSION['barang'] as $barang) {
                    if ($barang['nama'] === $nama_barang) {
                        $barang_exist = true;
                        break;
                    }
                }

                if (!$barang_exist) {
                    $_SESSION['barang'][] = [
                        // 'id' => $id_barang,
                        'nama' => $nama_barang,
                        'kategori' => $kategori_barang,
                        'harga' => $harga_barang,
                        
                    ];
                } else {
                    echo "<tr><td colspan='5' style='color:red;'>Barang dengan nama '{$nama_barang}' sudah ada!</td></tr>";
                }
            }

            if (isset($_POST['hapus'])) {
                $index = $_POST['index'];
                if (isset($_SESSION['barang'][$index])) {
                    unset($_SESSION['barang'][$index]);
                    $_SESSION['barang'] = array_values($_SESSION['barang']);
                }
            }

            if (isset($_POST['Edit'])) {
                $index = $_POST['index'];
                if (isset($_SESSION['barang'][$index])) {
                    unset($_SESSION['barang'][$index]);
                    $_SESSION['barang'] = array_values($_SESSION['barang']);
                }
            }

            foreach ($_SESSION['barang'] as $index => $barang) {
                echo "<tr>
                        <td>{$barang['id']}</td>
                        <td>{$barang['nama']}</td>
                        <td>{$barang['kategori']}</td>
                        <td>Rp. {$barang['harga']}</td>
                        <td>
                            <form method='post' style='display:inline;'>
                                <input type='hidden' name='index' value='$index'>
                                <input type='submit' name='hapus' value='Hapus'>
                                <input type='hidden' name='index' value='$index'>
                                <input type='submit' name='edit' value='Edit'>
                            </form>
                        </td>
                    </tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>
