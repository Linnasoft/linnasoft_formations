{{-- Functions --}}
@php


if (!function_exists('setTitle')) :
    function setTitle($page_title) {

        // echo $page_name;

        $admin_name = ' &bull; '.config('app.name');

        if ($page_title != '') :
            echo $page_title.$admin_name;
        else :
            echo config('app.name');
        endif;
    }
endif;


// Function to get the client IP address
function get_client_ip() {
    $ipaddress = '';
    if (isset($_SERVER['HTTP_CLIENT_IP']))
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_X_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if(isset($_SERVER['REMOTE_ADDR']))
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}

function scrollspy($offset) {
    echo 'data-target="#navSection" data-spy="scroll" data-offset="'. $offset . '"';
}

function getURL() {

$req_uri = $_SERVER['REQUEST_URI'];
$path = substr($req_uri,0,strrpos($req_uri,'horizontal-light-menu'));

echo $path . "horizontal-light-menu";

}

@endphp