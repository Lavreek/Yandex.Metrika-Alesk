<?php

namespace YandexMetrikaAlesk\src;

class FileCommander
{
    const default_header = "id,client_uniq_id,emails_md5,phones_md5,order_status,create_date_time\n";
    const default_dirs = ['default' => ROOT_PATH . "/files", 'generated' => ROOT_PATH . "/before"];

    private string $filename;

    public function __construct()
    {
        foreach (self::default_dirs as $dir) {
            if (!is_dir($dir)) {
                mkdir($dir);
            }
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
            $filepath = self::default_dirs['default'] . "/" . $this->filename;
            if (!file_exists($filepath)) {
                file_put_contents($filepath, self::default_header);
            }
        } else {
            throw new \Exception("\n Filename is undefined. Use function `setFilename` to set filename. \n");
        }
    }

    public function pushData(array $data) : void
    {
        $filepath = self::default_dirs['default'] . "/" . $this->filename;

        if (!file_exists($filepath)) {
            throw new \Exception("\n File is undefined. \n");
        }

        file_put_contents(self::default_dirs['default'] . "/" . $this->filename, implode(",", $data) . "\n", FILE_APPEND);
    }

    public function emptyDefaultDirectory() : void
    {
        $files = array_diff(scandir(self::default_dirs['default']), ['..', '.']);

        if (count($files) > 0) {
            foreach ($files as $file) {
                $date = date("H-i-s-d-m-Y", strtotime('-1 month'));
                rename(self::default_dirs['default'] . "/" . $file, self::default_dirs['generated'] . "/" . $date . "-" . $file);
            }
        }
    }
}