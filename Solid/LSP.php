<?php

/**********
* ERROR 
*/
abstract class Api {
    // no token needed
    abstract function readData(string $filter);
}

class SimpleApi extends Api {
    function readData(string $filter) {
        $reseau->fetchData();
    }
}

class TokenAuthApi extends SimpleApi
{
    public function readData(string $filter) {
      $token = $this->getAuthToken(); // add token dependency
      $reseau->preAuthentication($token); // break LSP

      $reseau->fetchData();
    }
    
    private function getAuthToken(string $tokenUrl) {
      return $reseau->getAuthToken();
    }
}

(new SimpleApi())->readData(); // OK
(new TokenAuthApi())->readData(); // Error: what is token?




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
