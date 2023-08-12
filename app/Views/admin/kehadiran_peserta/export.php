<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Berita Acara Ujian</title>

    <link rel="stylesheet" href="<?= base_url(); ?>/assets/vendors/ti-icons/css/themify-icons.css">

    <style>
        body {
            padding: 25px;
        }

        .kejadian {
            border-collapse: collapse;
            width: 100%;
            margin-bottom: 30px;
        }

        .kejadian th,
        .kejadian td {
            border: 1px solid black;
            padding: 5px;
        }

        .table-container {
            display: table;
            width: 100%;
        }

        .table-row {
            display: table-row;
        }

        .table-cell {
            display: table-cell;
            width: 33%;
            vertical-align: top;
        }
    </style>
</head>

<body id="page-top">
    <div>
        <table width="100%" style="border-bottom: 2px solid #000;">
            <tr>
                <td>
                    <img src="<?= base_url(); ?>/assets/images/logo_unsoed_hitam_putih.png" alt="" width="100px" height="100px">
                </td>
                <td style="text-align: center; margin-bottom: 5px">
                    <div>KEMENTERIAN PENDIDIKAN, KEBUDAYAAN, RISET, DAN TEKNOLOGI</div>
                    <div>UNIVERSITAS JENDERAL SOEDIRMAN</div>
                    <div><b>FAKULTAS TEKNIK</b></div>
                    <div>
                        <small>Alamat: Jl. Mayjen Sungkono km 5 Blater, Kalimanah, Purbalingga 53371</small>
                    </div>
                    <div>
                        <small>Telepon/Faks : (0281) 6596801, 6596700</small>
                    </div>
                </td>
            </tr>
        </table>
    </div>
    <div>
        <h4 style="margin-bottom: 5px; text-align: center;"><u>BERITA ACARA UJIAN</u></h4>
        <p style="text-align: justify;">Pada hari ini <?= hari($jadwal_ujian['tanggal']); ?> tanggal <?= tgl_indo(date('Y-m-d', strtotime($jadwal_ujian['tanggal']))); ?> telah diadakan <?= $label; ?>.</p>
        <table>
            <tr>
                <td width="100px">Mata Ujian</td>
                <td width="10px">:</td>
                <td><?= $jadwal_ujian['matkul']; ?></td>
            </tr>
            <tr>
                <td width="100px">Pukul</td>
                <td width="10px">:</td>
                <td><?= date('H.i', strtotime($jadwal_ujian['jam_mulai'])); ?> - <?= date('H.i', strtotime($jadwal_ujian['jam_selesai'])); ?> WIB</td>
            </tr>
            <tr>
                <td width="100px">Ruang</td>
                <td width="10px">:</td>
                <td><?= $ruang_ujian; ?></td>
            </tr>
            <tr>
                <td width="100px" valign="top">Pengawas</td>
                <td width="10px" valign="top">:</td>
                <td>
                    <div style="margin-bottom: 3px;">1. <?= $pengawas['nama_pengawas1']; ?></div>
                    <?php if ($pengawas && $pengawas['nama_pengawas2']) : ?>
                        <div style="margin-bottom: 3px;">2. <?= $pengawas['nama_pengawas2']; ?></div>
                    <?php endif; ?>
                    <?php if ($pengawas3_hadir) : ?>
                        <div><?= $pengawas && $pengawas['nama_pengawas2'] ? '3' : '2' ?>. <?= $pengawas3['dosen']; ?></div>
                    <?php endif; ?>
                </td>
            </tr>
        </table>

        <table>
            <tr>
                <td width="60px" valign="top">Jumlah</td>
                <td>
                    <table>
                        <tr>
                            <td width="180px"><b>Hadir</b></td>
                            <td>:</td>
                            <td width="80px"><?= $kehadiran_peserta['total_hadir']; ?> orang;</td>
                        </tr>
                        <tr>
                            <td valign="top"><b>Sakit</b></td>
                            <td valign="top">:</td>
                            <td valign="top"><?= $kehadiran_peserta['sakit']; ?> orang;</td>
                            <td valign="top"><i class="ti-arrow-right"></i></td>
                            <td valign="top"><b>NIM</b></td>
                            <td valign="top">:</td>
                            <td><?php if ($kehadiran_peserta['nim_sakit'] != NULL && $kehadiran_peserta['nim_sakit'] != 'null') : ?><?php foreach (json_decode($kehadiran_peserta['nim_sakit']) as $n => $nim_sakit) : ?><?= $nim_sakit ?><?= count(json_decode($kehadiran_peserta['nim_sakit'])) == $n + 1 ? '' : ', ' ?><?php endforeach; ?><?php endif; ?></td>
                        </tr>
                        <tr>
                            <td valign="top"><b>Izin</b></td>
                            <td valign="top">:</td>
                            <td valign="top"><?= $kehadiran_peserta['izin']; ?> orang;</td>
                            <td valign="top"><i class="ti-arrow-right"></i></td>
                            <td valign="top"><b>NIM</b></td>
                            <td valign="top">:</td>
                            <td><?php if ($kehadiran_peserta['nim_izin'] != NULL && $kehadiran_peserta['nim_izin'] != 'null') : ?><?php foreach (json_decode($kehadiran_peserta['nim_izin']) as $n => $nim_izin) : ?><?= $nim_izin ?><?= count(json_decode($kehadiran_peserta['nim_izin'])) == $n + 1 ? '' : ', ' ?><?php endforeach; ?><?php endif; ?></td>
                        </tr>
                        <tr>
                            <td valign="top"><b>Tanpa Keterangan</b></td>
                            <td valign="top">:</td>
                            <td valign="top"><?= $kehadiran_peserta['tanpa_ket']; ?> orang;</td>
                            <td valign="top"><i class="ti-arrow-right"></i></td>
                            <td valign="top"><b>NIM</b></td>
                            <td valign="top">:</td>
                            <td><?php if ($kehadiran_peserta['nim_tanpa_ket'] != NULL && $kehadiran_peserta['nim_tanpa_ket'] != 'null') : ?><?php foreach (json_decode($kehadiran_peserta['nim_tanpa_ket']) as $n => $nim_tanpa_ket) : ?><?= $nim_tanpa_ket ?><?= count(json_decode($kehadiran_peserta['nim_tanpa_ket'])) == $n + 1 ? '' : ', ' ?><?php endforeach; ?><?php endif; ?></td>
                        </tr>
                        <tr>
                            <td valign="top"><b>Tidak Memenuhi Syarat</b></td>
                            <td valign="top">:</td>
                            <td valign="top"><?= $kehadiran_peserta['tidak_memenuhi_syarat']; ?> orang;</td>
                            <td valign="top"><i class="ti-arrow-right"></i></td>
                            <td valign="top"><b>NIM</b></td>
                            <td valign="top">:</td>
                            <td><?php if ($kehadiran_peserta['nim_tidak_memenuhi_syarat'] != NULL && $kehadiran_peserta['nim_tidak_memenuhi_syarat'] != 'null') : ?><?php foreach (json_decode($kehadiran_peserta['nim_tidak_memenuhi_syarat']) as $n => $nim_tidak_memenuhi_syarat) : ?><?= $nim_tidak_memenuhi_syarat ?><?= count(json_decode($kehadiran_peserta['nim_tidak_memenuhi_syarat'])) == $n + 1 ? '' : ', ' ?><?php endforeach; ?><?php endif; ?></td>
                        </tr>
                        <tr>
                            <td valign="top"><b>Presensi &lt; 70%</b></td>
                            <td valign="top">:</td>
                            <td valign="top"><?= $kehadiran_peserta['presensi_kurang']; ?> orang.</td>
                            <td valign="top"><i class="ti-arrow-right"></i></td>
                            <td valign="top"><b>NIM</b></td>
                            <td valign="top">:</td>
                            <td><?php if ($kehadiran_peserta['nim_presensi_kurang'] != NULL && $kehadiran_peserta['nim_presensi_kurang'] != 'null') : ?><?php foreach (json_decode($kehadiran_peserta['nim_presensi_kurang']) as $n => $nim_presensi_kurang) : ?><?= $nim_presensi_kurang ?><?= count(json_decode($kehadiran_peserta['nim_presensi_kurang'])) == $n + 1 ? '' : ', ' ?><?php endforeach; ?><?php endif; ?></td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>

        <table>
            <tr>
                <td><b>Jumlah LJU</b></td>
                <td>:</td>
                <td><?= $kehadiran_peserta['jumlah_lju']; ?></td>
                <td>lembar</td>
            </tr>
        </table>

        <p>Laporan kejadian-kejadian yang dianggap perlu :</p>

        <table class="kejadian">
            <tr>
                <th width="100px">NIM</th>
                <th width="200px">Nama Mahasiswa</th>
                <th width="200px">Kejadian</th>
            </tr>
            <?php foreach ($kejadian as $k) : ?>
                <tr>
                    <td style="text-align: center;"><?= $k ? $k['nim'] : ''; ?></td>
                    <td><?= $k ? $k['nama_mhs'] : ''; ?></td>
                    <td>
                        <?php if ($k['jenis_kejadian']) : ?>
                            <?= $jenis_kejadian[intval($k['jenis_kejadian']) - 1]; ?>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>

        <table width="100%">
            <tr>
                <td style="text-align: right;">Purbalingga, <?= tgl_indo(date('Y-m-d', strtotime($jadwal_ujian['tanggal']))); ?></td>
            </tr>
        </table>

        <div class="table-container">
            <div class="table-row">
                <div class="table-cell">
                    <?php if ($pengawas3_hadir) : ?>
                        <p style="margin-bottom: 100px;"><?= $pengawas && $pengawas['nama_pengawas2'] ? 'Pengawas III' : 'Pengawas II' ?></p>
                        <p><?= $pengawas3['dosen']; ?></p>
                    <?php endif; ?>
                </div>
                <div class="table-cell">
                    <?php if ($pengawas && $pengawas['nama_pengawas2']) : ?>
                        <p style="margin-bottom: 100px;">Pengawas II</p>
                        <p><?= $pengawas['nama_pengawas2']; ?></p>
                    <?php endif; ?>
                </div>
                <div class="table-cell">
                    <p style="margin-bottom: 100px;">Pengawas I</p>
                    <p><?= $pengawas['nama_pengawas1']; ?></p>
                </div>
            </div>
        </div>
    </div>
</body>

</html>