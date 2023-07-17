<script src="js/enti.js" type="text/javascript"></script>
Admin Enti

<br>
AGGIUNGERE CHE LE ASSOCIAZIONI DISATTTIVATE NON VENGONO MOSTRARE
<br>

<div class="overlay" id="Entioverlay">
  <div class="overlayContent" id="overlayContent">
    <div class="card">
            <button class="closeOverlayBtn" id="closeOverlayBtn">Chiudi</button>
            <h2>Inserisci i tuoi dati</h2>
            <div class="row">
                <input class="col" onkeyup="return ricercaEnti(0)" type="text" id="entiRicerca_id" placeholder="id">
                <input class="col" onkeyup="return ricercaEnti(0)" type="text" id="entiRicerca_nome" placeholder="nome">
            </div>
            <div class="row">
                <input class="col" onkeyup="return ricercaEnti(0)" type="text" id="entiRicerca_pIva" placeholder="pIva">
                <input class="col" onkeyup="return ricercaEnti(0)" type="text" id="entiRicerca_codFisc" placeholder="codFisc">
            </div>
            <div class="row">
                <input class="col" onkeyup="return ricercaEnti(0)" type="text" id="entiRicerca_SDI" placeholder="SDI">
                <input class="col" onkeyup="return ricercaEnti(0)" type="text" id="entiRicerca_IBAN" placeholder="IBAN">
            </div>
            <div class="row">
                <input class="col" onkeyup="return ricercaEnti(0)" type="text" id="entiRicerca_telefono" placeholder="telefono">
                <input class="col" onkeyup="return ricercaEnti(0)" type="text" id="entiRicerca_cellulare" placeholder="cellulare">
            </div>
            <div class="row">
                <input class="col" onkeyup="return ricercaEnti(0)" type="text" id="entiRicerca_email" placeholder="pec">
                <input class="col" onkeyup="return ricercaEnti(0)" type="text" id="entiRicerca_pec" placeholder="pec">
            </div>
            <div class="row">
                <input class="col" onkeyup="return ricercaEnti(0)" type="text" id="entiRicerca_citta" placeholder="citta">
                <input class="col" onkeyup="return ricercaEnti(0)" type="text" id="entiRicerca_provincia" placeholder="provincia">
            </div>
            <div class="row">
                <input class="col" onkeyup="return ricercaEnti(0)" type="text" id="entiRicerca_via" placeholder="via">
                <input class="col" onkeyup="return ricercaEnti(0)" type="text" id="entiRicerca_ncivico" placeholder="ncivico">
            </div>
            <div class="row">
                <input class="col" onkeyup="return ricercaEnti(0)" type="text" id="entiRicerca_cap" placeholder="cap">
                <input class="col" onkeyup="return ricercaEnti(0)" type="text" id="entiRicerca_paese" placeholder="paese">
            </div>
            <div class="row">
                <select id="entiRicerca_fk_tipo" onchange="return ricercaEnti(0)">
                        <option value="">Tipo</option>
                        <option value="1">Scuola</option>
                        <option value="2">Ente comunale</option>
                        <option value="3">Ente fuori Padova</option>
                        <option value="4">Privato</option>
                </select>
                <select id="entiRicerca_fk_tipoPagamento" onchange="return ricercaEnti(0)">
                    <option value="">Tipo Pagamento</option>
                    <option value="1">Bonifico</option>
                    <option value="2">Pagamento Elettronico</option>
                    <option value="3">Carta di Credito</option>
                    <option value="4">PayPal</option>
                    <option value="5">Assegno</option>
                    <option value="6">Contanti</option>
                    <option value="7">Apple Pay</option>
                    <option value="8">Rimessa Bancaria</option>
                </select>
            </div>
            <div class="row">
                <button class="closeOverlayBtn col" id="clearOverlayBtn">Pulisci Campi</button>
                <button class="closeOverlayBtn col" id="sendRicercaBtn">Ricerca</button>
            </div>
    </div>
  </div>
</div>

    

<div class="Datatable_container">

    <table class="Datatable_table" id='table_enti'>
        <div class="dataTables_wrapper" style="margin-bottom:5px;">
            <div class="dataTables_filter">

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
                <th>SDI</th>
                <th>Città</th>
                <th>Provincia</th>
                <th>Telefono</th>
                <th>Cellulare</th>
                <th>Pec</th>
                <th>Email</th>
            </tr>
         
        </thead>
        <tbody>
        </tbody>
        <tfoot>
        </tfoot>
    </table>
</div>
<script>
    initDataTableEnti(); //inizializza la table con le nostre informazioni
    loadTableEnti();
</script>