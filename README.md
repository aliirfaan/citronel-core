# Citronel core

Boilerplate to start laravel API project.

## Features
* Base configuration.
* Base controller.
* Helper service.
* Traits.

## Requirements

* [Composer](https://getcomposer.org/)
* [Laravel](http://laravel.com/)
* aliirfaan/laravel-simple-api

## Installation

* Install the package using composer:

```bash
 $ composer require aliirfaan/citronel-core
```
* Publish files with:

```bash
 $ php artisan vendor:publish --provider="aliirfaan\CitronelCore\CitronelCoreProvider"
```

or by using only `php artisan vendor:publish` and select the `aliirfaan\CitronelCore\CitronelCoreProvider` from the outputted list.


## Configurations
* citronel
Base configuration

* citronel-cahce
Base cache configuration

## Traits
* CitronelApiControllerTrait  
Use this trait to send API responses with headers.

* CitronelCacheTrait  
Use this trait to cache responses.

* CitronelCorrelationTokenTrait  
Use this trait to work with correlation token.

* CitronelDateTimeTrait  
Use this trait to work with date time.

* CitronelMoneyTrait  
Use this trait to work money/amounts.

* resultFormatTrait  
Use this trait to get return format for function calls.

## Controllers
* CitronelController  
Base controller.

## Middleware
* CitronelCorrelationToken  
Get correlation token in header based on a configurable header key.

## Services
* CitronelHelperService  
Base helper service.

## Usage

## License

This software is proprietary and confidential. All rights reserved.

Unauthorized copying, modification, distribution, or use of this software, via any medium, is strictly prohibited. The software is provided "as is", without warranty of any kind, express or implied, including but not limited to the warranties of merchantability, fitness for a particular purpose, and noninfringement. In no event shall the authors or copyright holders be liable for any claim, damages, or other liability, whether in an action of contract, tort, or otherwise, arising from, out of, or in connection with the software or the use or other dealings in the software.