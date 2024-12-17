<form method="post">
    <table>
        <!-- Radio buttons -->
        <tr>
            <td><input type="radio" name="inputs[radio]" value="Hombre"> Hombre</td>
            <td><input type="radio" name="inputs[radio]" value="Mujer"> Mujer</td>
        </tr>
        
        <!-- Checkboxes -->
        <tr>
            <td><input type="checkbox" name="inputs[checkbox][]" value="futbol"> Futbol</td>
            <td><input type="checkbox" name="inputs[checkbox][]" value="baloncesto"> Baloncesto</td>
        </tr>
        
        <!-- Text fields -->
        <tr>
            <td><input type="text" name="inputs[text][]" placeholder="Nombre"></td>
            <td><input type="text" name="inputs[text][]" placeholder="Apellidos"></td>
        </tr>
        
        <!-- Submit -->
        <tr>
            <td>
                <input type="submit" value="enviar datos" name="accion">
        </td>
        </tr>
    </table>
</form>

