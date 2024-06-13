<?php
require_once __DIR__ . '/vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

function getMongoClient()
{
  return new MongoDB\Client($_ENV['MDB_URI']);
}

function getMongoCollection($database, $collection)
{
  $client = getMongoClient();
  return $client->selectCollection($database, $collection);
}
