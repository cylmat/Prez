<?php

/**********
* ERROR 
*/

interface Api {
    function readData(string $filter);
    function checkList();
}

class SimpleApi implements Api {
    function readData(string $filter) {
       $reseau->fetchRemote();
    }
    function checkList() {} // ...
}

class TokenAuthApi extends SimpleApi {
    public function readData(int $filterId) {
      if (!$reseau->preAuthentication($filter)) {
          throw new \Exception();
      }
      $reseau->fetchRemote();
    }
    
    public function checkList() {
        return null; // function not used
    }
}

class Client {
    function __construct(Api $api) {
        $api->readData('/url/'); 
        $list = $api->checkList();
        // other ... 
    }
}

new Client(new SimpleApi()); // ok

// On remplace SimpleApi par une classe dérivé TokenAuthApi
new Client(new TokenAuthApi()); 

// Err: on passe un string -> int attendu
// Exception non gérée
// Fonction désactivée, etc...



/********
* OK
*/

class Stock {
    function getStock(): int { /**/ return 1; }
}

class SubStock extends Stock {
    function getStock(): int { /**/ return 2; }
}

class Price {
    function getPrice(): int { return 10; }
}

class PromoPrice extends Price {
    function getPrice(): int { return 20; }
}

class Transaction {
    function buy(SubStock $stock): Price {
        $value = $stock->getStock();
        return new Price();
    }
}

class StockTransaction extends Transaction {
    function buy(Stock $stock): PromoPrice {
        return new PromoPrice();
    }
}

class Client {
    function run(Transaction $transaction) {
        $stock = new SubStock();
        $object = $transaction->buy($stock);
    }
}

(new Client)->run(new Transaction); // ok
(new Client)->run(new StockTransaction); // LSP ok








/******************
 * COVARIANT
 */
class Book {
    function getId() { //...
    }
}
class ChildBook extends Book {
    function getAge() {//...
    }
}

class Collection {
    function getBook($id): Book {
        return new Book('someone');
    }
}

class ChildBookCollection extends Collection {
    function getBook($id): ChildBook {
        return new ChildBook('disney');
    }
}

/// usage

class Manager {
    function saveAuthor(Collection $collection): void {
        $book = $collection->getBook(1);
        $book->getId();
        // saving...
    }
}

(new Manager())->saveAuthor(new Collection()); // ok
(new Manager())->saveAuthor(new ChildBookCollection()); // ok




/*********************
 * Contravariant
 */
$client->run(Manager $manager) {
    $manager->manage(“EAN135-abf”);
    $manager->manage(32);
}

// same
class ChildManager extends Manager {
    function manage(int|string $idOrEan) {
        $database->getProductByEan($idOrEan)
        $database->getProductById($idOrEan)
}

// fail
class OnlyEanManager extends Manager {
    function manage(string $ean) {
        $database->getProductByEan($idOrEan)
}

// pass
class LSPManager extends Manager {
    function manage(int|string|array $param) {
        $database->getProductByEan($param)
        $database->getProductByArray($param)
}

//////// object
    
$client->run(Manager $manager) {
    $manager->manage(new Param);
}

class ChildManager extends Manager {
    function manage(Param $param) {
        $database->getProductByParam($param->getParam())
        $database->getProductByArray($param->getInnerArr())
}

class SpecificManager extends Manager {
    function manage(SpecificParam $specific) {
        $database->getSpecialData($specific->getSpecific())
}
    
class LSPManager extends Manager {
    function manage(ArrayObject $param) {
        $database->getProductByArray($param->getInnerArr())
}
