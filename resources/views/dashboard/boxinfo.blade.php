<div class="row">
  
    <div class="info-box col-12 col-md-2 m-1">
        <span class="info-box-icon bg-success"><i class="fas fa-user-check"></i></span>
        <div class="info-box-content">
            <span class="info-box-text">Personal Activo</span>
            <span class="info-box-number">{{ $enable_staff }}</span>            
        </div>
    </div>

    <div class="info-box col-12 col-md-2 m-1">
        <span class="info-box-icon bg-danger"><i class="fas fa-user-check"></i></span>
        <div class="info-box-content">
            <span class="info-box-text">Personal dado de baja</span>
            <span class="info-box-number">{{ $disabled_staff }}</span>            
        </div>
    </div>

    <div class="info-box col-12 col-md-2 m-1">
        <span class="info-box-icon bg-primary"><i class="fas fa-building"></i></span>
        <div class="info-box-content">
            <span class="info-box-text">Empresas</span>
            <span class="info-box-number">{{ $companies_count }}</span>            
        </div>
    </div>

    <div class="info-box col-12 col-md-2 m-1">
        <span class="info-box-icon bg-info"><i class="fas fa-store"></i></span>
        <div class="info-box-content">
            <span class="info-box-text">Sucursales</span>
            <span class="info-box-number">{{ $branches_count }}</span>            
        </div>
    </div>
    
</div>
  