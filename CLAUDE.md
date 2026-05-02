# CLAUDE.md — Centro Diagnostico Latorre (CDL)

## Identità del Progetto

**Nome:** Centro Diagnostico Latorre (CDL)
**Tipo:** Sito vetrina istituzionale per poliambulatorio specialistico
**Lingua:** Italiano (tutto il contenuto è in italiano)
**Sede:** Via Pietro Colletta 2 – Rosarno (RC) 89025
**Telefono:** 0966 378308
**Email:** info@centrodiagnosticolatorre.it
**Orari:** Lunedì–Venerdì 08:30–12:30 e 15:30–19:00, Sabato 08:30–12:30
**WhatsApp:** wa.me/0966378308

---

## Scopo del Sito

**Questo è un sito vetrina.** Non è prevista una piattaforma di prenotazione online, login utente, area riservata o e-commerce. Il sito ha lo scopo di:
- Presentare il centro e i suoi servizi
- Trasmettere professionalità, modernità e fiducia
- Fornire le informazioni di contatto per prenotare telefonicamente o via WhatsApp
- Informare su specialità disponibili e domande frequenti

Non aggiungere mai funzionalità di prenotazione online, backend, autenticazione o database a meno che non sia esplicitamente richiesto dal proprietario.

---

## Servizi Offerti

### Diagnostica per Immagini (cuore dell'attività)
- **Radiologia Digitale** — apparecchiatura di ultima generazione. Esami disponibili: RX Torace, RX Colonna Vertebrale, RX Arti Superiori e Inferiori, RX Bacino e Articolazioni, RX Addome, RX Gamba, RX Braccio, RX Avambraccio, RX Colonna per Scoliosi.
- **MOC (Mineralometria Ossea Computerizzata)** — densitometria ossea
- **Ortopantografia** — radiografia panoramica dentale

### Specialistica Ambulatoriale (poliambulatorio)
- Cardiologia
- Reumatologia
- Endocrinologia
- Senologia
- Ortopedia
- Neurologia
- Dermatologia
- Medicina Estetica
- (e altre branche della medicina moderna)

### Punto chiave sul posizionamento
Il CDL si distingue per l'utilizzo di **macchinari di ultima generazione**. Questo aspetto va enfatizzato nei testi quando si parla di tecnologia e diagnostica. Non usare frasi generiche — preferire toni concreti e autorevoli.

---

## Stack Tecnologico

| Tecnologia | Dettaglio |
|------------|-----------|
| HTML5 | Tutte le pagine, `lang="it"` |
| CSS3 | File unico `style.css` con variabili CSS |
| JavaScript | Vanilla JS (no framework) |
| Font Awesome 6.0.0 | Icone (CDN cloudflare) |
| Google Fonts | Montserrat |
| ScrollReveal.js | Animazioni on-scroll (CDN unpkg) |
| Google Maps | Embed iframe con place ID |

**Nessun build tool.** Non c'è npm, webpack, vite, o qualunque bundler. Tutto è file statici puri. Non proporre mai di introdurre un build system a meno che non sia esplicitamente richiesto.

---

## Struttura dei File

```
cdlatorre/
├── index.html                    # Homepage — hero, servizi, statistiche, perché noi
├── chi-siamo.html                # Chi siamo — storia, missione, team, valori
├── contatti.html                 # Contatti — form, orari, mappa, WhatsApp
├── convenzioni.html              # NASCOSTA — file mantenuto ma non raggiungibile dal sito
├── faq.html                      # FAQ — domande frequenti in accordion
├── radiologia.html               # Radiologia Digitale — esami RX disponibili
├── moc.html                      # MOC — densitometria ossea
├── ecografia.html                # Ecografia
├── visite-specialistiche.html    # Visite Specialistiche
├── style.css                     # Unico foglio di stile globale
└── logo.png                      # Logo del centro
```

---

## Design System

### Colori (variabili CSS in `:root`)

```css
--primary-blue: #1F2A44   /* Blu scuro istituzionale — colore principale */
--accent-cyan: #009CDF    /* Ciano brillante — accenti, bottoni, CTA */
--white: #ffffff
--light-gray: #f8f9fa     /* Sfondi sezioni chiare */
--text-dark: #333333      /* Testo primario */
--text-light: #666666     /* Testo secondario */
```

**Colori aggiuntivi (inline nel CSS):**
- Footer background: `#151b2b`
- Footer testo: `#a0a8b8`
- WhatsApp: `#25d366`
- Success: `#27ae60`
- Warning: `#f39c12`
- Error: `#e74c3c`
- Gradiente accent: `linear-gradient(135deg, #009CDF, #0076b0)`

### Tipografia

- **Font:** Montserrat (Google Fonts), fallback sans-serif
- **Pesi usati:** 400, 500, 600, 700
- **Dimensioni:** h1 hero 3–3.6rem, h2 1.9–2.4rem, body 0.85–1rem
- **Line height:** 1.6 (body), 1.8 (paragrafi lunghi)

### Breakpoint Responsive

| Breakpoint | Comportamento |
|------------|---------------|
| max-width: 768px | Tablet — riduzioni font, flex column |
| max-width: 900px | Mobile — hamburger visibile, nav collassata |
| max-width: 1200px | Max-width container centrato |

---

## Struttura Navigazione

**Top Bar (fissa in alto):**
- Orari di apertura
- Telefono (con icona)
- Email (con link mailto)

**Header (sticky):**
- Logo a sinistra
- Menu navigazione: Home | Chi Siamo | Servizi (dropdown) | F.A.Q. | Contatti
- Bottone CTA: **Prenota Ora** (link a contatti.html)
- Hamburger menu (mobile, visibile sotto i 900px)

