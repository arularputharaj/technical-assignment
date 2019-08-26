<?php

namespace Drupal\site_api_key\Controller;

use Drupal\node\NodeInterface;
use Symfony\Component\HttpFoundation\JsonResponse;


class SiteApiKeyController{

    public function content($site_api_key, NodeInterface $node){
        // Site API Key configuration
        $site_api_key_saved = \Drupal::config('siteapikey.configuration')->get('siteapikey');

        if($node->getType() == 'page' && $site_api_key_saved != 'No API Key yet' && $site_api_key_saved == $site_api_key){

            // json representation of the node
            return new JsonResponse($node->toArray(), 200, ['Content-Type'=> 'application/json']);
        }

        // access denied
        return new JsonResponse(array("error" => "access denied"), 401, ['Content-Type'=> 'application/json']);
    }
}