<div class="row">

    <div class="col-12 col-md-2">
        <x-dg-info-box bg="success" title="Personal Activo" text="{{ $enable_staff }}" icon="fas fa-user-check" :full="true" :grad="true"/>
    </div>
    <div class="col-12 col-md-2">
        <x-dg-info-box bg="danger" title="Personal dado de baja" text="{{ $disabled_staff }}" icon="fas fa-user-times" :full="true" :grad="true"/>
    </div>


</div>