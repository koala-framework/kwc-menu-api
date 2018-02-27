# NativeMenu
Repository for implementing controller to provide menu- and component-data for native-app

## Installation
### Basic code changes
* Add AppBundle to `AppKernel.php`

        public function registerBundles()
        {
            $bundles = array(
                ...
                new Kwf\KwcNativeMenuBundle\KwfKwcNativeMenuBundle()
            );
            ...
        }

* Add routing config to `routing.yml`

        kwcnativemenu:
            resource: "@KwfKwcNativeMenuBundle/Resources/config/routing.yml"
            prefix:   /
