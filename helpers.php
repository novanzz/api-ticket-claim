<?php
//helper for dump or like breakpoint
function dd($data, $exit = true)
{
    if (empty($data) && $exit) {
        echo 'Data is empty';
    }

    if (is_object($data)) {
        echo '<pre>';
        var_dump($data);
        echo '</pre>';
    } elseif (is_array($data)) {
        echo '<pre>';
        print_r($data);
        echo '</pre>';
    } else {
        echo $data;
    }
    if ($exit) {
        exit();
    }
}

function response($code_status, $data, $err_msg = null)
{
    http_response_code($code_status);
    if ($code_status != 200) {
        echo json_encode(
            [
                "code" => $code_status,
                "message" => $err_msg
            ]
        );
        exit();
    }
    echo json_encode($data);
    exit();
}

function validasi_params($params)
{
    foreach ($params as $key => $val) {
        $params[$key] = htmlspecialchars($val, ENT_QUOTES, 'UTF-8');
    }
    return $params;
}
