
<div class="col-sm-12">
    <x-dg-input type="text" label="Nombre del padre" name="father_name" maxlength="255" value="{{ $Staff->father_name }}" placeholder=""  />
</div>

<div class="col-sm-12">
    <x-dg-input type="text" label="Nombre de la madre" name="mother_name" maxlength="255" value="{{ $Staff->mother_name }}" placeholder=""  />
</div>

<div class="col-sm-12">
    <x-dg-input type="text" label="Nombre de cónyuge" name="spouse_name" maxlength="255" value="{{ $Staff->spouse_name }}" placeholder=""  />
</div>


<div class="col-sm-12">
    <x-dg-input type="text" label="Nombre de los hijos" name="chields_name" maxlength="500" value="{{ $Staff->chields_name }}" placeholder=""  />
</div>

<div class="col-sm-12">
    <x-dg-input type="text" label="Nombre de contacto de emergencias" name="name_person_emergency" maxlength="255" value="{{ $Staff->name_person_emergency }}" placeholder=""  />
</div>

<div class="col-sm-12 col-lg-2">
    <x-dg-input type="text" label="Teléfono fijo" id="landline_number" name="landline_number" maxlength="255" value="{{ $Staff->landline_number }}" placeholder=""  />
</div>

<div class="col-sm-12 col-lg-2">
    <x-dg-input type="text" label="Teléfono celular de emergencias" id="mobile_emergency_phone" name="mobile_emergency_phone" maxlength="255" value="{{ $Staff->mobile_emergency_phone }}" placeholder=""  />
</div>

<div class="col-sm-12 col-lg-2">
    <x-dg-input type="text" label="Teléfono fijo emergencias" id="landline_emergency_phone" name="landline_emergency_phone" maxlength="255" value="{{ $Staff->landline_emergency_phone }}" placeholder=""  />
</div>