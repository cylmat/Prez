<?php

class Transaction{
    public function buy(string $stock, int $quantity): object {
        // ...
    }
}

class StockTransaction extends Transaction {
    public function buy(string $stock, int $quantity): void {
        // ...
    }
}
