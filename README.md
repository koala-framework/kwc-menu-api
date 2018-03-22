# KwcMenuApi
Repository for implementing controller to provide menu- and component-data over api-controller

## Installation
### Basic code changes
* Add AppBundle to `AppKernel.php`

        public function registerBundles()
        {
            $bundles = array(
                ...
                new Kwc\MenuApiBundle\KwcMenuApiBundle()
            );
            ...
        }

* Add routing config to `routing.yml`

        kwcmenuapi:
            resource: "@KwcMenuApiBundle/Resources/config/routing.yml"
            prefix:   /
