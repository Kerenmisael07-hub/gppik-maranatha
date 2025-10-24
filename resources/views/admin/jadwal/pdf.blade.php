<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Jadwal Ibadah & Rapat</title>
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
    <h1>Jadwal Ibadah & Rapat</h1>
    <p>Dicetak pada: {{ \Carbon\Carbon::now()->isoFormat('dddd, DD MMMM YYYY HH:mm') }}</p>
    
    <table>
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="25%">Tanggal/Waktu</th>
                <th width="30%">Jenis Acara</th>
                <th width="40%">Pelayan Firman</th>
            </tr>
        </thead>
        <tbody>
            @forelse($jadwals as $index => $j)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ \Carbon\Carbon::parse($j->tanggal_waktu)->isoFormat('dddd, DD/MM/YYYY | HH:mm') }}</td>
                    <td>{{ $j->jenis_acara }}</td>
                    <td>{{ $j->pelayan_firman ?? '-' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" style="text-align: center;">Belum ada jadwal.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    
    <div class="footer">
        <p>Gereja Maranatha - Sistem Manajemen Gereja</p>
    </div>
</body>
</html>
