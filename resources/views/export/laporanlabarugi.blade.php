<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Produk</th>
            <th>Harga Beli/satuan</th>
            <th>Harga Jual/satuan</th>
            <th>Jumlah Terjual</th>
            <th>Total Harga Beli</th>
            <th>Total Harga Jual</th>
        </tr>
    </thead>
    <tbody>
        @php
            $no = 1;
            $totalterjual = 0;
            $totalbeli = 0;
            $totaljual = 0;
        @endphp
        @foreach ($penjualan as $penj)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $penj->nama_produk }}</td>
                <td style="text-align: right">Rp. <?php
                $angka = $penj->modal;
                echo number_format($angka, 0, ',', '.');
                ?></td>
                <td style="text-align: right">Rp. <?php
                $angka = $penj->harga;
                echo number_format($angka, 0, ',', '.');
                ?></td>
                @php
                    $terjual = App\Models\DetailPesanan::join('pesanans', 'pesanans.id','=', 'pesanandetails.pesanan_id')->where(
                                            'pesanandetails.produk_id',
                                            $penj->id_produk,
                                        )->where('pesanans.status', 'Selesai')->get();
                    $jlhterjual = 0;
                    foreach ($terjual as $terj) {
                        $jlhterjual += $terj->jumlah;
                    }
                    $totalterjual += $jlhterjual;
                    $totalbeli += $jlhterjual * $penj->modal;
                    $totaljual += $jlhterjual * $penj->harga;
                @endphp
                <td style="text-align: center">{{ $jlhterjual }}</td>
                <td style="text-align: right">Rp. <?php
                $angka = $jlhterjual * $penj->modal;
                echo number_format($angka, 0, ',', '.');
                ?></td>
                <td style="text-align: right">Rp. <?php
                $angka = $jlhterjual * $penj->harga;
                echo number_format($angka, 0, ',', '.');
                ?></td>
            </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <th colspan="4" style="text-align: right">
                Total :
            </th>
            <th style="text-align: center">
                {{ $totalterjual }}
            </th>
            <th style="text-align: right">
                Rp. <?php
                echo number_format($totalbeli, 0, ',', '.');
                ?>
            </th>
            <th style="text-align: right">
                Rp. <?php
                echo number_format($totaljual, 0, ',', '.');
                ?>
            </th>
        </tr>
        <tr>
            <th colspan="4" style="text-align: right">
                Keuntungan :
            </th>
            <th colspan="3" style="text-align: right">
                Rp. <?php
                $angka = $totaljual - $totalbeli;
                echo number_format($angka, 0, ',', '.');
                ?>
            </th>
        </tr>
    </tfoot>
</table>
