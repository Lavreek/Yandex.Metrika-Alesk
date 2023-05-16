<?php

namespace YandexMetrikaAlesk\src;

class FileCommander
{
    const default_header = "id,client_uniq_id,emails_md5,phones_md5,order_status,create_date_time\n";
    const default_dir = ROOT_PATH . "/files";

    private string $filename;

    public function __construct()
    {
        if (!is_dir(self::default_dir)) {
            mkdir(self::default_dir);
        }
    }

    public function setFilename(string $name) : void
    {
        $this->filename = $name;

        $this->makeFile();
    }

    public function makeFile() : void
    {
        if (!empty($this->filename)) {
            $filepath = self::default_dir . "/" . $this->filename;
            if (!file_exists($filepath)) {
                file_put_contents($filepath, self::default_header);
            }
        } else {
            throw new \Exception("\n Filename is undefined. Use function `setFilename` to set filename. \n");
        }
    }

    public function pushData(array $data) : void
    {
        $filepath = self::default_dir . "/" . $this->filename;

        if (!file_exists($filepath)) {
            throw new \Exception("\n File is undefined. \n");
        }

        file_put_contents(self::default_dir . "/" . $this->filename, implode(",", $data) . "\n", FILE_APPEND);
    }
}