<?php

namespace App\Factory;

use App\Entity\EventCategory;
use App\Repository\EventCategoryRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<EventCategory>
 *
 * @method        EventCategory|Proxy                     create(array|callable $attributes = [])
 * @method static EventCategory|Proxy                     createOne(array $attributes = [])
 * @method static EventCategory|Proxy                     find(object|array|mixed $criteria)
 * @method static EventCategory|Proxy                     findOrCreate(array $attributes)
 * @method static EventCategory|Proxy                     first(string $sortedField = 'id')
 * @method static EventCategory|Proxy                     last(string $sortedField = 'id')
 * @method static EventCategory|Proxy                     random(array $attributes = [])
 * @method static EventCategory|Proxy                     randomOrCreate(array $attributes = [])
 * @method static EventCategoryRepository|RepositoryProxy repository()
 * @method static EventCategory[]|Proxy[]                 all()
 * @method static EventCategory[]|Proxy[]                 createMany(int $number, array|callable $attributes = [])
 * @method static EventCategory[]|Proxy[]                 createSequence(iterable|callable $sequence)
 * @method static EventCategory[]|Proxy[]                 findBy(array $attributes)
 * @method static EventCategory[]|Proxy[]                 randomRange(int $min, int $max, array $attributes = [])
 * @method static EventCategory[]|Proxy[]                 randomSet(int $number, array $attributes = [])
 */
final class EventCategoryFactory extends ModelFactory
{
    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services
     *
     * @todo inject services if required
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     *
     * @todo add your default values here
     */
    protected function getDefaults(): array
    {
        $categories = ['culture', 'sport', 'business', 'social', 'political', 'entertainment', 'religious'];
        return [
            'name' => self::faker()->unique()->randomElement($categories)
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(EventCategory $eventCategory): void {})
        ;
    }

    protected static function getClass(): string
    {
        return EventCategory::class;
    }
}
