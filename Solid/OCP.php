<?php


$importer = new DataImporter(new CsvFileLoader(), new MySQLGateway());
$importer = new DataImporter(new XmlFileLoader(), new MongoGateway());
$importer = new DataImporter(new JsonFileLoader(), new ElasticSearchGateway());
