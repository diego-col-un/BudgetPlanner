@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="card shadow border-success bg-success bg-opacity-10">
        <div class="card-header bg-success text-white">
          <i class="bi bi-pencil-square me-2"></i> Modifica esta categoría
        </div>
        <div class="card-body">

          <div id="client-validation-errors"></div>

          <form id="editCategoryForm" action="{{route('categories.update', $category->id)}}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="name" class="form-label fw-bold">Nombre</label>
                <input type="text" class="form-control" name="name" id="name" value="{{ $category->name }}" required>
              </div>

              <div class="col-md-6 mb-3">
                <label for="type" class="form-label fw-bold">Tipo de categoría</label>
                <select class="form-select" name="type" id="type" required>
                  <option disabled>--Seleccione un tipo de categoría--</option>
                  <option value="income" {{ $category->type == 'income' ? 'selected' : '' }}>Ingreso</option>
                  <option value="expense" {{ $category->type == 'expense' ? 'selected' : '' }}>Gasto</option>
                </select>
              </div>

              <div class="d-grid">
                <button type="submit" class="btn btn-success btn-lg">
                  <i class="bi bi-check-lg me-2"></i>
                  Actualizar Categoría
                </button>
              </div>
            </div>
          </form>

        </div>
      </div>
    </div>
  </div>
</div>

<script>
  document.getElementById('editCategoryForm').addEventListener('submit', function(event) {
    const errorContainer = document.getElementById('client-validation-errors');
    errorContainer.innerHTML = '';

    const name = document.getElementById('name').value.trim();
    const type = document.getElementById('type').value;

    let errors = [];

    if (!name) {
      errors.push('El nombre de la categoría es obligatorio.');
    }

    if (!type || type === '--Seleccione un tipo de categoría--') {
      errors.push('Debe seleccionar si es ingreso o gasto.');
    }

    if (errors.length > 0) {
      event.preventDefault();

      const alertDiv = document.createElement('div');
      alertDiv.classList.add('alert', 'alert-danger');

      const ul = document.createElement('ul');
      errors.forEach(error => {
        const li = document.createElement('li');
        li.textContent = error;
        ul.appendChild(li);
      });

      alertDiv.appendChild(ul);
      errorContainer.appendChild(alertDiv);
    }
  });
</script>
@endsection