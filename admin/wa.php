<?php
session_start();

$pesan = $_POST['pesan'];
$target    = $_POST['hp'];

$curl   = curl_init();
$token  = "NTeGvbllMA4KdnsKabjH"; //token lu
//nomer target gunakan 628
//gunakan koma " , " untuk multi nomer 6283xxxx,6281xxxxx

$data = [
    'phone' => $target,
    'type' => 'text',
    'delay' => 2, // delay 2 detik (optional)
    'delay_req' => 2, // delay 2 detik setiap request (optional)
    'text' => $pesan
];

curl_setopt($curl, CURLOPT_HTTPHEADER,
    array(
        "Authorization: $token",
    )
);
curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
curl_setopt($curl, CURLOPT_URL, "https://fonnte.com/api/send_message.php");
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
curl_exec($curl);
curl_close($curl);

$_SESSION['pesan'] = 'Berhasil mengirim notifikasi';

header('Location: notif.php');

?>