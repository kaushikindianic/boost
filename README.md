BOOST
=====

Docs pending

## Populator

Populate an object from an array:

```php
$populator = new \Boost\Populator();
$obj = new Person();
$populator->populate($obj, ['firstname' => 'joe']);
print_r($obj);
```

## Serializer

Please refer to `examples/` for examples.

## Accessors

Please refer to `examples/` for examples.

## License

MIT (see [LICENSE.md](LICENSE.md))

## Brought to you by the LinkORB Engineering team

<img src="http://www.linkorb.com/d/meta/tier1/images/linkorbengineering-logo.png" width="200px" /><br />
Check out our other projects at [linkorb.com/engineering](http://www.linkorb.com/engineering).

Btw, we're hiring!
