<div id="filtri-calendar">
    <h2>Filtri: </h2>
    <div class="input-holder">
        <select class="float-label inner-label" onchange="return getEventiCalendario(0)" type="text" id="eventRicerca_disciplina" name="eventRicerca_disciplina"   required>
        <option value=" ">Tutte</option>
        </select>
        <label for="eventRicerca_disciplina">Disciplina</label>
    </div>
    <div class="input-holder">
        <select class="float-label inner-label" onchange="return getEventiCalendario(0)" type="text" id="eventRicerca_attivita" name="eventRicerca_attivita"   required>
        <option value=" ">Tutte</option>
        </select>
        <label for="eventRicerca_attivita">Attività</label>
    </div>
    <div class="input-holder">
        <select class="float-label inner-label" onchange="return getEventiCalendario(0)" type="text" id="eventRicerca_locale" name="eventRicerca_locale"   required>
        <option value=" ">Tutti</option>
        </select>
        <label for="eventRicerca_locale">Locale</label>
    </div>
    <div class="input-holder">
        <select class="float-label inner-label" onchange="return getEventiCalendario(0)" type="text" id="eventRicerca_ente" name="eventRicerca_ente" required>
        <option value=" ">Tutti</option>
        </select>
        <label for="eventRicerca_ente">Ente</label>
    </div>
    <div class="row input-holder">
        <select class="col float-label inner-label" onchange="return getEventiCalendario(0)" type="text" id="eventRicerca_stato" name="eventRicerca_stato" required>
            <option>1</option>
            <option>2</option>
            <option>3</option>
            <option value=" ">tutti</option>
        </select>
        <label for="eventRicerca_stato">Stato</label>
        <label class="col" for="eventRicerca_annullato">Annullato:
            <input class="form-check" style="margin:auto" onclick="return getEventiCalendario(0)" type="checkbox" id="eventRicerca_annullato" name="eventRicerca_annullato"></label>
    </div>

    <div class="row">
        <label class="col-sm-3" for="eventRicerca_arbitro">Arbitro
            <input class="form-check" style="margin:auto" onclick="return getEventiCalendario(0)" type="checkbox" id="eventRicerca_arbitro" name="eventRicerca_arbitro"></label>

        <label class="col-sm-3" for="eventRicerca_pubblico">Pubblico
            <input class="form-check" style="margin:auto" onclick="return getEventiCalendario(0)" type="checkbox" id="eventRicerca_pubblico" name="eventRicerca_pubblico"></label>

        <label class="col-sm-3" for="eventRicerca_RespSicurezza">RespSicurezza
            <input class="form-check" style="margin:auto" onclick="return getEventiCalendario(0)" type="checkbox" id="eventRicerca_RespSicurezza" name="eventRicerca_RespSicurezza"></label>
    </div>
    <div class="row">
        <button class="closeOverlayBtn col" id="clearOverlayBtnRicerca">Pulisci Campi</button>
    </div>
</div>