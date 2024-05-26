<!--
 - SPDX-FileCopyrightText: 2024 Richard Steinmetz <richard@steinmetz.cloud>
 - SPDX-License-Identifier: AGPL-3.0-or-later
-->

# Preview Cleaner

This Nextcloud app adds a command to clean all existing previews.

## Install

1. Clone this repository.
2. Run: `composer i --no-dev`
3. Move the whole directory to your Nextcloud apps directory.
4. Enable the app: `occ app:enable preview_cleaner`

## Usage

`occ preview:clean-all`

**Warning:** This command might take a long time to finish depending on the amount of previews on your Nextcloud server.

## Disclaimer

This app is highly experimental and I did not test it on big instances yet!

I do not recommend running the `preview:clean-all` command during heavy load.
Ideally, there should be no ongoing generation of previews while the command is running.
