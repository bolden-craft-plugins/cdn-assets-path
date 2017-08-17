<?php
namespace Craft;

class CdnAssetsPathPlugin extends BasePlugin
{

    public function getName()
    {
        return Craft::t('Cdn Assets Plugin');
    }

    public function getDescription()
    {
        return 'Replace environment variable for a cdn assets path your Twig variables.';
    }

    public function getDocumentationUrl()
    {
        return '';
    }

    public function getVersion()
    {
        return '1.0.0';
    }

    public function getSchemaVersion()
    {
        return '1.0.0';
    }

    public function getDeveloper()
    {
        return 'Bolden';
    }

    public function getDeveloperUrl()
    {
        return 'http://www.bolden.nl';
    }

    public function addTwigExtension()
    {
        Craft::import('plugins.cdnassetspath.twigextensions.CdnAssetsPathTwigExtension');
        return new CdnAssetsPathTwigExtension();
    }

    protected function defineSettings()
    {
        $defaultValue = rtrim(craft()->config->get('siteUrl'),"/");
        return array(
            'cdnUrl' => array(AttributeType::String, 'default' => $defaultValue),
        );
    }

    /**
     * @return mixed
     */
    public function getSettingsHtml()
    {
        $siteUrl = craft()->config->get('siteUrl');
        $settingValue = $this->getSettings()['cdnUrl'];
        $value = !empty($settingValue) ? $settingValue : $siteUrl;

        $textField = craft()->templates->renderMacro('_includes/forms', 'textfield', array(
            array(
                'label' => 'Environment Variable cdnUrl',
                'instructions' => 'Set the url(s) for the cdn path (use comma for multiple urls)',
                'placeholder' => 'http://cdn.mysite.com',
                'name' => 'cdnUrl',
                'value' => $value,
            )
        ));

        $documentation = '<h2>How to configure</h2>
                    Make sure that the assets path is relative as the cdn path(s) will be prepended at the front
                    <br>
                    <br>
                    <img src="' . UrlHelper::getResourceUrl('cdnassetspath/images/assets.settings.png') . '">
                    <br>
                    <br>
                    Use the twig filter "cdnUrl" for the media/assets url to get the cdn path(s)
                    <br>
                    <br>
                    <img src="' . UrlHelper::getResourceUrl('cdnassetspath/images/twig.cdnfilter.template.png') . '">
                ';

        return TemplateHelper::getRaw($textField . $documentation);
    }

}
