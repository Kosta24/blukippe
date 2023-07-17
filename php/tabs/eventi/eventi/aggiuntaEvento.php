<?php

/*
<br>
<br>
aggiunta<br>
###casella per riferimento <br>
###Mettere un Calendario Per il giorno e un Menù a tendina per l'ora<br>
###un menù a tendina per le ore se no una casella per dire tutto il giorno<br>
###menù a tendina con le discipline<br>
###mettere un text in fondo per le note<br>
##fare 2 smart search per le enti<br>
##quando si è selezionata una squadra menù a tendina con squadre di quella ente<br>

###casella per arbitro<br>
###casella per pubblico<br>
###casella per resp sicurezza<br>


cose da fare
###aggiungere fk_attività
fare i controlli sulla data e sull'ora e sulla durata se tutto va bene restituire un messaggio ok altrimenti restituire l'errore corrispondente
fare cosa che tenta subito di aggiungere una copia dell'evento per la settimana successiva se è di riferimento
se squadra 2 è vuoto copiare squadra 1
fare tutti i controlli sui locali
controllare i locali che vengano occupati correttamente<br>
1 esclude tutto<br>
2 permette 7<br>
3 permette 5,6,7<br>
4 permette 5<br>
5 permette 3,4,7<br>
6 permette 3<br>
7 permette 2,3,5<br>

<br>
controllare Che non venga inserito un qualcosa in in dayOff<br>
###controllare solo gli eventi che hanno stato 1 cioè inseriti<br>
#Se l'evento che vogliamo inserire è di riferimento provare a duplicarlo subito<br>
###AGGIUNGERE UNA RISPOSTA DEGLI ERRORI SULL'AGGIUNTA<br>

--far si che solo se il tuo grado è >10 tu possa inserire eventi nel passato
alla fine impostare lo stato dell'evento solo l'evento duplicato va a stato 2,3,4 se c'è qualche problema con l'evento presente questo viene segnalato e l'veneto non è onserito

fare pulizia campi
*/
?>
<div class="overlay" id="Eventioverlay2">

  <div class="overlayContent-event" id="overlayContent2">
    <div class="card form-group">
            <button class="closeOverlayBtn" id="closeOverlayBtn2">Chiudi</button>
            <h2 id="add-return">Aggiungi Evento</h2>
            <!-- ########################################## -->
            <div class="row">
              <label class="col-md-2" for="event-repeatable">Riferimento?</label>
              <input class="col-md-2 form-check" type="checkbox" id="event-repeatable" name="event-repeatable" checked>
            </div>
            <!-- ########################################## -->
            <div class="row">
                <label class="col-md-2" for="event-date">Data evento:</label>
                <div class="col-md-2">
                    <input class="form-control" type="date" id="event-date" name="event-date">
                    <div class="invalid-feedback">
                    Selezionare una Data.
                  </div>
              </div>
                <label class="col-md-1" for="event-hour">Ora evento:</label>
                <div class="col-md-1">
                    <select class="form-control " type="date" id="event-hour" name="event-hour"></select>
                    <div class="invalid-feedback">
                    Selezionare un Ora.
                  </div>
                </div>
                <label class="col-md-2" for="oreOccupazione">Ore di occupazione:</label>
                <div class="col-md-2">
                    <select class="form-select" style="margin:auto" id="oreOccupazione" name="oreOccupazione">
                          <option value="0.5">30Min</option>
                          <option value="1"  >1.0H</option>
                          <option value="1.5">1.5H</option>
                          <option value="2"  >2.0H</option>
                          <option value="2.5">2.5H</option>
                          <option value="3"  >3.0H</option>
                          <option value="3.5">3.5H</option>
                          <option value="4"  >4.0H</option>
                          <option value="4.5">4.5H</option>
                          <option value="5"  >5.0H</option>
                          <option value="5.5">5.5H</option>
                          <option value="6"  >6.0H</option>
                          <option value="6.5">6.5H</option>                
                  </select>
                </div>
                <label class="col-sm-2" style="margin-top:-10px" for="full-day">Tutto il giorno
                <input class="col-sm-2 form-check" style="margin:auto" type="checkbox" id="full-day" name="full-day"></label>            
            </div>
            <!-- ########################################## -->
            <br>
            <div class="row">
                <label class="col-md-2" for="event-locali">Locale:</label>
                  <div class="col-md-2">
                  <select class="form-select" style="margin:auto" id="event-locali" name="event-locali"></select>
                </div>
                <label class="col-md-2" for="event-discipline">Disciplina:</label>
                <div class="col-md-2">
                  <select class="form-select" style="margin:auto" id="event-discipline" name="event-discipline"></select>
                </div>
                <label class="col-md-2" for="event-attivita">Attività:</label>
                <div class="col-md-2">
                  <select class="form-select" style="margin:auto" id="event-attivita" name="event-attivita"></select>
                </div>
            </div>

            <!-- ########################################## -->
            <br>
            <div class="row d-flex justify-content-between">
                <label class="col-md-2" for="event-arbitro-check">Arbitro:
                <input class="col-sm-2 form-check" style="margin:auto" type="checkbox"  id="event-arbitro-check" name="event-arbitro-check"></label>
               

                <label class="col-md-2" for="event-pubblico-check">Pubblico:
                <input class="col-sm-2 form-check" style="margin:auto" type="checkbox"  id="event-pubblico-check" name="event-pubblico-check"></label>
                

                <label class="col-md-3" for="event-resp-sicurezza-check">Resp sicurezza:
                <input class="col-sm-2 form-check" style="margin:auto" type="checkbox"  id="event-resp-sicurezza-check" name="event-resp-sicurezza-check"></label>
                
            </div>
            <!-- ########################################## -->
            <br>
            <div class="row">
                <label class="col-md-2" for="ente1">Ente1:</label>
                <div class="col-md-3">
                    <input class="form-control" type="text" id="ente1" name="ente1">
                    <div class="smart-search-container  col text-center">
                      <ul class="list" id="items-list-Ente1"></ul>
                    </div>
                    <div class="invalid-feedback">
                    Selezionare un'ente.
                  </div>
              </div>
                <label class="col-md-2" for="squadra1-Select">Squadra1:</label>
                <div class="col-md-3">
                    <select class="form-control " type="date" id="squadra1-Select" name="squadra1-Select"></select>
                    <div class="invalid-feedback">
                    Selezionare una squadra.
                  </div>
                </div>
            </div>
            <!-- ########################################## -->
            <br>
            <div class="row">
                <label class="col-md-2" for="ente2">Ente2:</label>
                <div class="col-md-3">
                    <input class="form-control" type="text" id="ente2" name="ente2">
                    <div class="smart-search-container  col text-center">
                      <ul class="list" id="items-list-Ente2"></ul>
                    </div>
                    <div class="invalid-feedback">
                    Selezionare un'ente.
                  </div>
              </div>
                <label class="col-md-2" for="squadra2-Select">Squadra2:</label>
                <div class="col-md-3">
                    <select class="form-control " type="date" id="squadra2-Select" name="squadra2-Select"></select>
                    <div class="invalid-feedback">
                    Selezionare una squadra.
                  </div>
                </div>
            </div>
            <!-- ########################################## -->
            <br>
            <div class="row d-flex justify-content-center">
            <label>Note</label><br>
              <textarea  name="message" style="margin:5px;margin-bottom:10px;margin-top:10px" id="note-text-area" rows="3" cols="30"></textarea>
            </div>
            
            <div class="row">
                <button class="closeOverlayBtn col" id="clearOverlayBtn2">Pulisci Campi</button>
                <button class="closeOverlayBtn col" id="sendAggiungiBtn">Aggiungi</button>
            </div>
    </div>
  </div>
</div>
