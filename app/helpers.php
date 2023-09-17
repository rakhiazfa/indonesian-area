<?php

if (!function_exists('read_csv')) {

    /**
     * @param string $file
     * 
     * @return array
     */
    function read_csv(string $file = ''): array
    {
        $stream = fopen($file, 'r');

        $data = [];

        while (($row = fgetcsv($stream)) !== false) {
            $data[] = $row;
        }

        fclose($stream);

        return $data;
    }
}
