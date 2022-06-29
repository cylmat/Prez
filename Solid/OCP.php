<?php

class Speaker {
    private $conversation = [
      'make.it' => "You can do it",
      "success" => "Well done!"
    ];
  
    public function speak($key)
    {
        return $this->conversation[$key];
    }
}

