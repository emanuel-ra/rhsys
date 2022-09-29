<div class="row">

    <div class="col-12 col-md-2">
        <x-dg-info-box bg="success" title="Personal Activo" text="{{ $enable_staff }}" icon="fas fa-user-check" :full="true" :grad="true"/>
    </div>

    <div class="col-12 col-md-2">
        <x-dg-info-box bg="danger" title="Personal dado de baja" text="{{ $disabled_staff }}" icon="fas fa-user-times" :full="true" :grad="true"/>
    </div>

    <div class="col-12 col-md-2">
        <x-dg-info-box bg="primary" title="Empresas" text="{{ $companies_count }}" icon="fas fa-building" :full="true" :grad="true"/>
    </div>
    <div class="col-12 col-md-2">
        <x-dg-info-box bg="info" title="Sucursales" text="{{ $branches_count }}" icon="fas fa-store" :full="true" :grad="true"/>
    </div>
  