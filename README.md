# thinkorm-bundle
[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Total Downloads][ico-downloads]][link-downloads]

Symfony Think Orm Bundle

## About
the ```thinkorm-bundle``` package allows you use think-orm in symfony.

## Installation

Require the ```ccwwwonebyone/thinkorm-bundle``` package in your ```composer.json``` and update your dependencies:
```sh
 $ composer require ccwwwonebyone/thinkorm-bundle
```

## Useage

edit ```config/bundles.php```
```php
return [
    //...
    OneThink\OrmBundle\OneThinkOrmBundle::class => ['all' => true],
]

```
## Configuration

move ```vendor/ccwwonebyone/thinkorm-bundle/config/packages/one_think_orm.yaml``` to ```config/packages/one_think_orm.yaml```

edit ```.env``` set database info
```env
DB_HOSTNAME=host
DB_USERNAME=username
DB_PASSWORD=password
DB_DATABASE=database
DEBUG=true
```
you can see [ThinkORM开发指南](https://www.kancloud.cn/manual/think-orm/1257998) to learn other configurations


## License

Released under the MIT License, see [LICENSE](LICENSE).

[ico-version]: https://img.shields.io/packagist/v/ccwwonebyone/thinkorm-bundle.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/ccwwonebyone/thinkorm-bundle/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/ccwwonebyone/thinkorm-bundle.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/ccwwonebyone/thinkorm-bundle.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/ccwwonebyone/thinkorm-bundle.svg?style=flat-square

[link-downloads]: https://packagist.org/packages/ccwwonebyone/thinkorm-bundle
[link-packagist]: https://packagist.org/packages/ccwwonebyone/thinkorm-bundle
