@extends('layouts.app')

@section('content')
<div class="container py-4">
  <div class="row justify-content-center g-4">

    {{-- FORMULARIO --}}
    <div class="col-md-5">
      <div class="card shadow border-success bg-success bg-opacity-10">
        <div class="card-header bg-success text-white">
          <i class="bi bi-plus-circle me-2"></i> Agregar Categoría
        </div>

        <div class="card-body">
          <div id="client-validation-errors"></div>

          <form id="createCategoryForm" action="{{route('categories.store')}}" method="POST">
            @csrf

            <div class="mb-3">
              <label for="name" class="form-label fw-bold">Nombre de Categoría</label>
              <input type="text" class="form-control" name="name" id="name" placeholder="Ej: Comida, Transporte" required>
            </div>

            <div class="mb-3">
              <label for="type" class="form-label fw-bold">¿Ingreso o Gasto?</label>
              <select class="form-select" name="type" id="type" required>
                <option selected disabled value="">--Seleccione tipo de Categoría--</option>
                <option value="1">Ingreso</option>
                <option value="0">Gasto</option>
              </select>
            </div>

            <div class="d-grid mt-3">
              <button type="submit" class="btn btn-success btn-lg">
                <i class="bi bi-plus-lg me-2"></i> Crear Categoría
              </button>
            </div>

          </form>

        </div>
      </div>
    </div>

    {{-- TABLA DE CATEGORÍAS --}}
    <div class="col-md-7">
      @include('layouts.table_categories')
    </div>

  </div>
</div>

{{-- VALIDACIÓN --}}
<script>
  document.getElementById('createCategoryForm').addEventListener('submit', function(event) {
    const errorContainer = document.getElementById('client-validation-errors');
    errorContainer.innerHTML = '';

    const name = document.getElementById('name').value.trim();
    const type = document.getElementById('type').value;

    let errors = [];

    if (!name) {
      errors.push('El nombre de la categoría es obligatorio.');
    }

    if (!type) {
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
