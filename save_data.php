<?php
// Get the JSON POST body
$json = file_get_contents('php://input');
$obj = json_decode($json);
echo $json;
// Security check: Ensure filename and data exist
if (isset($obj->file_name) && isset($obj->exp_data)) {
    $file_name = $obj->file_name;
    $data = $obj->exp_data;

    // FILE_APPEND ensures we don't overwrite previous participants
    // LOCK_EX prevents two people from writing at the exact same microsecond
    if (file_put_contents($file_name, $data, FILE_APPEND | LOCK_EX)) {
        echo "Data successfully saved to " . $file_name;
    } else {
        echo "Error: Could not write to file.";
    }
} else {
    echo "Error: No data received.";
}
?>