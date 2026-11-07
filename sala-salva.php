<?php
/* ================================================================
   CDL – salvataggio dati della pagina sala d'attesa
   ----------------------------------------------------------------
   Riceve i dati dal pannello di modifica di sala.html (tasto E) e
   li scrive in sala-dati.json, nella stessa cartella.

   >>> UNICA COSA DA FARE: scegli un PIN e scrivilo qui sotto. <<<
   Lo stesso PIN ti verrà chiesto nel pannello di modifica.
   ================================================================ */

$PIN = '12345';

/* ---------------------------------------------------------------- */
$FILE   = __DIR__ . '/sala-dati.json';
$BACKUP = __DIR__ . '/sala-backup';     // ultime 20 versioni, per sicurezza
$MAXB   = 20;

date_default_timezone_set('Europe/Rome');
header('Content-Type: application/json; charset=utf-8');
header('Cache-Control: no-store');

function out($code, $arr) { http_response_code($code); echo json_encode($arr, JSON_UNESCAPED_UNICODE); exit; }

if ($_SERVER['REQUEST_METHOD'] === 'GET') out(200, ['ok' => true, 'pronto' => true, 'pin_impostato' => $PIN !== 'CAMBIA-QUESTO-PIN']);
if ($_SERVER['REQUEST_METHOD'] !== 'POST') out(405, ['ok' => false, 'errore' => 'Metodo non consentito']);
if ($PIN === 'CAMBIA-QUESTO-PIN') out(503, ['ok' => false, 'errore' => 'PIN non ancora impostato in sala-salva.php']);

$raw = file_get_contents('php://input', false, null, 0, 300000);
$req = json_decode($raw, true);
if (!is_array($req)) out(400, ['ok' => false, 'errore' => 'Richiesta non valida']);

if (!isset($req['pin']) || !hash_equals((string)$PIN, (string)$req['pin'])) { sleep(2); out(401, ['ok' => false, 'errore' => 'PIN errato']); }

$d = $req['dati'] ?? null;
if (!is_array($d) || !isset($d['specialisti']) || !is_array($d['specialisti'])) out(400, ['ok' => false, 'errore' => 'Dati non validi']);

// pulizia: solo testo semplice, niente HTML
array_walk_recursive($d, function (&$v) { if (is_string($v)) $v = trim(strip_tags($v)); });

$json = json_encode($d, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
if ($json === false || strlen($json) > 200000) out(400, ['ok' => false, 'errore' => 'Dati troppo grandi o non validi']);

// backup della versione precedente
if (is_file($FILE)) {
  if (!is_dir($BACKUP)) @mkdir($BACKUP, 0755);
  if (is_dir($BACKUP)) {
    @copy($FILE, $BACKUP . '/sala-dati-' . date('Ymd-His') . '.json');
    $old = glob($BACKUP . '/sala-dati-*.json'); sort($old);
    while (count($old) > $MAXB) @unlink(array_shift($old));
    if (!is_file($BACKUP . '/.htaccess')) @file_put_contents($BACKUP . '/.htaccess', "Require all denied\nDeny from all\n");
  }
}

// scrittura sicura: file temporaneo + rinomina
$tmp = $FILE . '.tmp';
if (@file_put_contents($tmp, $json, LOCK_EX) === false || !@rename($tmp, $FILE)) {
  @unlink($tmp);
  out(500, ['ok' => false, 'errore' => 'Impossibile scrivere sala-dati.json: controlla i permessi di scrittura della cartella']);
}
out(200, ['ok' => true, 'salvato' => date('d/m/Y H:i:s')]);
