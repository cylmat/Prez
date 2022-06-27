<?php

class CsvDataImporter
{
    private Database $db;

    public function import($csv_file)
    {
        $data = $this->read_file($csv_file);
        $this->send_to_database($data);
    }

    private function read_file($filename)
    {
        return file_get_contents($filename);
    }

    private function send_to_database($data)
    {
        $stmt = $this->db->prepare("INSERT $data INTO mydb");
        $stmt->execute();
    }
}

class SRP_DataImporter
{
    private FileLoader $loader;
    private Database $gateway;

    public function __construct(FileLoader $loader, Database $gateway)
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


/////////////////////////////////////////////// sample2
class EmailSender
{
  function checkBody($body) {
    // ...
  }
  
  public function send(Email $email) {
    $this->prepare($email);
  }
  
  function prepareHeader(Email $email) {
    // ...
  }
  
  function buildEmail() {
    
  }
  
  function getToken() {
    $this->generateToken()
  }
  
  function getAuthor($id) {
    // ...
  }
}




class SRP_EmailSender
{
  __construct(
    EmailBuilder,
    EmailValidator,
    EmailTokenGenerator,
  ) {
    // ...  
  }
  
  public function send(Email $email) {
    $email->getAuthor();
    $this->prepare($email);
  }
}
