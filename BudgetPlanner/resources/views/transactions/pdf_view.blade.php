<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Reporte de Transacciones</title>
    <style>
        body { font-family: sans-serif; font-size: 14px; }
        h1 { text-align: center; color: #333; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f4f4f4; }
        .text-success { color: green; }
        .text-danger { color: red; }
        .total-box { margin-top: 20px; text-align: right; font-weight: bold; }
    </style>
</head>
<body>
    <h1>Reporte de Gastos e Ingresos</h1>
    <p>Generado el: {{ now()->format('d/m/Y H:i') }}</p>

    <table>
        <thead>
            <tr>
                <th>Fecha</th>
                <th>Tipo</th>
                <th>Categoría</th>
                <th>Descripción</th>
                <th>Monto</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transactions as $transaction)
                <tr>
                    <td>{{ $transaction->transaction_date->format('d/m/Y') }}</td>
                    <td>
                        {{ $transaction->transaction_type == 'income' ? 'Ingreso' : 'Gasto' }}
                    </td>
                    <td>{{ $transaction->category->name ?? 'Sin Categoría' }}</td>
                    <td>{{ $transaction->description }}</td>
                    <td class="{{ $transaction->transaction_type == 'income' ? 'text-success' : 'text-danger' }}">
                        ${{ number_format($transaction->amount, 2) }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>