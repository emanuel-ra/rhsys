<div class="col-sm-12 col-md-2">
    <x-dg-input type="text" label="Clave" name="code" maxlength="255" value="{{old('name')}}" placeholder="" required />
</div>

<div class="col-sm-12 col-md-10">
    <x-dg-input type="text" label="Nombre" name="name" maxlength="255" value="{{old('name')}}" placeholder="" required />
</div>

<div class="col-sm-12 col-lg-6 col-xl-4">
    <x-dg-input type="text" label="CURP" name="email" maxlength="255" value="{{old('email')}}" placeholder="" required />
</div>

<div class="col-sm-12 col-lg-6 col-xl-4">
    <x-dg-input type="text" label="RFC" name="email" maxlength="255" value="{{old('email')}}" placeholder="" required />
</div>

<div class="col-sm-12 col-lg-6 col-xl-4">
    <x-dg-input type="text" label="Número de Seguro Social" name="email" maxlength="255" value="{{old('email')}}" placeholder="" required />
</div>

<div class="col-sm-3 form-group">
    <label for="">Empresa</label>
    <select id="company_id" name="company_id" class="form-control" required onchange="GetBranches(this.value,'{{ csrf_token() }}','branch_id')">        
        <option value=""></option>
        @foreach ($Company as $item)
            <option value="{{ $item->id }}">{{ $item->name }}</option>
        @endforeach
    </select>
</div>

<div class="col-sm-3 form-group">
    <label for="">Sucursal</label>
    <select id="branch_id" name="branch_id" class="form-control" required >        
    </select>
</div>

<div class="col-sm-3">
    <x-dg-select id="departments" name="departments" label="Departamentos" inputclass="form-select" required>        
        <x-dg-option value=""></x-dg-option>
        @foreach ($Department as $item)
            <x-dg-option value="{{ $item->id }}">{{ $item->name }}</x-dg-option>
        @endforeach
    </x-dg-select>
</div>

<div class="col-sm-3">
    <x-dg-select id="jop_position" name="jop_position" label="Puesto" inputclass="form-select" required>        
        <x-dg-option value=""></x-dg-option>
        @foreach ($JopPosition as $item)
            <x-dg-option value="{{ $item->id }}">{{ $item->name }}</x-dg-option>
        @endforeach
    </x-dg-select>
</div>

<div class="col-sm-3">
    <x-dg-select id="scholarship_id" name="scholarship_id" label="Escolaridad" inputclass="form-select" required>        
        <x-dg-option value=""></x-dg-option>
        @foreach ($Scholarship as $item)
            <x-dg-option value="{{ $item->id }}">{{ $item->name }}</x-dg-option>
        @endforeach
    </x-dg-select>
</div>

<div class="col-sm-12 col-md-2">
    <x-dg-input-date id="myID0" label="Fecha Nacimiento" name="" required  />
</div>

<div class="col-sm-12 col-md-2">
    <x-dg-input-date id="myID" label="Fecha ingreso" name="" required  />
</div>

<div class="col-sm-12 col-md-2">
    <x-dg-input-date id="myID2" label="Fecha Vencimiento" name="" required  />
</div>


<div class="col-sm-12 col-md-3">
    <label for="">Sexo</label>
    <div class="d-flex justify-content-around">
        <div class="form-check">
            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1" value="Masculino">
            <label class="form-check-label" for="flexRadioDefault1">
                Masculino
            </label>
            </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" value="Femenino">
            <label class="form-check-label" for="flexRadioDefault2">
                Femenino
            </label>
        </div>
    </div>
</div>