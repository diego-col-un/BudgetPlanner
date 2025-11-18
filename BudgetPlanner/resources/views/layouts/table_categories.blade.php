<div class="card shadow bg-success bg-opacity-10">
  <div class="card-header bg-success text-white">
    <h5 class="card-title mb-0">
      <i class="bi bi-list-ul me-2"></i>
      Total de categorias: {{count($categories)}}
    </h5>
  </div>
  <div class="card-body p-0">
    <div class="table-responsive">
      <table class="table table-hover table-success">
        <thead class="table-success">
          <tr>
            <th>Nombre</th>
            <th>Tipo</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($categories as $categorie)
          <tr>
            <td class="fw-semibold">{{$categorie->name}}</td>
            <td>{{$categorie->type}}</td>
            <td class="d-flex gap-4">
              <a href="{{route('categories.edit', $categorie->id)}}" class="btn btn-primary">
                <i class="bi bi-pencil-square"></i>
              </a>
              <form action="{{route('categories.destroy', $categorie->id)}}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">
                  <i class="bi bi-trash"></i>
                </button>
              </form>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>