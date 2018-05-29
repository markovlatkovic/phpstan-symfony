<?php declare(strict_types = 1);

namespace PHPStan\Rules\Symfony;

use PHPStan\Rules\Rule;
use PHPStan\Symfony\ServiceMap;

final class ContainerInterfaceUnknownServiceRuleTest extends \PHPStan\Testing\RuleTestCase
{

	protected function getRule(): Rule
	{
		$serviceMap = new ServiceMap(__DIR__ . '/../../Symfony/data/container.xml');

		return new ContainerInterfaceUnknownServiceRule($serviceMap);
	}

	public function testGetUnknownService(): void
	{
		$this->analyse(
			[__DIR__ . '/../../Symfony/data/ExampleController.php'],
			[
				[
					'Service "service.not.found" is not registered in the container.',
					20,
				],
				[
					'Service "PHPStan\Symfony\ServiceMap" is not registered in the container.',
					26,
				],
				[
					'Service "service.PHPStan\Symfony\ServiceMap" is not registered in the container.',
					38,
				],
				[
					'Service "PHPStan\Symfony\ExampleController" is not registered in the container.',
					44,
				],
			]
		);
	}

}