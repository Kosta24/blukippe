<div id="filtri-calendar">
    <h2>Filtri: </h2>
    <div class="input-holder">
        <input class="float-label inner-label" type="text" id="eventRicerca_disciplina" name="eventRicerca_disciplina" required />
        <label for="eventRicerca_disciplina">Disciplina</label>
    </div>
    <div class="input-holder">
        <input class="float-label inner-label" type="text" id="eventRicerca_attivita" name="eventRicerca_attivita" required />
        <label for="eventRicerca_attivita">Attivita</label>
    </div>
    <div class="input-holder">
        <select class="float-label inner-label" type="text" id="eventRicerca_locale" name="eventRicerca_locale" required></select>
        <label for="eventRicerca_locale">Locale</label>
    </div>
    <div class="input-holder">
        <select class="float-label inner-label" type="text" id="eventRicerca_ente" name="eventRicerca_ente" required>
            <option>Ente</option>
            <option>Ente1</option>
            <option>Ente2</option>
        </select>
        <label for="eventRicerca_ente">Ente</label>
    </div>
    <div class="row input-holder">
        <select class="col float-label inner-label" type="text" id="eventRicerca_stato" name="eventRicerca_stato" required>
            <option>1</option>
            <option>2</option>
            <option>3</option>
        </select>
        <label for="eventRicerca_stato">stato</label>
        <label class="col" for="eventRicerca_annullato">Annullato:
            <input class="form-check" style="margin:auto" type="checkbox" id="eventRicerca_annullato" name="eventRicerca_annullato"></label>
    </div>

    <div class="row">
        <label class="col-sm-3" for="eventRicerca_annullato">Arbitro
            <input class="form-check" style="margin:auto" type="checkbox" id="eventRicerca_annullato" name="eventRicerca_annullato"></label>

        <label class="col-sm-3" for="eventRicerca_pubblico">Pubblico
            <input class="form-check" style="margin:auto" type="checkbox" id="eventRicerca_pubblico" name="eventRicerca_pubblico"></label>

        <label class="col-sm-3" for="eventRicerca_RespSicurezza">RespSicurezza
            <input class="form-check" style="margin:auto" type="checkbox" id="eventRicerca_RespSicurezza" name="eventRicerca_RespSicurezza"></label>
    </div>
    <div class="row">
        <button class="closeOverlayBtn col" id="clearOverlayBtn">Pulisci Campi</button>
    </div>
</div>