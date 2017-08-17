
# Multi cdn for assets for Craft CMS



## Installation

1) Go to the settings of the plugin and set the url(s) for the cdn path in the field "Environment Variable cdnUrl".
Use comma separated uri's' for multiple cdn's.

![plugin_settings](https://github.com/bolden-craft-plugins/cdn-assets-path/raw/master/cdnassetspath/resources/images/plugin.settings.png "e.g. http://cdn1.myassets.com,http://cdn2.myassets.com")


2) Make sure that the assets path is relative. The cdn path will be prepended at the front of the assets path.

![assets_settings](https://github.com/bolden-craft-plugins/cdn-assets-path/raw/master/cdnassetspath/resources/images/assets.settings.png "Assets settings")

3) Use in templates the twig filter "cdnUrl" for the media/assets url to get the cdn path(s).

![twig_filter](https://github.com/bolden-craft-plugins/cdn-assets-path/raw/master/cdnassetspath/resources/images/twig.cdnfilter.template.png "e.g. <img src='{% entry.image.url()|cndUrl %}' />")


