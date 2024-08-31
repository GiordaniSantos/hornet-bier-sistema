<form method="post" action="{{ route('crente.update', ['id' => $crente->id]) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="row gx-3 mb-3">
        <div class="col-md-3">
            <label class="small mb-1" for="created_at">Data</label>
            <input class="form-control" id="created_at" name="created_at" type="datetime-local" placeholder="Data" value="{{ $crente->created_at ?? old('data') }}">
        </div>
    </div>
    <button class="btn btn-primary" type="submit">Atualizar</button>
</form>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://npmcdn.com/flatpickr/dist/flatpickr.min.js"></script>
<script src="https://npmcdn.com/flatpickr/dist/l10n/pt.js"></script>
<script>
    
    config = {
        enableTime: true,
        dateFormat: 'Y/m/d H:i',
        locale: 'pt',
        format: "d/m/Y H:i",
        altFormat: "d/m/Y H:i",
        altInput: true
    }
    flatpickr("input[type=datetime-local]", config);
</script>