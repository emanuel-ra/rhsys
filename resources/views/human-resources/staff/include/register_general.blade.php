<div class="col-sm-12 col-md-2">
    <x-dg-input type="text" label="Clave" name="code" maxlength="255" value="{{old('code')}}" placeholder=""  />
</div>

<div class="col-sm-12 col-md-10">
    <x-dg-input type="text" label="Nombre" name="name" maxlength="255" value="{{old('name')}}" placeholder=""  />
</div>


<div class="col-sm-12 col-lg-6">
    <x-dg-input type="text" label="Email" id="email" name="email" maxlength="255" value="{{old('email')}}" placeholder=""  />
</div>

<div class="col-sm-12 col-lg-6">
    <x-dg-input type="text" label="Teléfono/Celular" id="mobile_phone" name="mobile_phone" maxlength="255" value="{{old('mobile_phone')}}" placeholder=""  />
</div>


<div class="col-sm-12 col-lg-6 col-xl-4">
    <x-dg-input type="text" label="CURP" name="curp" maxlength="255" value="{{old('curp')}}" placeholder=""  />
</div>

<div class="col-sm-12 col-lg-6 col-xl-4">
    <x-dg-input type="text" label="RFC" name="rfc" maxlength="255" value="{{old('rfc')}}" placeholder="" />
</div>

<div class="col-sm-12 col-lg-6 col-xl-4">
    <x-dg-input type="text" label="Número de Seguro Social" name="nss" maxlength="255" value="{{old('nss')}}" placeholder="" />
</div>

<div class="col-sm-12 col-lg-6 col-xl-4">
    <x-dg-input type="text" label="Cuenta Bancaria" name="bank_account" maxlength="255" value="{{old('bank_account')}}" placeholder="" />
</div>

<div class="col-sm-12 col-lg-6 col-xl-4 form-group">
    <label for="">Empresa</label>
    <select id="company_id" name="company_id" class="form-control"  onchange="GetBranches(this.value,'{{ csrf_token() }}','branch_id')">        
        <option value=""></option>
        @foreach ($Company as $item)
            <option {{ (old('company_id')==$item->id) ? 'selected':''; }} value="{{ $item->id }}">{{ $item->name }}</option>
        @endforeach
    </select>
</div>

<div class="col-sm-12 col-lg-6 col-xl-4 form-group">
    <label for="">Sucursal</label>
    <select id="branch_id" name="branch_id" class="form-control"  >        
    </select>
</div>

<div class="col-sm-12 col-lg-6 col-xl-4">
    <x-dg-select id="department_id" name="department_id" label="Departamentos" inputclass="form-select" >        
        <x-dg-option value=""></x-dg-option>
        @foreach ($Department as $item)
        <option {{ (old('department_id')==$item->id) ? 'selected':''; }} value="{{ $item->id }}">{{ $item->name }}</option>
        @endforeach
    </x-dg-select>
</div>

<div class="col-sm-12 col-lg-6 col-xl-4">
    <x-dg-select id="jop_position_id" name="jop_position_id" label="Puesto" inputclass="form-select" >        
        <x-dg-option value=""></x-dg-option>
        @foreach ($JopPosition as $item)
        <option {{ (old('jop_position_id')==$item->id) ? 'selected':''; }} value="{{ $item->id }}">{{ $item->name }}</option>
        @endforeach
    </x-dg-select>
</div>

<div class="col-sm-12 col-lg-6 col-xl-4">
    <x-dg-select id="scholarship_id" name="scholarship_id" label="Escolaridad" inputclass="form-select" >        
        <x-dg-option value=""></x-dg-option>
        @foreach ($Scholarship as $item)
        <option {{ (old('scholarship_id')==$item->id) ? 'selected':''; }} value="{{ $item->id }}">{{ $item->name }}</option>
        @endforeach
    </x-dg-select>
</div>

<div class="col-sm-12 col-lg-6 col-xl-4">
    <x-dg-select id="maritial_status_id" name="maritial_status_id" label="Estado Civil" inputclass="form-select" >        
        <x-dg-option value=""></x-dg-option>
        @foreach ($MaritalStatus as $item)
        <option {{ (old('maritial_status_id')==$item->id) ? 'selected':''; }} value="{{ $item->id }}">{{ $item->name }}</option>
        @endforeach
    </x-dg-select>
</div>

<div class="col-sm-12 col-md-2">
    <x-dg-input-date id="born_date" name="born_date" label="Fecha Nacimiento" value="old('born_date')"  />
</div>

<div class="col-sm-12 col-md-2">
    <x-dg-input-date id="hired_date" name="hired_date" label="Fecha ingreso" value="old('hired_date')"  />
</div>

<div class="col-sm-12 col-md-2">
    <x-dg-input-date id="expiration_date" name="expiration_date" label="Fecha Vencimiento" value="old('expiration_date')" />
</div>


<div class="col-sm-12 col-md-4">
    <label for="">Socioeconómico</label>
    <div class="form-check">
        <input class="form-check-input" type="radio" name="socioeconomic" id="socioeconomic_si" value="1">
        <label class="form-check-label" for="socioeconomic_si">
            Si
        </label>
        </div>
    <div class="form-check">
        <input class="form-check-input" type="radio" name="socioeconomic" id="socioeconomic_no" value="0">
        <label class="form-check-label" for="socioeconomic_no">
            No
        </label>
    </div>
</div>

<div class="col-sm-12 col-md-4">
    <label for="">Sexo</label>
    <div class="form-check">
        <input class="form-check-input" type="radio" name="genre" id="male" value="Masculino">
        <label class="form-check-label" for="male">
            Masculino
        </label>
        </div>
    <div class="form-check">
        <input class="form-check-input" type="radio" name="genre" id="female" value="Femenino">
        <label class="form-check-label" for="female">
            Femenino
        </label>
    </div>
</div>

@section('js')
    <script>
        var element = document.getElementById('mobile_phone');
        var maskOptions = { mask: '(00) 0000-0000' };
        var mask = IMask(element, maskOptions);


        //GetBranches(document.getElementById('company_id').value,'{{ csrf_token() }}','branch_id')
    </script>
@endsection