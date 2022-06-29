<?php

class Speaker {
    protected $conversation = [
      'make.it' => "You can do it",
      "success" => "Well done!"
    ];
  
    public function speak($key) {
        return $this->conversation[$key];
    }
}

class SpeakerUpdated {
     protected $conversation = [
      'make.it' => "You can do it",
      "success" => "Well done!"
    ];
    
    public function setConversation($key, $newValue) {
        $this->conversation[$key] = $newValue;
    }
  
    public function speak($key) {
        return $this->conversation[$key];
    }
}
