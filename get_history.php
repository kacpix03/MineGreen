<?php
$filename = 'historia.json';
if (file_exists($filename)) {
    echo file_get_contents($filename);
} else {
    echo '[]';
}
?>
