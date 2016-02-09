<?php
/**
 * @author Lukas Reschke <lukas@owncloud.com>
 *
 * @copyright Copyright (c) 2016, ownCloud, Inc.
 * @license AGPL-3.0
 *
 * This code is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License, version 3,
 * as published by the Free Software Foundation.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License, version 3,
 * along with this program.  If not, see <http://www.gnu.org/licenses/>
 *
 */

namespace OCA\UpdateNotification\AppInfo;

use OC\AppFramework\Utility\TimeFactory;
use OCA\UpdateNotification\Controller\AdminController;
use OCP\AppFramework\App;
use OCP\AppFramework\IAppContainer;

class Application extends App {
	public function __construct (array $urlParams = array()) {
		parent::__construct('updatenotification', $urlParams);
		$container = $this->getContainer();

		$container->registerService('AdminController', function(IAppContainer $c) {
			return new AdminController(
				$c->query('AppName'),
				$c->query('Request'),
				$c->getServer()->getJobList(),
				$c->getServer()->getSecureRandom(),
				$c->getServer()->getConfig(),
				new TimeFactory()
			);
		});
	}

}
