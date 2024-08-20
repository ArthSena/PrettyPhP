<?php

/**
 * Generates a version 4 UUID (Universally Unique Identifier).
 *
 * A UUID is a 128-bit number used to uniquely identify information in computer systems.
 * This function generates a version 4 UUID using the random_bytes function.
 *
 * @param string|null $data  Optional. If provided, this data will be used to generate the UUID.
 *                           If not provided, random data will be generated using random_bytes.
 *                           The data should be 16 bytes long.
 *
 * @return string  A version 4 UUID in the format: xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx.
 */
function uuid_v4($data = null): string {
    // Generate 16 bytes (128 bits) of random data or use the data passed into the function.
    $data = $data ?? random_bytes(16);
    assert(strlen($data) == 16);

    // Set version to 0100
    $data[6] = chr(ord($data[6]) & 0x0f | 0x40);
    // Set bits 6-7 to 10
    $data[8] = chr(ord($data[8]) & 0x3f | 0x80);

    // Output the 36 character UUID.
    return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
}