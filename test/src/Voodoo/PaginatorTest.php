<?php

namespace Voodoo;

require_once dirname(__FILE__) . '/../../../src/Voodoo/Paginator.php';

/**
 * Test class for Paginator.
 * Generated by PHPUnit on 2013-06-20 at 06:14:53.
 */
class PaginatorTest extends \PHPUnit_Framework_TestCase {

    /**
     * @var Paginator
     */
    protected $paginator1;
    
    protected $url = "http://mysite.com";
    protected $pattern1 = "page=(:num)";
    protected $pattern2 = "/page/(:num)";

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp() {
        $this->paginator1 = (new Paginator)
                            ->setUrl($this->url, $this->pattern1);
    }

    public function testGetPage()
    {
        $this->paginator1->setItems(100, 10)->setPage(8);
        $this->assertEquals(8, $this->paginator1->getPage());
    } 
    
    public function testCount()
    {
        $this->paginator1->setItems(190, 10);
        $this->assertEquals(19, $this->paginator1->count());
    }

    public function testGetPerPage()
    {
        $this->paginator1->setItems(250, 15);
        $this->assertEquals(15, $this->paginator1->getPerPage());
    }  
    
    public function testGetStart()
    {
        $this->paginator1->setItems(100, 10)->setPage(4);
        $this->assertEquals(30, $this->paginator1->getStart());
    }  

    public function testGetEnd()
    {
        $this->paginator1->setItems(100, 10)->setPage(4);
        $this->assertEquals(39, $this->paginator1->getEnd());
    } 
    
    public function testGetPageUrl()
    {
        $this->paginator1->setItems(100, 10)->setPage(4);
        $this->assertEquals(1, preg_match("/page=4/", $this->paginator1->getPageUrl()));
    }     
    
    public function testGetPagePrevUrl()
    {
        $this->paginator1->setItems(100, 10)->setPage(3);
        $this->assertEquals(1, preg_match("/page=2/", $this->paginator1->getPrevPageUrl()));
    }    
    
    public function testGetPageNextUrl()
    {
        $this->paginator1->setItems(100, 10)->setPage(7);
        $this->assertEquals(1, preg_match("/page=8/", $this->paginator1->getNextPageUrl()));
    }
    
    public function testGetPageUrlOutOfRange()
    {
        $this->paginator1->setItems(100, 10)->setPage(15);
        $this->assertEquals("", $this->paginator1->getPageUrl());
        $this->assertEquals("", $this->paginator1->getPrevPageUrl());
        $this->assertEquals("", $this->paginator1->getNextPageUrl());
    }    
    
    
    public function testToArray()
    {
       $this->paginator1->setItems(100, 10); 
       $data = $this->paginator1->toArray()[3];
       $this->assertEquals(4, $data["page_number"]);
    }
    
    public function testToArrayIsCurrent()
    {
       $this->paginator1->setItems(100, 10)->setPage(7); 
       $data = $this->paginator1->toArray()[6];
       $this->assertTrue($data["is_current"]);
    }   
    
    public function testToArrayIsFirst()
    {
       $this->paginator1->setItems(150, 10)->setPage(11); 
       $data = $this->paginator1->toArray()[0];
       $this->assertTrue($data["is_first"]);
    }   
    
    public function testToArrayIsPrev()
    {
       $this->paginator1->setItems(150, 10)->setPage(11); 
       $data = $this->paginator1->toArray()[1];
       $this->assertTrue($data["is_prev"]);
    }
    
    public function testToArrayIsNext()
    {
       $this->paginator1->setItems(150, 10)->setPage(7); 
       $data = $this->paginator1->toArray()[10];
       $this->assertTrue($data["is_next"]);
    }   
    
    public function testToArrayIsLast()
    {
       $this->paginator1->setItems(150, 10)->setPage(7); 
       $data = $this->paginator1->toArray()[11];
       $this->assertTrue($data["is_last"]);
    }
    
}