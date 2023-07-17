<script src="js/squadre.js" type="text/javascript"></script>
<div class="button-wrapper">
  <div class="button-pages" onclick="return changeSubTab(2);" >Torna ad Enti</div>
</div>
Admin Squadre

<br>
AGGIUNGERE CHE LE SQUADRE DISATTTIVATE NON VENGONO MOSTRARE
<br>

<div class="overlay" id="Squadreoverlay">
  <div class="overlayContent" id="overlayContent">
    <div class="card">
            <button class="closeOverlayBtn" id="closeOverlayBtn">Chiudi</button>
            <h2>Ricerca Squadra</h2>
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

<div class="overlay" id="Squadreoverlay2">
  <div class="overlayContent" id="overlayContent2">
    <div class="card">
            <button class="closeOverlayBtn" id="closeOverlayBtn2">Chiudi</button>
            <h2>Aggiungi Squadra</h2>
            <div class="row">
                <input class="col" type="text" id="squadreAggiungi_nome" placeholder="nome">
                <input class="col" type="text" id="squadreAggiungi_atleti" placeholder="atleti">
            </div>
            <div class="row">
                <input class="col" type="text" id="squadreAggiungi_reps" placeholder="reps">
                <input class="col" type="text" id="squadreAggiungi_fk_referente" placeholder="referente">
            </div>
            <div class="row">
                <input class="col" type="text" id="squadreAggiungi_fk_tariffaBase" placeholder="tariffaBase">
                <input class="col" type="text" id="squadreAggiungi_fk_disciplina" placeholder="Disciplina">
            </div>
            <div class="row">
                <button class="closeOverlayBtn col" id="clearOverlayBtn2">Pulisci Campi</button>
                <button class="closeOverlayBtn col" id="sendAggiungiBtn">Aggiungi</button>
            </div>
    </div>
  </div>
</div>



<div class="Datatable_container">

<table class="Datatable_table" id='table_squadre'>
    <div class="dataTables_wrapper" style="margin-bottom:5px;">
        <div class="dataTables_filter">

            <button id="showOverlayButton2" class="btn btn-secondary">
                <span style="font-size: 16px;">
                    <i class="fas fa-plus"></i>
                </span>
                Aggiungi
            </button>

            <button id="showOverlayButton" class="btn btn-primary">
                <span style="font-size: 16px;">
                    <i class="fas fa-search"></i>
                </span>
                Approfondita
            </button>
        </div>

    </div>
    <thead>
        <tr>
            <th>Nome</th>
            <th>Id</th>
            <th>Atleti</th>
            <th>Referente</th>
            <th>Tariffa Base</th>
            <th>Disciplina</th>
            <th>Squadra</th>
        </tr>
     
    </thead>
    <tbody>
    </tbody>
    <tfoot>
    </tfoot>
</table>
</div>
<script>
    initDataTableSquadre(); //inizializza la table con le nostre informazioni
    loadTableSquadre();
</script>