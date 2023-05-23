<div class="prihlasenie_j" id="prihlasenie">
    <div class="sign_up_box">
        <form name="playerForm" method="POST" action="database/insert_player.php">
            <div class="jeden">
                <div class="sign_up_box_input">
                    <input type="text" name="meno" required="required">
                    <span>Meno</span>
                    <i></i>
                </div>
                <div class="sign_up_box_input">
                    <input type="number" name="odohrane_zapasy" required="required">
                    <span>Počet odohraných zápasov</span>
                    <i></i>
                </div>
                <div class="sign_up_box_input">
                    <input type="number" name="pocet_golov" required="required">
                    <span>Počet gólov</span>
                    <i></i>
                </div>
                <input type="submit" name="submit" value="Accept">
            </div>
            <div class="dva">
                <div class="sign_up_box_input">
                    <input type="text" name="priezvisko" required="required">
                    <span>Priezvisko</span>
                    <i></i>
                </div>
                <div class="sign_up_box_input">
                    <input type="number" name="rocnik" required="required">
                    <span>Ročník</span>
                    <i></i>
                </div>
                <div class="sign_up_box_input">
                    <input type="number" name="pocet_asistencii" required="required">
                    <span>Počet asistencií</span>
                    <i></i>
                </div>
                <select name="pozicia">
                    <option value="1">Brankár</option>
                    <option value="2">Obranca</option>
                    <option value="3">Útočník</option>
                </select>
            </div>
        </form>
    </div>           
</div>

<script>
document.querySelector('form[name="playerForm"]').addEventListener('submit', function(event) {
    var meno = document.querySelector('input[name="meno"]').value;
    var priezvisko = document.querySelector('input[name="priezvisko"]').value;
    var rocnik = parseInt(document.querySelector('input[name="rocnik"]').value);

    var errors = [];

    if (meno.length < 2) {
        errors.push("Meno musí mať minimálne 2 znaky.");
    }

    if (priezvisko.length < 2) {
        errors.push("Priezvisko musí mať minimálne 2 znaky.");
    }

    if (rocnik < 1950 || rocnik > 2023) {
        errors.push("Ročník musí byť medzi 1950 a 2023.");
    }

    if (errors.length > 0) {
        event.preventDefault(); // Zabránenie odosielaniu formulára pri chybách

        var errorMessages = errors.join('\n');
        alert(errorMessages);
    }
});
</script>
