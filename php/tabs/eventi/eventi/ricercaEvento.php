<div id="filtri-calendar">
  <h2>Filtri: </h2>
  <div class="row">
    <input class="col" type="text" id="eventRicerca_disciplina" placeholder="Disciplina">
  </div>
  <div class="row">
    <input class="col" type="text" id="eventRicerca_attivita" placeholder="Attivita">
  </div>
  <div class="row">
    <input class="col" type="text" id="eventRicerca_locale" placeholder="Locale">
  </div>
  <div class="row">
    <select class="col" id="eventRicerca_ente" placeholder="ente">
      <option>Ente</option>
      <option>Ente1</option>
      <option>Ente2</option>
    </select>
  </div>
  <div class="row">
    <select class="col" id="eventRicerca_stato" placeholder="stato">
      <option>stato</option>
      <option>1</option>
      <option>2</option>
    </select>
    <label class="col" for="eventRicerca_annullato">Annullato:
      <input class="form-check" style="margin:auto" type="checkbox" id="eventRicerca_annullato"
        name="eventRicerca_annullato"></label>
  </div>

  <div class="row">
    <label class="col-sm-3" for="eventRicerca_annullato">Arbitro
      <input class="form-check" style="margin:auto" type="checkbox" id="eventRicerca_annullato"  name="eventRicerca_annullato"></label>

    <label class="col-sm-3" for="eventRicerca_pubblico">Pubblico
      <input class="form-check" style="margin:auto" type="checkbox" id="eventRicerca_pubblico" name="eventRicerca_pubblico"></label>

    <label class="col-sm-3" for="eventRicerca_RespSicurezza">RespSicurezza
      <input class="form-check" style="margin:auto" type="checkbox" id="eventRicerca_RespSicurezza"name="eventRicerca_RespSicurezza"></label>
  </div>
  <div class="row">
    <button class="closeOverlayBtn col" id="clearOverlayBtn">Pulisci Campi</button>
  </div>
</div>