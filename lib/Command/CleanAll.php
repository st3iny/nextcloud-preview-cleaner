<?php

declare(strict_types=1);

/**
 * SPDX-FileCopyrightText: 2024 Richard Steinmetz <richard@steinmetz.cloud>
 * SPDX-License-Identifier: AGPL-3.0-or-later
 */

namespace OCA\PreviewCleaner\Command;

use OCP\Files\AppData\IAppDataFactory;
use OCP\Files\IAppData;
use OCP\Files\NotPermittedException;
use OCP\IConfig;
use RuntimeException;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CleanAll extends Command {
	private IAppData $appData;

	public function __construct(
		private IConfig $config,
		IAppDataFactory $appDataFactory,
	) {
		parent::__construct();
		$this->appData = $appDataFactory->get('preview');
	}

	protected function configure(): void {
		$this->setName('preview:clean-all');
		$this->setDescription('Clean all previews');
	}

	protected function execute(InputInterface $input, OutputInterface $output): int {
		$listing = $this->appData->getDirectoryListing();
		if (empty($listing)) {
			$output->writeln('No previews available');
			return 0;
		}

		$output->writeln('Deleting all folders in /' . $this->getAppDataFolderName() . '/preview');

		$atLeastOneFailed = false;
		$progressBar = new ProgressBar($output, count($listing));
		foreach ($listing as $e) {
			try {
				$e->delete();
			} catch (NotPermittedException $e) {
				$atLeastOneFailed = true;
				$message = $e->getMessage();
				$output->writeln("<error>NotPermittedException: $message</error>");
			} finally {
				$progressBar->advance();
			}
		}

		return $atLeastOneFailed ? 1 : 0;
	}

	/**
	 * @see \OC\Files\AppData\AppData::getAppDataFolderName
	 *
	 * @throws RuntimeException If there is no instanceid
	 */
	private function getAppDataFolderName(): string {
		$instanceId = $this->config->getSystemValue('instanceid', null);
		if ($instanceId === null) {
			throw new RuntimeException('no instance id!');
		}

		return 'appdata_' . $instanceId;
	}
}
