# thinkorm-bundle
[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Total Downloads][ico-downloads]][link-downloads]

Symfony Think Orm Bundle

## About
the ```thinkorm-bundle``` package allows you use think-orm in symfony.

## Installation

Require the ccwwwonebyone/thinkorm-bundle package in your composer.json and update your dependencies:
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
