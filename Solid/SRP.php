<?php

// https://afsy.fr/avent/2013/02-principes-stupid-solid-poo

// BEFORE
class CsvDataImporter
{
    public function import($file)
    {
        $records = $this->loadFile($file);

        $this->importData($records);
    }

    private function loadFile($file)
    {
        $records = array();
        if (false !== $handle = fopen($file, 'r')) {
            while ($record = fgetcsv($handle)) {
                $records[] = $record;
            }
        }
        fclose($handle);

        return $records;
    }

    private function importData(array $records)
    {
        try {
            $this->db->beginTransaction();
            foreach ($records as $record) {
                $stmt = $this->db->prepare('INSERT INTO ...');
                $stmt->execute($record);
            }
            $this->db->commit();
        } catch (PDOException $e) {
            $this->db->rollback();
            throw $e;
        }
    }
}


////////////////////////////////////////////////////////////////////////////////////////////////
// SRP


<?php

class DataImporter
{
    private $loader;
    private $gateway;

    public function __construct(FileLoader $loader, Gateway $gateway)
    {
        $this->loader  = $loader;
        $this->gateway = $gateway;
    }
    public function import($file)
    {
        foreach ($this->loader->load($file) as $record) {
            $this->gateway->insert($record);
        }
    }
}

