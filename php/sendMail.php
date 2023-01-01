<?php
function sendMail($to, $subject, $body){
    $url = 'https://smtpjs.com/v3/smtpjs.aspx?';
    $data = array(
        'SecureToken'=> "d24dc5d9-4bad-488c-b636-bc372c91e63a",
        'To'=> $to,
        'From'=> "chen3ho5yang12@gmail.com",
        'Subject'=> $subject,
        'Body'=> $body,
        'Action'=> "Send",
        'nocache'=> rand(100000, 999999)
    );
    $options = array(
        'http' => array(
            'header'  => "Content-type: application/json\r\n",
            'method'  => 'POST',
            'content' => json_encode($data)
        )
    );
    $context  = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    return $result;
}
?>
