<div class="overlay" id="Eventioverlay">
  <div class="overlayContent" id="overlayContent">
    <div class="card">
            <button class="closeOverlayBtn" id="closeOverlayBtn">Chiudi</button>
            <h2>Inserisci i tuoi dati</h2>
            <div class="row">
                <input class="col" style="display:none" onkeyup="return ricercaSquadre(0)" type="text" id="squadreRicerca_id" placeholder="id">
                <input class="col" onkeyup="return ricercaSquadre(0)" type="text" id="squadreRicerca_nome" placeholder="nome">
            </div>
            <div class="row">
                <input class="col" onkeyup="return ricercaSquadre(0)" type="text" id="squadreRicerca_atleti" placeholder="atleti">
                <input class="col" onkeyup="return ricercaSquadre(0)" type="text" id="squadreRicerca_reps" placeholder="reps">
            </div>
            <div class="row">
                <input class="col" onkeyup="return ricercaSquadre(0)" type="text" id="squadreRicerca_fk_referente" placeholder="Referente">
                <input class="col" onkeyup="return ricercaSquadre(0)" type="text" id="squadreRicerca_fk_tariffaBase" placeholder="TariffaBase">
            </div>
            <div class="row">
                <input class="col" onkeyup="return ricercaSquadre(0)" type="text" id="squadreRicerca_fk_disciplina" placeholder="disciplina">    
            </div>
            <div class="row">
                <button class="closeOverlayBtn col" id="clearOverlayBtn">Pulisci Campi</button>
                <button class="closeOverlayBtn col" id="sendRicercaBtn">Ricerca</button>
            </div>
    </div>
  </div>
</div>