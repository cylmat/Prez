<?php

class Transaction{
    public void buy(String stock, int quantity, float price) {
        // ...
    };
}

class StockTransaction extends Transaction {
    public void buy(String stock, int quantity, float price) {
        // ...
    }
}
