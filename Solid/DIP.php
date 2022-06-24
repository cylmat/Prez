<?php

class CsvFileLoader
{
}

class DataImporter
{
    private $loader;
    private $gateway;

    public function __construct(CsvFileLoader $csvFile, DataGateway $dataGateway)
    {
        
    }
}



/* after *******************************************************************/

interface CsvFileLoaderInterface
{
}

interface DataGatewayInterface
{
}

class DataImporter
{
    private $loader;
    private $gateway;

    public function __construct(CsvFileLoaderInterface $csvFile, DataGatewayInterface $dataGateway)
    {
        
    }
}
