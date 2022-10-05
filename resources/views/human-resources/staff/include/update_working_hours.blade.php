<div class="col-12 col-sm-6">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Dia</th>
                <th class="text-center" colspan="2">Horario</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <x-dg-input-switch label="Lunes" id="monday" name="monday[]" value="1"/>
                </td>
                <td>
                    <label for="">Hora de Entrada</label>
                    <input type="time" name="monday[]" id="monday_start" class="form-control" >
                </td>
                <td>
                    <label for="">Hora de Salida</label>
                    <input type="time" name="monday[]" id="monday_end" class="form-control" >
                </td>
            </tr>
            <tr>
                <td>
                    <x-dg-input-switch label="Martes" id="tuesday" name="tuesday[]"/>
                </td>
                <td>
                    <label for="">Hora de Entrada</label>
                    <input type="time" name="tuesday[]"  id="tuesday_start" class="form-control" >
                </td>
                <td>
                    <label for="">Hora de Salida</label>
                    <input type="time" name="tuesday[]" id="tuesday_end"  class="form-control" >
                </td>
            </tr>
            <tr>
                <td>
                    <x-dg-input-switch label="Miercoles" id="wednesday" name="wednesday[]"/>
                </td>
                <td>
                    <label for="">Hora de Entrada</label>
                    <input type="time" name="wednesday[]" id="wednesday_start"  class="form-control" >
                </td>
                <td>
                    <label for="">Hora de Salida</label>
                    <input type="time" name="wednesday[]" id="wednesday_end" class="form-control" >
                </td>
            </tr>
            <tr>
                <td>
                    <x-dg-input-switch label="Jueves" id="thursday" name="thursday[]"/>
                </td>
                <td>
                    <label for="">Hora de Entrada</label>
                    <input type="time" name="thursday[]" id="thursday_start" class="form-control" >
                </td>
                <td>
                    <label for="">Hora de Salida</label>
                    <input type="time" name="thursday[]" id="thursday_end" class="form-control" >
                </td>
            </tr>
            <tr>
                <td>
                    <x-dg-input-switch label="Viernes" id="friday" name="friday[]"/>
                </td>
                <td>
                    <label for="">Hora de Entrada</label>
                    <input type="time" name="friday[]" id="friday_start" class="form-control" >
                </td>
                <td>
                    <label for="">Hora de Salida</label>
                    <input type="time" name="friday[]" id="friday_end"  class="form-control" >
                </td>
            </tr>
            <tr>
                <td>
                    <x-dg-input-switch label="Sabado" id="saturday" name="saturday[]"/>
                </td>
                <td>
                    <label for="">Hora de Entrada</label>
                    <input type="time" name="saturday[]" id="saturday_start" class="form-control" >
                </td>
                <td>
                    <label for="">Hora de Salida</label>
                    <input type="time" name="saturday[]" id="saturday_end"  class="form-control" >
                </td>
            </tr>
            <tr>
                <td>
                    <x-dg-input-switch label="Domingo" id="sunday" name="sunday[]"/>
                </td>
                <td>
                    <label for="">Hora de Entrada</label>
                    <input type="time" name="sunday[]" id="sunday_start" class="form-control" class="timeMaks">
                </td>
                <td>
                    <label for="">Hora de Salida</label>
                    <input type="time" name="sunday[]" id="sunday_end"  class="form-control" class="timeMaks">
                </td>
            </tr>
        </tbody>
    </table>
</div>
