<!DOCTYPE html>
<html>
<head>
    <title>Data Booking</title>
    <style>
        body { font-family: sans-serif; }
        table { width: 100%; border-collapse: collapse; }
        table, th, td { border: 1px solid black; }
        th, td { padding: 6px; text-align: center; font-size: 12px; }
    </style>
</head>
<body>

<h3 style="text-align:center;">Data Booking</h3>

<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Ruangan</th>
            <th>Tanggal</th>
            <th>Jam</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($bookings as $i => $b)
        <tr>
            <td>{{ $i+1 }}</td>
            <td>{{ $b->user->name ?? '-' }}</td>
            <td>{{ $b->ruangan->nama ?? '-' }}</td>
            <td>{{ $b->tanggal }}</td>
            <td>{{ $b->jam_mulai }} - {{ $b->jam_selesai }}</td>
            <td>{{ $b->status }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>