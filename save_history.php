<?php
$filename = 'historia.json';

// Jeśli przychodzi dane JSON (pełna lista), nadpisz całość (np. po usunięciu)
if ($_SERVER['CONTENT_TYPE'] === 'application/json') {
    $json = file_get_contents("php://input");
    file_put_contents($filename, $json);
    echo "Zaktualizowano historię.";
    exit;
}

// Jeśli przychodzi nick i code przez POST – dodaj nowy wpis
if (isset($_POST['nick']) && isset($_POST['code'])) {
    $nick = $_POST['nick'];
    $code = $_POST['code'];
    $data = file_exists($filename) ? json_decode(file_get_contents($filename), true) : [];
    $data[] = ['nick' => $nick, 'code' => $code];
    file_put_contents($filename, json_encode($data, JSON_PRETTY_PRINT));
    echo "Dodano do historii.";
    exit;
}

// Jeśli pusty POST – traktuj jako reset historii
file_put_contents($filename, '[]');
echo "Wyczyszczono historię.";
?>
