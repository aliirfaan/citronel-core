# Change Log
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com) and this project adheres to [Semantic Versioning](https://semver.org).

## 2.3.7 - 2025-05-15

### Added

- Nothing

### Changed

- Nothing

### Deprecated

- Nothing

### Removed

- Nothing

### Fixed

- CitronelBaseModel cater for null time aware attributes

## 2.3.6 - 2025-05-15

### Added

- Nothing

### Changed

- Nothing

### Deprecated

- Nothing

### Removed

- Nothing

### Fixed

- CitronelBaseModel deleted_at optional

## 2.3.5 - 2025-05-15

### Added

- Nothing

### Changed

- CitronelBaseModel append attributes instead of attributes

### Deprecated

- Nothing

### Removed

- Nothing

### Fixed

- Nothing

## 2.3.4 - 2025-05-10

### Added

- locale property in CitronelController

### Changed

- Nothing

### Deprecated

- Nothing

### Removed

- Nothing

### Fixed

- Nothing

## 2.3.3 - 2025-05-04

### Added

- Nothing

### Changed

- Nothing

### Deprecated

- Nothing

### Removed

- Nothing

### Fixed

- CitronelSetLocale import App

## 2.3.2 - 2025-05-04

### Added

- Nothing

### Changed

- CitronelBaseModel - base attributes

### Deprecated

- Nothing

### Removed

- Nothing

### Fixed

- Nothing

## 2.3.1 - 2025-05-04

### Added

- CitronelBaseModel

### Changed

- Nothing

### Deprecated

- Nothing

### Removed

- Nothing

### Fixed

- Nothing

## 2.2.1 - 2025-05-03

### Added

- Nothing

### Changed

- Nothing

### Deprecated

- Nothing

### Removed

- Nothing

### Fixed

- Laravel dependency "laravel/framework" instead of laravel/laravel

## 2.2.0 - 2025-05-03

### Added

- CitronelSetLocale middleware to handle languages

### Changed

- config/citronel.php - supported locales config

### Deprecated

- Nothing

### Removed

- Nothing

### Fixed

- Nothing

## 2.2.0 - 2025-05-03

### Added

- CitronelSetLocale middleware to handle languages

### Changed

- config/citronel.php - supported locales config

### Deprecated

- Nothing

### Removed

- Nothing

### Fixed

- Nothing

## 2.1.9 - 2025-04-10

### Added

- Nothing

### Changed

- Provider - stop loading translations
- CitronelMoneyTrait:
  - formatAmount()
- composer.json:
  - add bcmath dependency

### Deprecated

- Nothing

### Removed

- resources/lang

### Fixed

- Nothing

## 2.1.2 - 2025-02-13

### Added

- Nothing

### Changed

- Nothing

### Deprecated

- Nothing

### Removed

- Nothing

### Fixed

- registerExceptionContext() in provider

## 2.1.1 - 2025-02-13

### Added

- maskContactDetail in CitronelMaskTrait
- exception context
- app review in config

### Changed

- Nothing

### Deprecated

- Nothing

### Removed

- Nothing

### Fixed

- namespace in CitronelHelperService

## 2.1.0 - 2025-01-23

### Added

- Nothing

### Changed

- Nothing

### Deprecated

- Nothing

### Removed

- src/Contracts/Auth/MustBeActive.php
- src/Contracts/Auth/MustBeVerified.php
- src/Http/Middleware/Actor/EnsureActorIsActive.php
- src/Http/Middleware/Actor/EnsureActorIsVerified.php
- src/Models/Actor/CitronelActor.php
- src/Policies/Actor/CitronelActorPolicy.php

### Fixed

- Nothing

## 2.0.1 - 2025-01-22

### Added

- Nothing

### Changed

- Nothing

### Deprecated

- Nothing

### Removed

- Nothing

### Fixed

- use error catalogue correctly in middleware

## 2.0.0 - 2025-01-22

### Added

- Nothing

### Changed

- new version of dependency aliirfaan/citronel-error-catalogue

### Deprecated

- Nothing

### Removed

- Nothing

### Fixed

- Nothing

## 1.1.0 - 2025-01-15

### Added

- formatCurrencyAmountWithCode() to display currency amounts

### Changed

- Nothing

### Deprecated

- Nothing

### Removed

- Nothing

### Fixed

- Nothing