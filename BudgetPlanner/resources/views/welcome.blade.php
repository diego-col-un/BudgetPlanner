@extends('layouts.app')

@section('content')
<div class="container pt-3">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <!-- <h1 class="mb-2">Bienvenido, {{auth()->user()->name}}</h1> -->
      <hr class="my-2">
      <div class="d-flex justify-content-between align-items-center mb-3">
      <h2 class="mb-0">Mi actividad</h2>
        <a href="{{ route('my-profile.index') }}"  class="btn btn-outline-primary btn-sm d-flex align-items-center gap-2">
        <i class="bi bi-person-circle"></i> Modificar perfil
        </a>
    </div>

 <div class="card shadow rounded-4 border-0 p-3">
        <div class="card-body p-0">
          <table class="table table-hover table-striped mb-0 rounded-4 overflow-hidden">
            <thead style="background: linear-gradient(90deg, #4e73df, #1cc88a); color: white;" class="text-center">
              <tr>
                <th>Descripción</th>
                <th>Categoría</th>
                <th>Monto</th>
                <th>Presupuesto</th>
                <th>Fecha</th>
                <th>Total gastado</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($transactions as $transaction)
              <tr>
                <td class="fw-semibold">{{ $transaction->description }}</td>
                <td>{{ $transaction->category->name }}</td>
                <td class="text-end text-primary fw-bold">{{ number_format($transaction->amount, 2, ',', '.') }}</td>
                <td class="text-success fw-bold">
                  {{ $transaction->category->budgets->first()->limit ?? 'Sin presupuesto' }}
                </td>
                <td>{{ $transaction->transaction_date }}</td>
                <td></td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card shadow-sm rounded-4 border-0 bg-white">
        <div class="card-header text-center fw-bold">Dashboard</div>
        <div class="card-body d-grid gap-3">
          <!-- @if (auth()->user()->role_id == 1)
          <a href="{{ route('admin-panel.index') }}" class="btn btn-outline-primary d-flex align-items-center gap-2">
            <i class="bi bi-person-badge"></i> Panel de administrador
          </a>
          @endif -->
          <a href="{{ route('transactions.index') }}" class="btn btn-outline-primary d-flex align-items-center gap-2">
            <i class="bi bi-wallet2"></i> Ver transacciones
          </a>
          <a href="{{ route('goals.index') }}" class="btn btn-outline-primary d-flex align-items-center gap-2">
            <i class="bi bi-flag"></i> Ver metas
          </a>
          <a href="{{ route('categories.index') }}" class="btn btn-outline-primary d-flex align-items-center gap-2">
            <i class="bi bi-tags"></i> Ver categorías
          </a>
          <a href="{{ route('budgets.index') }}" class="btn btn-outline-primary d-flex align-items-center gap-2">
            <i class="bi bi-cash"></i> Ver presupuestos
          </a>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- <script>
  document.addEventListener('DOMContentLoaded', () => {
    fetch('https://economia.awesomeapi.com.br/json/last/USD-COP')
      .then(response => response.json())
      .then(data => {
        const rate = data.USDCOP.bid;

        const rateBox = document.createElement('div');
        rateBox.className = 'bg-light border rounded-3 p-3 mt-4 shadow-sm d-flex align-items-center gap-3';
        rateBox.innerHTML = `
          <i class="bi bi-currency-exchange fs-2 text-info"></i>
          <div>
            <h6 class="mb-1 fw-bold text-info">Tasa de cambio actual</h6>
            <p class="mb-0 text-secondary">1 USD = <span class="fw-semibold text-dark">${parseFloat(rate).toFixed(2)} COP</span></p>
          </div>
        `;

        document.querySelector('.col-md-4').appendChild(rateBox);
      })
      .catch(error => {
        console.error('Error al obtener tasa de cambio:', error);
      });
  });
</script> -->
@endsection