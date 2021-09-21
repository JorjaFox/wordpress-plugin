# Fans of LeFox Plugin

[![Version](https://img.shields.io/badge/version-2.1-green.svg)](https://shields.io/) [![GPLv2 license](https://img.shields.io/badge/License-GPLv2-blue.svg)](https://www.gnu.org/licenses/old-licenses/gpl-2.0.html)

This plugin manages the oddities specific to the Fans of LeFox site. It probably is useless to anyone else, but I find it's good practice to properly document all the things.

## Structure

- `index.php` - Main file

### Gutenberg Blocks (`blocks`)

- Recaps: Episode recaps
- Spoiler: Spoiler Warning (same as LWTV)

### Comment Management (`comments`)

- `comment-probation.php` - Fork of abandoned plugin
- `/policy/` - Comment policy checkbox, with GDPR features

### Custom Post Type code (`cpts`)

- `videos.php` - Video CPT

### Features (`features`)

- `shortcodes.php` - custom shortcodes and embeds
- `tvmaze.php` - Widget to display next episode of a TV show.
- `upgrades.php` - Auto upgrade all the things
- `videos.php` - Custom video embeds (ie. CBS etc)

## Publishing

Automated deployments happen when pushing to the `production` branch.

Only authorized accounts can publish, but pull requests are welcome.
