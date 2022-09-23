
<div class="col-sm-12 col-lg-6">
    <x-dg-input type="text" label="Direccion" name="address" maxlength="255" value="{{ $Staff->address }}" placeholder=""  />
</div>

<div class="col-sm-12 col-lg-6">
    <x-dg-input type="text" label="Codigo postal" name="zip_code" maxlength="255" value="{{ $Staff->zip_code }}" placeholder=""  />
</div>

<div class="col-sm-12 col-lg-6">
    <x-dg-input type="text" label="Colonia" name="suburb" maxlength="255" value="{{ $Staff->suburb }}" placeholder=""  />
</div>

<div class="col-sm-12 col-lg-6">
    <x-dg-input type="text" label="Municipio" name="town" maxlength="255" value="{{ $Staff->town }}" placeholder=""  />
</div>


<div class="col-sm-12 col-lg-6">
    <x-dg-input type="text" label="Ciudad" name="city" maxlength="255" value="{{ $Staff->city }}" placeholder=""  />
</div>

<div class="col-sm-12 col-lg-6 form-group">
    <label for="">Pais</label>
    <select id="country_id" name="country_id" class="form-control" required onchange="GetStates(this.value,'{{ csrf_token() }}','state_id')">        
        <option value=""></option>
        @foreach ($Country as $item)
            <option {{ ($item->id==$Staff->country_id) ? 'selected':'' }} value="{{ $item->id }}">{{ $item->name }}</option>
        @endforeach
    </select>
</div>


<div class="col-sm-12 col-lg-6 form-group">
    <label for="">Estado</label>
    <select id="state_id" name="state_id" class="form-control" >        
    </select>
</div>
