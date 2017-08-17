<?php

namespace Craft;

use Twig_Extension;
use Twig_Filter_Method;

class CdnAssetsPathTwigExtension extends Twig_Extension
{
    
    public function getName()
    {
        return 'Filter Environment Cdn Path';
    }

    public function getFilters()
    {
        return array(
            'cdnUrl' => new Twig_Filter_Method($this, 'cdnUrl', array('is_safe' => array('html'))),
        );
    }

    public function cdnUrl($string)
    {
        $cdnUrlString = craft()->plugins->getPlugin('cdnassetspath')->getSettings()['cdnUrl'];
        $cdnUrlUrls = explode(',', $cdnUrlString);
        if(count($cdnUrlUrls) > 1){
            $randKey = array_rand($cdnUrlUrls, 1);
            $replacement = $cdnUrlUrls[$randKey];
        } elseif(count($cdnUrlUrls) == 1){
            $replacement = $cdnUrlUrls[0];
        } else {
            $replacement = '';
        }
        
        // check if he have an image transform request
        $url = craft()->config->parseEnvironmentString($string);
        if(!filter_var($url, FILTER_VALIDATE_URL)){
            $url = $replacement . $url;
        }
    }

}
