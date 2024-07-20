ClinicPrivè
===========

ClinicPrivè è un'applicazione progettata per la gestione delle cliniche mediche. Questa applicazione include funzionalità per la gestione degli appuntamenti, dei pazienti, della fatturazione e altro ancora.

Struttura del Database
----------------------

Nella cartella `src/database` sono presenti due file SQL:

1. clinicprive.sql: Contiene la struttura del database insieme a degli esempi di dati per poter provare l'applicazione.
2. clinicprive_struttura.sql: Contiene solo la struttura del database senza dati di esempio.

Installazione
-------------

Per provare l'applicazione, segui questi passaggi:

1. Imposta il Database:
   - Copia il codice presente in uno dei file `.sql` (clinicprive.sql o clinicprive_struttura.sql) nel tuo database in `localhost`.

2. Configura il Server Web:
   - Sposta l'intera cartella contenente il codice all'interno della directory `C:/xampp/htdocs`.

3. Accedi all'Applicazione:
   - Apri il tuo browser e digita nella barra degli indirizzi: `http://localhost/ClinicPrive/src/view/index.php`.

Credenziali di Accesso
----------------------

Puoi accedere all'applicazione utilizzando le seguenti credenziali:

Amministratore
- Numero Badge: A001
- Password: macchia01

Medico Primario
- Numero Badge: M001
- Password: pw_Antonio123!

Medico 
- Numero Badge: M002
- Password: pw_Maria456@

Operatore Caposala
- Numero Badge: O001
- Password: pw_Laura123!

Operatore
- Numero Badge: O002
- Password: pw_Marco456@

Receptionist
- Numero Badge: R001
- Password: p@ssw0rd1


Note
----

- Assicurati di avere XAMPP installato e in esecuzione sul tuo computer.
- Il database deve essere configurato correttamente in `localhost` affinché l'applicazione funzioni come previsto.
- Per ulteriori informazioni o assistenza, consulta la documentazione o contatta il supporto tecnico.
