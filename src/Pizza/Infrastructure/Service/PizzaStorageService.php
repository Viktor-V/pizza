<?php

declare(strict_types=1);

namespace App\Pizza\Infrastructure\Service;

use App\Pizza\Domain\Entity\Pizza;
use Symfony\Component\Cache\Adapter\AdapterInterface;
use Symfony\Component\HttpFoundation\RequestStack;

class PizzaStorageService
{
    public function __construct(
        private AdapterInterface $cache,
        private RequestStack $requestStack
    ) {}

    public function get(Pizza $pizza): Pizza
    {
        $item = $this->cache->getItem(
            (string) $pizza->uuid() . $this->requestStack->getCurrentRequest()->getSession()->getId()
        );

        if (!$item->isHit()) {
            return $pizza;
        }

        return $item->get();
    }

    public function set(Pizza $pizza): Pizza
    {
        $item = $this->cache->getItem(
            (string) $pizza->uuid() . $this->requestStack->getCurrentRequest()->getSession()->getId()
        );

        if (!$item->isHit()) {
            $item->expiresAfter(900); // expires after 15 min
        }

        $item->set($pizza);

        $this->cache->save($item);

        return $item->get();
    }

    public function reset(Pizza $pizza): void
    {
        $this->cache->deleteItem(
            (string) $pizza->uuid() . $this->requestStack->getCurrentRequest()->getSession()->getId()
        );
        $this->cache->commit();
    }
}
