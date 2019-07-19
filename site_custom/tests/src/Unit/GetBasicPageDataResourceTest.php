<?php

namespace Drupal\Tests\site_custom\Unit\GetBasicPageDataResourceTest;

use Drupal\Core\Site\Settings;
use Drupal\Tests\UnitTestCase;
use Drupal\site_custom\Plugin\rest\resource\GetBasicPageDataResource;

/**
 * Simple test to ensure that asserts pass.
 *
 * @group site_custom
 */
class GetBasicPageDataResourceTest extends UnitTestCase {
/**
 * {@inheritdoc}
 */
  protected function setUp() {
    $this->getBasicPageData = $this->getMockBuilder('Drupal\site_custom\Plugin\rest\resource\GetBasicPageDataResource')
    ->disableOriginalConstructor()
    ->setMethods([
      'nodeLoad',
      'getSiteApiKey',
    ])
    ->getMock();
  }
  public function testNodeLoad(){
      $node_mock = $this->getMockBuilder('Drupal\node\Entity\Node')
      ->disableOriginalConstructor()
      ->setMethods(['getType', 'nid', 'hasField'])
      ->getMock();
      $node_mock->expects($this->any())
      ->method('hasField')
      ->willReturn(true);

      $node_mock->expects($this->once())
      ->method('getType')
      ->willReturn('landing_page');

      $node_mock->expects($this->any())
      ->method('nid')
      ->willReturn(1);

      $this->getBasicPageData->expects($this->once())
      ->method('nodeLoad')
      ->willReturn($node_mock);

      $this->getBasicPageData->expects($this->once())
      ->method('getSiteApiKey')
      ->willReturn('12345');
      $json_response = $this->getBasicPageData->get(array('12345'), array('1'));
      $this->assertInstanceOf('Drupal\rest\ResourceResponse', $json_response);
      $this->assertEquals($json_response->getStatusCode(), 200);
  }
}
