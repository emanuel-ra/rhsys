<div class="col-sm-12 col-md-2">
    <x-dg-input type="text" label="Clave" name="code" maxlength="255" value="{{old('code')}}" placeholder=""  />
</div>

<div class="col-sm-12 col-md-2">
    <x-dg-input type="text" label="Clave Checador" name="checker_code" maxlength="255" value="{{old('checker_code')}}" placeholder=""  />
</div>

<div class="col-sm-12 col-md-8">
    <x-dg-input type="text" label="Nombre" name="name" maxlength="255" value="{{old('name')}}" placeholder=""  />
</div>

<div class="col-sm-12 col-lg-4">
    <x-dg-input type="text" label="Email" id="email" name="email" maxlength="255" value="{{old('email')}}" placeholder=""  />
</div>

<div class="col-sm-12 col-lg-4">
    <x-dg-input type="text" label="Teléfono celular" id="mobile_phone" name="mobile_phone" maxlength="255" value="{{old('mobile_phone')}}" placeholder=""  />
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
    <select id="company_id" name="company_id" class="form-control"  onchange="GetBranches(this.value,'{{ csrf_token() }}','branch_id','{{ url('') }}')">        
        <option value=""></option>
        @foreach ($Company as $item)
            <option value="{{ $item->id }}">{{ $item->name }}</option>
        @endforeach
    </select>
</div>

<div class="col-sm-12 col-lg-6 col-xl-4 form-group">
    <label for="">Sucursal</label>
    <select id="branch_id" name="branch_id" class="form-control"  >        
    </select>
</div>

<div class="col-sm-12 col-lg-6 col-xl-4">   
    <label for="">Departamento</label>
    <select name="department_id" id="department_id" class="form-control" onchange="GetJopPositions(this.value,'{{ csrf_token() }}','jop_position_id','{{ url('') }}')">
        <option value=""></option>
        @foreach ($Department as $item)
            <option {{ (old('department_id')==$item->id) ? 'selected':''; }} value="{{ $item->id }}">{{ $item->name }}</option>
        @endforeach
    </select>
</div>

<div class="col-sm-12 col-lg-6 col-xl-3">
    <label for="">Puesto</label>
    <select name="jop_position_id" id="jop_position_id" class="form-control">
        <option value=""></option>
    </select>
</div>

<div class="col-sm-12 col-lg-6 col-xl-3">
    <x-dg-select id="scholarship_id" name="scholarship_id" label="Escolaridad" inputclass="form-select" >        
        <x-dg-option value=""></x-dg-option>
        @foreach ($Scholarship as $item)
        <option {{ (old('scholarship_id')==$item->id) ? 'selected':''; }} value="{{ $item->id }}">{{ $item->name }}</option>
        @endforeach
    </x-dg-select>
</div>

<div class="col-sm-12 col-lg-6 col-xl-3">
    <x-dg-select id="maritial_status_id" name="maritial_status_id" label="Estado Civil" inputclass="form-select" >        
        <x-dg-option value=""></x-dg-option>
        @foreach ($MaritalStatus as $item)
        <option {{ (old('maritial_status_id')==$item->id) ? 'selected':''; }} value="{{ $item->id }}">{{ $item->name }}</option>
        @endforeach
    </x-dg-select>
</div>

<div class="col-sm-12 col-lg-6 col-xl-3">
    <x-dg-select id="supervisor_id" name="supervisor_id" label="Supervisor" inputclass="form-select" >        
        <x-dg-option value="0"></x-dg-option>
        @foreach ($Supervisor as $item)
            <option {{ (old('supervisor_id')==$item->id) ? 'selected':''; }} value="{{ $item->id }}">{{ $item->name }}</option>
        @endforeach
    </x-dg-select>
</div>

<div class="col-sm-12 col-lg-6 col-xl-3">
    <x-dg-select id="type_of_contract_id" name="type_of_contract_id" label="Tipo de Contrato" inputclass="form-select" >        
        <x-dg-option value=""></x-dg-option>
        @foreach ($TypeOfContract as $item)
        <option {{ (old('type_of_contract_id')==$item->id) ? 'selected':''; }} value="{{ $item->id }}">{{ $item->name }}</option>
        @endforeach
    </x-dg-select>
</div>

<div class="col-sm-12 col-md-2">
    <x-dg-input-date id="born_date" name="born_date" label="Fecha Nacimiento" value="{{old('born_date')}}"  />
</div>

<div class="col-sm-12 col-md-2">
    <x-dg-input-date id="hired_date" name="hired_date" label="Fecha ingreso" value="{{old('hired_date')}}"  />
</div>

<div class="col-sm-12 col-md-2">
    <x-dg-input-date id="expiration_date" name="expiration_date" label="Fecha Vencimiento" value="{{old('expiration_date')}}" />
</div>

<div class="col-sm-12 col-md-3">
    <x-dg-input id="daily_salary" name="daily_salary" label="Salario Diario" value="{{old('daily_salary')}}" />
</div>

<div class="form-group col-sm-12 col-md-3">
    <label for="blood_type">Tipo de Sangre</label>
    <input type="text"  list="l_blood_type" id="blood_type" name="blood_type" class="form-control" value="{{old('blood_type')}}">
    <datalist id="l_blood_type">
        <option value="A positivo (A +)">        
        <option value="A negativo (A-)">        
        <option value="B positivo (B +)">  
        <option value="B negativo (B-)">        
        <option value="AB positivo (AB+)">        
        <option value="AB negativo (AB-)">        
        <option value="O positivo (O+)">   
        <option value="O negativo (O-)">   
    </datalist>
</div>

<div class="col-sm-12 col-md-3">
    <label for="">Es supervisor?</label>
    <div class="form-check">
        <input class="form-check-input" type="radio" name="supervisor" id="supervisor_si" value="1">
        <label class="form-check-label" for="supervisor_si">
            Si
        </label>
    </div>
    <div class="form-check">
        <input class="form-check-input" checked type="radio" name="supervisor" id="supervisor_no" value="0">
        <label class="form-check-label" for="supervisor_no">
            No
        </label>
    </div>
</div>

<div class="col-sm-12 col-md-3">
    <label for="">Socioeconómico</label>
    <div class="form-check">
        <input class="form-check-input" checked type="radio" name="socioeconomic" id="socioeconomic_si" value="1">
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

<div class="col-sm-12 col-md-3">
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

<div class="col-sm-12">
   <label for="">Actividades</label>
   <textarea name="activities" class="form-control"></textarea>
</div>

@section('js')
    <script>       
        var element = document.querySelectorAll('phone-input')

        var maskOptions = { mask: '(00) 0000-0000' };
        var mask = IMask(document.getElementById('mobile_phone'), maskOptions);
        var mask = IMask(document.getElementById('landline_number'), maskOptions);
        var mask = IMask(document.getElementById('landline_emergency_phone'), maskOptions);
        var mask = IMask(document.getElementById('mobile_emergency_phone'), maskOptions);
        
    </script>
@endsection