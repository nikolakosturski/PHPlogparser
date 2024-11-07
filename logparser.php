<?php
function parseInfoFromFile($file, $correct_lines, $headers) {
    if ($file) {
        while (($line = fgets($file)) !== false) {
            // remove everything starting with #, therefore only real requests
            if (substr($line, 0, 1) !== "#") {
                // save them to the array
                array_push($correct_lines, htmlentities($line));
            }
            // The opposite logic, let's capture anything that starts with # (headers)
            if (substr($line, 0, 1) == "#") {
                // save them to the array
                array_push($headers, $line);
                // initiate a new array that we will use later
                $results = array();
                // loop through the first array with all the #
                foreach ($headers as $value) {
                    // Search for "Field" in the array
                    if (strpos($value, 'Field') !== false) {
                        // save whatever found in the new results array
                        $results[] = $value;
                        // and stop the loop
                        break;
                    }
                }
                if (empty($results)) {
                    continue;
                } else {
                    // convert to string and save it to a new variable
                    $header_string = implode('<br />', $results);
                }
            }
        }
    }
    // Remove '#Fields: ' from the string
    $header_string = str_replace('#Fields: ', '',$header_string);

    // We now have all the headers with spaces between them, explode them into an array and use the space as delimiter. Now are header array is ready!
    $log_columns = explode(" ", $header_string);

    // Start dealing with the other array with the requests
    // Let's implode it with no spaces between
    $correct_lines = implode("", $correct_lines);
    // Let's explode it with a new line
    $correct_lines = explode("\n", $correct_lines);
    // Initiate the new array in which we will save the final result
    $parsed_log = array();
    // loop throug the parsed requests array
    foreach ($correct_lines as $row) {
        $row = trim($row); // Remove leading/trailing whitespace including newline characters
        if (!empty($row)) {
            // Do the rest of the processing as before
            $split_rows = explode(" ", $row);
            $line = array();
            $count = -1;
            foreach ($log_columns as $column) {
                $column = trim($column);
                $count++;
                $line[$column] = $split_rows[$count] ?? null;
            }
            // Push it to the new array
            array_push($parsed_log, $line);
        }
    }
    return[$parsed_log];
}
