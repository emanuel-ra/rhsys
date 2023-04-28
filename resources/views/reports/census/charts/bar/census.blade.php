<div class="col-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ $branch_name }}</h3>
            <div class="card-tools">
                <!-- Maximize Button -->
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
            </div>
        </div>
        <div class="card-body">
            <canvas id="census_{{ $uuid }}" width="100%" height="100%"></canvas>
        </div>
    </div>
</div>