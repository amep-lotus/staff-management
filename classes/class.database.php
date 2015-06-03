<?php

/**
 * Description of class
 *
 * @author tcrc
 */
abstract class database {
    
    /**
     * 
     */
    abstract function select($table);
    
    function pr() {
        
    }
    
    abstract function insert();
    abstract function update();
    abstract function delete();
    
}

