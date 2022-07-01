<?php

/**********
* ERROR 
*/
abstract class Api {
    abstract function readData(string $filter);
}

class SimpleApi extends Api {
    function readData(string $filter) {
        $reseau->fetchData();
    }
}

class TokenAuthApi extends SimpleApi {
    public function readData(string $filter, $token) {
      $reseau->preAuthentication($token); // break LSP
      $reseau->fetchData();
    }
}

class Manager {
    function __construct(Api $api) {
        $api->readData(); 
    }
}

new Manager(new SimpleApi()) // ok
new Manager(new TokenAuthApi()) // Error: what is token?




/********
* OK
*/

class Price {
    function getPrice(): int { return 0; }
}
class PromoPrice extends Price {
    function getPrice(): int { return 1; }
}
///

class Transaction {
    public function buy(array $stock, float $tarif): object {
        return new Price($tarif);
    }
}

class StockTransaction extends Transaction {
    public function buy(iterable $stock, float $tarif): Price {
        return new Price($tarif);
    }
}

class SubStockTransaction extends StockTransaction {
    public function buy($stock, $tarif): PromoPrice {
        return new PromoPrice($tarif);
    }
}

// usage
$object = (new Transaction)->buy(['bottle'=>2], 10);
