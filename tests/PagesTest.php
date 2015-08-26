<?php
class PagesTest extends \PHPUnit_Framework_TestCase
{
    function testHomePage()
    {
        $response_code = $this->crawl('http://localhost/');
        $this->assertEquals(200, $response_code);
    }

    function testLoginPage()
    {
        $response_code = $this->crawl('http://localhost/login');
        $this->assertEquals(200, $response_code);
    }

    function testPageNotFound()
    {
        $response_code = $this->crawl('http://localhost/asdf');
        $this->assertEquals(302, $response_code);
    }


    function crawl($url)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,
            true);
        curl_exec($ch);
        $response_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        return $response_code;
    }

}
