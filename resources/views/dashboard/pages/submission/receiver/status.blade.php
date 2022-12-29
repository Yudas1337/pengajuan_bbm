<select id="select-regencies" name="status" class="form-control">
    <option {{ $data->status == 'Valid' ? 'selected' : '' }} value="Valid"
    >Valid
    </option>
    <option {{ $data->status == 'Draft' ? 'selected' : '' }} value="Draft">Draft
    </option>
    <option {{ $data->status == 'Perubahan' ? 'selected' : '' }} value="Perubahan">
        Perubahan
    </option>
    <option
        {{ $data->status == 'Tidak Valid' ? 'selected' : '' }} value="Tidak Valid">
        Tidak Valid
    </option>
</select>
