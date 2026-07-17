<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: text/plain");


if($_SERVER['REQUEST_METHOD'] !== 'POST')
{
    echo "Wrong Request Method";
    exit;
}


$message = $_POST['message'] ?? "";


if(empty($message))
{
    echo "No message received";
    exit;
}


// Add your OpenRouter API Key here
$apiKey = "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";

$data = [

    "model" => "openai/gpt-4o-mini",

    "messages" => [

        [
            "role" => "system",
            "content" => "You are AbleMind AI, an educational tutor. Always answer in 4-6 short points. Keep every answer under 100 words. Use simple English. Never write long paragraphs unless the user specifically asks for a detailed explanation."
        ],

        [
            "role" => "user",
            "content" => $message
        ]

    ],

    "max_tokens" => 120,

    "temperature" => 0.5

];


$ch = curl_init();


curl_setopt($ch, CURLOPT_URL,
"https://openrouter.ai/api/v1/chat/completions");


curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);


curl_setopt($ch, CURLOPT_POST, true);


curl_setopt($ch, CURLOPT_HTTPHEADER, [

    "Authorization: Bearer " . trim($apiKey),

    "Content-Type: application/json",

    "HTTP-Referer: http://localhost",

    "X-Title: AbleMind Connect"

]);



curl_setopt($ch, CURLOPT_POSTFIELDS,
json_encode($data));

curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);

$response = curl_exec($ch);


if($response === false)
{
    echo "Curl Error: " . curl_error($ch);
    exit;
}


if(curl_errno($ch))
{
    echo "Connection Error: ".curl_error($ch);
    exit;
}


curl_close($ch);


$result = json_decode($response,true);



// Check API error

if(isset($result['error']))
{
    echo "API Error: ".$result['error']['message'];
    exit;
}



// Check AI response

if(isset($result['choices'][0]['message']['content']))
{

echo $result['choices'][0]['message']['content'];

}

else
{

echo "AI response not received. Check API key and connection.";

}

// Decode response

$result = json_decode($response, true);


// Display only AI message

if(isset($result['choices'][0]['message']['content']))
{

    echo $result['choices'][0]['message']['content'];

}

else
{

    echo "No AI response received.";

}

?>