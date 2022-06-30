<?php

class Price {
    function getPrice(): int { return 0; }
}
class PromoPrice extends Price {
    function getPrice(): int { return 1; }
}

class Transaction {
    public function buy(string $stock, int $tarif): Price {
        return new Price($tarif);
    }
}

class StockTransaction extends Transaction {
    public function buy(string $stock, int $tarif): PromoPrice {
        return new PromoPrice($tarif);
    }
}

class SubStockTransaction extends StockTransaction {
    public function buy(string $stock, int $tarif): PromoPrice {
        return new Price($tarif);
    }
}
