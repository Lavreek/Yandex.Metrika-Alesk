<?php

namespace YandexMetrikaAlesk\src;

class FileCommander
{
    const default_header = "id,client_uniq_id,emails_md5,order_status,create_date_time\n";
    const default_dir = ROOT_PATH . "/files";

    public function __construct()
    {
        if (!is_dir(self::default_dir)) {
            mkdir(self::default_dir);
        }
    }

    public function makeFile(string $filename)
    {
        if (!file_exists(self::default_dir . "/" . $filename)) {
            file_put_contents(self::default_dir . "/" . $filename, self::default_header);
        }
    }
}