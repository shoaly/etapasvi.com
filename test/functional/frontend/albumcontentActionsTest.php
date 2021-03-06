<?php

include(dirname(__FILE__).'/../../bootstrap/functional.php');

$params = sfYaml::load(dirname(__FILE__).'/fixtures/fixtures.yml');

$browser = new sfTestFunctional(new sfBrowser());

$browser->
  setHttpHeader('Host', sfConfig::get('app_domain_name'))->
  get('/en/photo/albumcontent/' . $params['albumcontent_id'])->

  with('request')->begin()->
    isParameter('module', 'photo')->
    isParameter('action', 'albumcontent')->
  end()->

  with('response')->begin()->
    isStatusCode(200)->
// to show a photo
    matches('/id="photo_preview_info" value="([^"]+)"/')->
    matches('/photo_preview_info/')->
    matches('/photo_preview_info/')->
    matches('/id="photo_preview_info" value="/')->
    matches('/src="([^"]+)" class="full_photo_img"/')->
    matches('/src="([^"]+)" id="prev_photo_preview"/')->
    matches('/id="photo_full_info" value="([^"]+)"/')->
    matches('/photo_full_info/')->
    matches('/id="photo_full_info" value="/')->
  end()
;
