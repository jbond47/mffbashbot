# Harry's My Free Farm Bash Bot Mod - Changelog

The format is based on [Keep a Changelog](http://keepachangelog.com/en/1.0.0/)

Version numbering in this mod uses Harry's My Free Farm Bash Bot version number, extended with a mod version number.

## [2.24-mod.1.0.8] - 2018-04-02

### Added

- Optional autostart of pet breeding (Thank you to Jens from MyFreeFarm Berater forum for input and code example)

## [2.24-mod.1.0.7] - 2018-03-18

### Added

- Optional autostart of veterinarian (Thank you to Jens and Harry from MyFreeFarm Berater forum for their input and code examples)

### Changed

- Fixed typo in WebGUI code

## [2.24-mod.1.0.6] - 2018-03-16

### Changed

- Merged official v2.24

## [2.04-mod.1.0.6] - 2018-01-18

### Added

- New option: Claim daily 10 minute growth bonus on one field on a farm of your choice. Thank you to tooway for the Bulgarian translation of this option.

### Changed

- Several jq queries changed. There is a bug in jq under cygwin which causes jq to crash and create a "jq.exe.stackdump" file when you query a non existing value.

- Code optimizations

### Untested

- Changes to megafield "check empty harvest device" function to possibly prevent multiple buying of harvest device

## [2.04-mod.1.0.5] - 2018-01-15

### Changed

- Merged official v2.04

## [2.03-mod.1.0.5] - 2018-01-09

### Added

- Optimized food world handling of munchies sitting at tables

- Output player level on console

### Changed

- Merged official v2.03

## [2.01-mod.1.0.4] - 2018-01-05

### Added

- Based on your player level, the bot now skips several operations

- Handle munchies sitting at tables in food world

### Changed

- Merged official v2.02

- Minor documentation updates

## [2.01-mod.1.0.3] - 2017-12-25

### Fixed

- Daily bonus for Super and Horror sheep now works even when you never redeemed it before

### Added

- Mod version output on console

### Changed

- Merged official v2.01

- Seed box Horror Sheep bonus is now tested and verified

### Removed

- Get daily bonuses for Hero Sheep, Horror Sheep, Portal Rabbit and Bug Rogers. These features are merged into Harrys official Bot (with some code cleanup thanks to Harry)

## [2.00-mod.1.0.2] - 2017-12-23

### Changed

- Minor code changes for better readability

## [2.00-mod.1.0.1] - 2017-12-23

Update to latest official bot v2.00

### Changed

- Merged Mod into official v2.00. This required some changes to the code.

### Untested

- Get daily bonus for Horror Sheep

## [1.98-mod.1.0.0] - 2017-12-23

Based on offical v1.98

### Added

- Transport from Farm 5 to Farm 1 also includes eggs
- Get daily bonuses for:
  - Hero Sheep
  - Portal Rabbit
  - Bug Rogers

### Untested

- Get daily bonus for Horror Sheep
