<?php

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
        return new PromoPrice($tarif);
    }
}

class SubStockTransaction extends StockTransaction {
    public function buy($stock, float $tarif): PromoPrice {
        return new Price($tarif);
    }
}
