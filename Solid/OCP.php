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

class SpeakerUpdated extends Speaker {
    public function setConversation($key, $newValue) {
        $this->conversation[$key] = $newValue;
    }
  
    public function newSpeaker($key) {
        return $this->conversation[$key];
    }
}





/////////////// plugin system
interface Operation {
    function operate($data): int;
}

final class Payment {
    function __construct(Operation $op) 
        //...
        
    public calculate(array $data): int {
        return $op->operate($data);
    }
}

class EmployeeOperation implements Operation {
    function operate($data) //...
}

class ManagerOperation implements Operation {
    function operate($data) //...
}


