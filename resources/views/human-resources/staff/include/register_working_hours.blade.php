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
                    <x-dg-input-switch label="Lunes" id="monday" checked name="monday[]" value="1"/>
                </td>
                <td>
                    <label for="">Hora de Entrada</label>
                    <input type="time" name="monday[]" class="form-control">
                </td>
                <td>
                    <label for="">Hora de Salida</label>
                    <input type="time" name="monday[]" class="form-control">
                </td>
            </tr>
            <tr>
                <td>
                    <x-dg-input-switch label="Martes" checked id="tuesday" name="tuesday[]"/>
                </td>
                <td>
                    <label for="">Hora de Entrada</label>
                    <input type="time" name="tuesday[]" class="form-control">
                </td>
                <td>
                    <label for="">Hora de Salida</label>
                    <input type="time" name="tuesday[]" class="form-control">
                </td>
            </tr>
            <tr>
                <td>
                    <x-dg-input-switch label="Miercoles" checked id="wednesday" name="wednesday[]"/>
                </td>
                <td>
                    <label for="">Hora de Entrada</label>
                    <input type="time" name="wednesday[]" class="form-control">
                </td>
                <td>
                    <label for="">Hora de Salida</label>
                    <input type="time" name="wednesday[]" class="form-control">
                </td>
            </tr>
            <tr>
                <td>
                    <x-dg-input-switch label="Jueves" checked id="thursday" name="thursday[]"/>
                </td>
                <td>
                    <label for="">Hora de Entrada</label>
                    <input type="time" name="thursday[]" class="form-control">
                </td>
                <td>
                    <label for="">Hora de Salida</label>
                    <input type="time" name="thursday[]" class="form-control">
                </td>
            </tr>
            <tr>
                <td>
                    <x-dg-input-switch label="Viernes" checked id="friday" name="friday[]"/>
                </td>
                <td>
                    <label for="">Hora de Entrada</label>
                    <input type="time" name="friday[]" class="form-control">
                </td>
                <td>
                    <label for="">Hora de Salida</label>
                    <input type="time" name="friday[]" class="form-control">
                </td>
            </tr>
            <tr>
                <td>
                    <x-dg-input-switch label="Sabado" checked id="saturday" name="saturday[]"/>
                </td>
                <td>
                    <label for="">Hora de Entrada</label>
                    <input type="time" name="saturday[]" class="form-control">
                </td>
                <td>
                    <label for="">Hora de Salida</label>
                    <input type="time" name="saturday[]" class="form-control">
                </td>
            </tr>
            <tr>
                <td>
                    <x-dg-input-switch label="Domingo" id="sunday" name="sunday[]"/>
                </td>
                <td>
                    <label for="">Hora de Entrada</label>
                    <input type="time" name="sunday[]" class="form-control" class="timeMaks">
                </td>
                <td>
                    <label for="">Hora de Salida</label>
                    <input type="time" name="sunday[]" class="form-control" class="timeMaks">
                </td>
            </tr>
        </tbody>
    </table>
</div>