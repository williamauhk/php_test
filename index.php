<?php
// Set the URL of the target server
$target_url =$_GET['url'] ;

// Check the request method
$request_method = $_SERVER['REQUEST_METHOD'];

// Check if the request is GET or POST
if ($request_method =='GET') {
    // If the request is GET, append the query string to the target URL
    $target_url .= '?' . http_build_query($_GET);
    $request_data = null;
} else if ($request_method == 'POST') {
    // If the request is POST, send the POST data to the target server
    $request_data = http_build_query($_POST);
}

// Set up the options for the request
$options = array(
    'http' => array(
        'method' => $request_method,
        'content' => $request_data
    )
);

// Send the request to the target server using file_get_contents()
$context = stream_context_create($options);
$response = file_get_contents($target_url, false, $context);

// Return the response to the client
echo $response;
