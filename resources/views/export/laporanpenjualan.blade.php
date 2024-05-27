<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Kode Pesanan</th>
            <th>Tanggal Pesanan</th>
            <th>Nama Pemesan</th>
            <th>Metode Pembayaran</th>
            <th>Jumlah Produk</th>
            <th>Total Harga</th>
        </tr>
    </thead>
    <tbody>
        @php
            $no = 1;
            $jlhpes = 0;
            $hargapes = 0;
        @endphp
        @foreach ($pesanan as $pes)
            @php
                $user = App\Models\User::where('id', $pes->user_id)->first();
                $metpem = App\Models\MetodePembayaran::where('id_metpem', $pes->nama_layanan)->first();
                $detailpes = App\Models\DetailPesanan::where('pesanan_id', $pes->id)->get();
                $jumlahdet = 0;
                foreach ($detailpes as $det) {
                    $jumlahdet += $det->jumlah;
                }
                $jlhpes += $jumlahdet;
                $hargapes += $pes->total_harga;
            @endphp
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $pes->kode }}</td>
                <td>{{ $pes->tanggal }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $metpem->layanan }}</td>
                <td>{{ $jumlahdet }}</td>
                <td style="text-align: right">Rp. <?php
                $angka = $pes->total_harga;
                echo number_format($angka, 0, ',', '.');
                ?></td>
            </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <td colspan="6" style="text-align: right"> Total Produk Terjual :

            </td>
            <td style="text-align: right"><b>{{ $jlhpes }} Produk</b></td>
        </tr>
        <tr>
            <td colspan="6" style="text-align: right">Total Harga Produk Terjual :</td>
            <td style="text-align: right"><b>Rp. <?php
            echo number_format($hargapes, 0, ',', '.');
            ?></b></td>
        </tr>
    </tfoot>
</table>
