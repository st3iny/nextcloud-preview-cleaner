<?php

declare(strict_types=1);

/**
 * SPDX-FileCopyrightText: 2024 Richard Steinmetz <richard@steinmetz.cloud>
 * SPDX-License-Identifier: AGPL-3.0-or-later
 */

namespace OCA\PreviewCleaner\AppInfo;

use OCP\AppFramework\App;
use OCP\AppFramework\Bootstrap\IBootContext;
use OCP\AppFramework\Bootstrap\IBootstrap;
use OCP\AppFramework\Bootstrap\IRegistrationContext;

class Application extends App implements IBootstrap {
	/**
	 * @var string
	 */
	public const APP_ID = 'preview_cleaner';

	/**
	 * Application constructor.
	 *
	 * @param array $urlParams
	 */
	public function __construct(array $urlParams = []) {
		parent::__construct(self::APP_ID, $urlParams);
	}

	/**
	 * @inheritDoc
	 */
	public function register(IRegistrationContext $context): void {
	}

	/**
	 * @inheritDoc
	 */
	public function boot(IBootContext $context): void {
	}
}
