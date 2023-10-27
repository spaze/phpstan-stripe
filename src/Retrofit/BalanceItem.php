<?php
declare(strict_types = 1);

namespace Spaze\PHPStan\Stripe\Retrofit;

class BalanceItem
{
	public int $amount;

	public string $currency;

	/** @var null|array<BalanceItemSourceType> */
	public ?array $source_types;
}
