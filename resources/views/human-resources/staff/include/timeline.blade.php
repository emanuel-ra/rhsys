<div class="col-md-12">
    <div class="timeline">

       
        @if (count($logs))
            @foreach ($logs as $log)
                
                @if ($log->description=='Alta')
                    <div class="time-label">
                        <span class="bg-blue">{{ $log->created_at }}</span>
                    </div>
                @endif

                @if ($log->description=='Actualizado')
                    <div class="time-label">
                        <span class="bg-info">{{ $log->created_at }}</span>
                    </div>
                @endif

                @if ($log->description=='Baja')
                    <div class="time-label">
                        <span class="bg-red">{{ $log->created_at }}</span>
                    </div>
                @endif

                <div>
                    @if ($log->description=='Alta')
                        <i class="fas fa-plus bg-primary"></i>
                    @endif
                    @if ($log->description=='Actualizado')
                        <i class="fas fa-edit bg-info"></i>
                    @endif
                    @if ($log->description=='Baja')
                        <i class="fas fa-ban bg-danger"></i>
                    @endif
                    
                    <div class="timeline-item">
                        <span class="time"><i class="fas fa-clock"></i> {{ $log->created_at }}</span>
                        <h3 class="timeline-header no-border">
                            <a href="#">
                                <b>{{ $log->user->name }}</b> 
                                
                            </a>
                            @if ($log->description=='Alta')
                                Dio de alta
                            @endif
                            @if ($log->description=='Actualizado')
                                Actualizo
                            @endif
                            @if ($log->description=='Baja')
                                Dio de Baja
                            @endif
                            
                        </h3>
                    </div>

                </div>

            @endforeach
        @endif

        <div>
            <i class="fas fa-clock bg-gray"></i>
        </div>

    </div>
</div>