**Footer:**
- Colonna 1: Info CDL + tagline
- Colonna 2: Link rapidi
- Colonna 3: Contatti (indirizzo, tel, email, orari)
- Copyright in fondo

**Float button WhatsApp:** fisso in basso a destra su tutte le pagine.

---

## Componenti e Pattern Ricorrenti

### Section Header (usato in ogni sezione)
```html
<div class="section-header">
  <h2>Titolo Sezione</h2>
  <div class="section-divider"></div>
  <p class="section-subtitle">Sottotitolo descrittivo</p>
</div>
```

### Card dei Servizi (`.service-card`)
- Border-top ciano
- Hover: lift verticale
- Icona Font Awesome + titolo + descrizione

### CTA Section
- Sfondo blu scuro con pattern
- Testo centrato con due bottoni (primario + secondario bianco)

### Statistiche (`.stats-strip`)
- CSS Grid, numeri in ciano con contatore animato JS
- Sfondo sfumato

### FAQ Accordion
- Usa elementi nativi `<details>` / `<summary>` HTML5

### Cookie Banner
- Fisso in basso
- Persistenza via `localStorage`
- Nascosto con `setProperty('display','none','!important')`

---

## JavaScript — Funzionalità Principali

Tutto il JS è inline nelle pagine (nessun file `.js` separato).

| Funzione | Dove | Descrizione |
|----------|------|-------------|
| Hamburger toggle | Tutte le pagine | Apre/chiude menu mobile |
| Cookie banner | Tutte le pagine | Mostra/nasconde con localStorage |
| ScrollReveal init | Tutte le pagine | Animazioni on-scroll |
| Counter animation | index.html | Conta fino al numero delle statistiche |
| Form validation | contatti.html | Validazione client-side, success message |

---

## Regole di Sviluppo

### Cosa FARE
- Mantenere tutto in italiano, tono professionale ma accessibile
- Usare le variabili CSS esistenti per colori e non aggiungerne di nuove senza motivo
- Replicare esattamente la struttura di header/footer quando si aggiunge una pagina
- Usare Font Awesome per le icone (già caricato)
- Rispettare la gerarchia dei titoli (h1 → h2 → h3)
- Testare sempre su mobile (breakpoint 900px)
- Aggiungere ScrollReveal alle nuove sezioni per coerenza con il resto

### Cosa NON FARE
- Non aggiungere npm, build tool, o dipendenze esterne non necessarie
- Non creare file JavaScript separati — tutto il JS va inline nella pagina
- Non aggiungere funzionalità di prenotazione/backend/login
- Non cambiare il design system (colori, font, stile) senza richiesta esplicita
- Non usare emoji nel codice o nei testi del sito
- Non usare lorem ipsum — ogni placeholder deve essere contenuto realistico in italiano
- Non introdurre framework CSS (Bootstrap, Tailwind, ecc.)
- Non toccare il logo.png

### Qualità del Testo
- Tono: professionale, caldo, rassicurante — parla al paziente
- Evidenziare sempre la tecnologia avanzata e l'aggiornamento continuo
- Evitare tecnicismi eccessivi nelle descrizioni rivolte ai pazienti
- Per le specialità mediche usare sempre il nome corretto in italiano

---

## Informazioni Tecniche da Verificare Prima di Modificare

- **WhatsApp number nel HTML:** `0966378308` — presente in `contatti.html` e `chi-siamo.html`
- **Google Maps embed:** usa place ID di Via Pietro Colletta 4, Rosarno (RC)
- **Form contatti:** validazione solo client-side, nessun backend — il form mostra un messaggio di successo ma non invia dati realmente (da implementare se richiesto)
- **Staff medico:** i nomi nel codice (Dott. Mario Latorre, Dott.ssa Anna Russo, ecc.) sono placeholder — aggiornarli con il team reale quando disponibile

---

## Possibili Sviluppi Futuri (non ora)

Annotare qui le richieste future per non perderle:
- Pagina dedicata a ogni specialità medica
- Galleria macchinari/struttura
- Blog/news mediche
- Integrazione form con backend email (es. Formspree, Netlify Forms)
- Privacy Policy e Cookie Policy complete
- SEO meta tags completi su ogni pagina

---

## Lavoro in Sospeso — Feed Instagram (da completare nella prossima sessione)

### Obiettivo
Aggiungere una sezione "Seguici su Instagram" nella homepage (`index.html`) che mostri automaticamente gli ultimi post Instagram del centro. Il proprietario pubblica su Instagram dal telefono e il sito si aggiorna da solo entro 24h.

### Soluzione scelta
**Behold.so** (piano gratuito) — widget embed, nessun backend necessario.

### Cosa manca
Il proprietario deve:
1. Registrarsi su **behold.so**
2. Collegare l'account Instagram del centro
3. Copiare il codice embed generato da Behold (simile a questo):
   ```html
   <div id="behold-widget-XXXXXXX"></div>
   <script src="https://w.behold.so/widget.js" type="module"></script>
   ```
4. Incollare il codice nella chat — Claude lo integra nella homepage

### Dove inserire la sezione in `index.html`
Prima della sezione `<!-- MAPPA -->`, dopo la sezione `<!-- PERCHÉ SCEGLIERCI -->`.

### Stile da usare
- Titolo con `section-header` + `divider` come le altre sezioni
- Sfondo `var(--light-gray)` per alternare con la sezione precedente (bianca)
- Link al profilo Instagram con icona Font Awesome `fab fa-instagram`
- ScrollReveal sulla sezione come le altre
