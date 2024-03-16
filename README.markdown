PicoFeed
========

PicoFeed was originally developed for [Miniflux](http://miniflux.net), a minimalist and open source news reader.

![Packagist Version](https://img.shields.io/packagist/v/p3k/picofeed)
![GitHub Workflow Status](https://img.shields.io/github/actions/workflow/status/aaronpk/picofeed/php.yml?branch=main)
![Packagist PHP Version Support](https://img.shields.io/packagist/php-v/p3k/picofeed)

This fork of PicoFeed was created after the original author dropped support. It is published on Packagist as `p3k/picofeed`.

```
composer require p3k/picofeed
```

Features
--------

- Simple and fast
- Feed parser for Atom 1.0 and RSS 0.91, 0.92, 1.0 and 2.0
- Feed writer for Atom 1.0 and RSS 2.0
- Favicon fetcher
- Import/Export OPML subscriptions
- Content filter: HTML cleanup, remove pixel trackers and Ads
- Multiple HTTP client adapters: cURL or Stream Context
- Proxy support
- Content grabber: download from the original website the full content
- Enclosure detection
- RTL languages support
- License: MIT

Requirements
------------

- PHP >= 5.6
- libxml >= 2.7
- XML PHP extensions: DOM and SimpleXML
- cURL or Stream Context (`allow_url_fopen=On`)
- iconv extension

Authors
-------

- Original author: Frédéric Guillot
- Major Contributors:
    - [Bernhard Posselt](https://github.com/Raydiation)
    - [David Pennington](https://github.com/Xeoncross)
    - [Mathias Kresin](https://github.com/mkresin)

Real world usage
----------------

- [Miniflux](http://miniflux.net)
- [Owncloud News](https://github.com/owncloud/news)
- [XRay](https://github.com/aaronpk/xray)
- [Aperture](https://aperture.p3k.io)

Documentation
-------------

- [Installation](docs/installation.markdown)
- [Running unit tests](docs/tests.markdown)
- [Feed parsing](docs/feed-parsing.markdown)
- [Feed creation](docs/feed-creation.markdown)
- [Favicon fetcher](docs/favicon.markdown)
- [OPML](docs/opml.markdown)
- [Image proxy](docs/image-proxy.markdown) (avoid SSL mixed content warnings)
- [Web scraping](docs/grabber.markdown)
- [Exceptions](docs/exceptions.markdown)
- [Debugging](docs/debugging.markdown)
- [Configuration](docs/config.markdown)
