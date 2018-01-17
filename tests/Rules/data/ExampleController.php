<?php

declare(strict_types = 1);

namespace Lookyman\PHPStan\Symfony\Rules\data;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

final class ExampleController extends Controller
{

	public function getPrivateServiceAction()
	{
		$service = $this->get('private');
		$service->noMethod();
	}

	public function getUnknownService()
	{
		$service = $this->get('service.not.found');
		$service->noMethod();
	}

	public function getVariableService(string $serviceKey)
	{
		$service = $this->get($serviceKey);
		$service->noMethod();
	}

	public function getConcatenatedService(string $serviceKey)
	{
		$service = $this->get('service.' . self::class);
		$service->noMethod();
	}

}