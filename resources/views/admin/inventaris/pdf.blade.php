<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Inventaris Aset</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 20px;
        }
        h1 {
            text-align: center;
            color: #003a8c;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        table th {
            background-color: #f0f0f0;
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
            font-weight: bold;
        }
        table td {
            padding: 8px;
            border: 1px solid #ddd;
        }
        .footer {
            margin-top: 30px;
            text-align: right;
            font-size: 10px;
            color: #666;
        }
    </style>
</head>
<body>
    <h1>Inventaris Aset</h1>
    <p>Dicetak pada: {{ \Carbon\Carbon::now()->isoFormat('dddd, DD MMMM YYYY HH:mm') }}</p>
    
    <table>
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="30%">Nama Aset</th>
                <th width="10%">Kuantitas</th>
                <th width="20%">Lokasi</th>
                <th width="15%">Nomor Serial</th>
                <th width="20%">Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @forelse($items as $index => $it)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $it->nama }}</td>
                    <td style="text-align: center;">{{ $it->kuantitas }}</td>
                    <td>{{ $it->lokasi ?? '-' }}</td>
                    <td>{{ $it->nomor_serial ?? '-' }}</td>
                    <td>{{ $it->keterangan ?? '-' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" style="text-align: center;">Belum ada item inventaris.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    
    <div class="footer">
        <p>Gereja Maranatha - Sistem Manajemen Gereja</p>
    </div>
</body>
</html>
