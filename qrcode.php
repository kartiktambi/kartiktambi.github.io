<?php
$id = isset($_GET['id']) ? htmlspecialchars($_GET['id']) : '';
if($id) {
    $url = "https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=" . urlencode($id);
    echo $url;
} else {
    echo "ID parameter is missing.";
}
?>
