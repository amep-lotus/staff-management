<?php

/**
 *
 * @author tcrc
 */
interface test1 {
    
    function select();
    
    function insert();
    
    function update();
    
    function delete();
}

interface test2 {
    
    function pr();
}


interface test3 extends test1,test2 {
    
}

class test4 implements test3{
    function select() {
        
    }
    function insert() {
        
    }
    function update() {
        
    }
    function delete() {
        
    }
    function pr() {
        
    }
}