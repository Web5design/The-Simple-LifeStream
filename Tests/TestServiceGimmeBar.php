<?php
/**
 * GimmeBar.php
 *
 * @author  Michael Pratt <pratt@hablarmierda.net>
 * @link    http://www.michael-pratt.com/
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

class GimmeBar extends TestService
{
    protected $validTypes = array(
        'bookmarked',
    );

    public function testRealRequest()
    {
        $stream = $this->getStream('GimmeBar', 'funkatron');
        $response = $stream->getResponse();

        $this->checkResponseIntegrity('GimmeBar', $response);

        $errors = $stream->getErrors();
        $this->assertTrue(empty($errors));
    }

    public function testFeedRequestFail()
    {
        $stream = $this->getStream('GimmeBar', 'unknown-or-invalid-gimmebar-user---');
        $stream->getResponse();

        $errors = $stream->getErrors();
        $this->assertTrue(!empty($errors));
    }

    public function testService()
    {
        $stream = $this->getStream('GimmeBar', 'dummySample1', 'funkatron-2013-10-17.json');
        $response = $stream->getResponse();

        $this->checkResponseIntegrity('GimmeBar', $response);

        $this->assertEquals(10, count($response));

        $errors = $stream->getErrors();
        $this->assertTrue(empty($errors));
    }

    public function testService2()
    {
        $stream = $this->getStream('GimmeBar', 'dummySample2', 'colly-2013-10-17.json');
        $response = $stream->getResponse();

        $this->checkResponseIntegrity('GimmeBar', $response);

        $this->assertEquals(10, count($response));

        $errors = $stream->getErrors();
        $this->assertTrue(empty($errors));
    }

    public function testServiceInvalidAnswer()
    {
        $stream = $this->getStream('GimmeBar', 'dummyInvalidResourceNotJson', 'this is not a json response');
        $stream->getResponse();

        $errors = $stream->getErrors();
        $this->assertTrue(!empty($errors));
    }
}
?>
