<?php declare(strict_types = 1);

namespace PHPStan\Rules\Symfony;

use PHPStan\Rules\Rule;
use PHPStan\Symfony\XmlServiceMapFactory;
use PHPStan\Testing\RuleTestCase;

final class ContainerInterfacePrivateServiceRuleTest extends RuleTestCase
{

	protected function getRule(): Rule
	{
		return new ContainerInterfacePrivateServiceRule((new XmlServiceMapFactory(__DIR__ . '/container.xml'))->create());
	}

	public function testGetPrivateService(): void
	{
		$this->analyse(
			[
				__DIR__ . '/ExampleController.php',
			],
			[
				[
					'Service "private" is private.',
					12,
				],
			]
		);
	}

	public function testGetPrivateServiceInServiceSubscriber(): void
	{
		if (!interface_exists('Symfony\\Component\\DependencyInjection\\ServiceSubscriberInterface')) {
			self::markTestSkipped('The test needs Symfony\Component\DependencyInjection\ServiceSubscriberInterface class.');
		}

		$this->analyse(
			[
				__DIR__ . '/ExampleServiceSubscriber.php',
			],
			[]
		);
	}

}
