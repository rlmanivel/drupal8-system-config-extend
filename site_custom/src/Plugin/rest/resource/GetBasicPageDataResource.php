<?php

namespace Drupal\site_custom\Plugin\rest\resource;

use Drupal\rest\Plugin\ResourceBase;
use Drupal\rest\ResourceResponse;
use Drupal\node\Entity\Node;


/**
 * Provides a Demo Resource
 *
 * @RestResource(
 *   id = "page_json",
 *   label = @Translation("Basic Page Resource"),
 *   uri_paths = {
 *     "canonical" = "/page_json/{site_apikey}/{nid}"
 *   }
 * )
 */
class GetBasicPageDataResource extends ResourceBase {

    /**
     * Responds to entity GET requests.
     * @return \Drupal\rest\ResourceResponse
     */
    public function get($site_apikey, $nid) {
      $response = ['message' => 'access denied'];
      $sys_apikey = $this->getSiteApiKey();;
      $node = $this->nodeLoad($nid);
      if($node && $node->getType() == 'page' && $sys_apikey === $site_apikey){
        $response = $node;
      }
      return new ResourceResponse($response);
    }

     /**
     * Method to load node using node id.
     *
     * @param int $nid
     *   Node id.
     *
     * @return Drupal\node\Entity\Node
     *   Node object if it's published.
     *
     * @codeCoverageIgnore
     */
    public function nodeLoad($nid){
      $node_load = Node::load($nid);
      if($node_load && $node_load->isPublished()){
        return $node_load;
      }
      return '';
    }
    
     /**
     * Method to load Site API Key from Site information config
     */
    public function getSiteApiKey(){
      return \Drupal::config('system.site')->get('siteapikey');
    }
  }