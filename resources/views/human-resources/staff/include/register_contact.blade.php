
<div class="col-sm-12">
    <x-dg-input type="text" label="Nombre del padre" name="father_name" maxlength="255" value="{{old('father_name')}}" placeholder=""  />
</div>

<div class="col-sm-12">
    <x-dg-input type="text" label="Nombre de la madre" name="mother_name" maxlength="255" value="{{old('mother_name')}}" placeholder=""  />
</div>

<div class="col-sm-12">
    <x-dg-input type="text" label="Nombre de cónyuge" name="spouse_name" maxlength="255" value="{{old('spouse_name')}}" placeholder=""  />
</div>


<div class="col-sm-12">
    <x-dg-input type="text" label="Nombre de los hijos" name="chields_name" maxlength="500" value="{{old('chields_name')}}" placeholder=""  />
</div>

<div class="col-sm-12 col-lg-2">
    <x-dg-input type="text" label="Teléfono fijo" id="landline_number" name="landline_number" maxlength="255" value="{{old('landline_number')}}" placeholder=""  />
</div>

<div class="col-sm-12 col-lg-2">
    <x-dg-input type="text" label="Teléfono celular de emergencias" id="mobile_emergency_phone" name="mobile_emergency_phone" maxlength="255" value="{{old('mobile_emergency_phone')}}" placeholder=""  />
</div>

<div class="col-sm-12 col-lg-2">
    <x-dg-input type="text" label="Teléfono fijo emergencias" id="landline_emergency_phone" name="landline_emergency_phone" maxlength="255" value="{{old('landline_emergency_phone')}}" placeholder=""  />
</div>