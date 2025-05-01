<?php

namespace App\Command;

use App\Entity\Category;
use App\Enum\ContentTypeEnum;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\String\Slugger\AsciiSlugger;

#[AsCommand(
    name: 'app:generate-categories',
    description: 'Generate Category entities for all defined ContentTypeEnum cases.'
)]
class GenerateCategoriesCommand extends Command
{
    public function __construct(
        private EntityManagerInterface $em
    )
    {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $repo = $this->em->getRepository(Category::class);
        $definitions = $this->getCategories();
        $created = [];

        foreach ($definitions as $value => $def) {
            $slug = $def['slug'];

            // Skip if already exists
            if ($repo->findOneBy([
                'slug' => $slug,
            ])) {
                $io->note("Category '{$value}' (slug='{$slug}') already exists, skipping.");
                continue;
            }

            $category = new Category(
                title: $def['title'],
                description: $def['description'],
                slug: $slug,
                icon: null,
                image: $def['image'],
                color: null,
                contentTypeEnum: $def['contentType'],
                displayOrder: $def['order']
            );

            $this->em->persist($category);
            $created[] = $slug;
            $io->writeln("  + Prepared '{$value}' (slug='{$slug}')");
        }

        if (count($created) > 0) {
            $this->em->flush();
            $io->success('Created categories: ' . implode(', ', $created));
        } else {
            $io->warning('No new categories to create.');
        }

        return Command::SUCCESS;
    }

    /**
     * @return array<string, array{title:string,slug:string,image:string,contentType:ContentTypeEnum}>
     */
    private function getCategories(): array
    {
        $slugger = new AsciiSlugger();
        $categories = [];

        $descriptions = [
            ContentTypeEnum::CUISINE_AND_NIGHTLIFE->name => 'Restaurants, tavernas, cafés, bars & cocktail spots',
            ContentTypeEnum::SHOPPING_AND_SUPPLIES->name => 'Local shops, markets, chandleries, grocery stores & souvenir boutiques',
            ContentTypeEnum::MARINE_AND_YACHTING->name => 'Marinas, boat yards, yacht charters & services, sailing schools',
            ContentTypeEnum::TRAVEL_AND_TRANSPORT->name => 'Car, bike & scooter rentals, taxis, bus & ferry schedules',
            ContentTypeEnum::ACCOMMODATION->name => 'Hotels, guesthouses, villas, B&Bs & campgrounds',
            ContentTypeEnum::BEACHES_AND_NATURE->name => 'Beaches, hiking trails, scenic viewpoints & parks',
            ContentTypeEnum::CULTURE_AND_HERITAGE->name => 'Museums, archaeological sites, historic villages & churches',
            ContentTypeEnum::EVENTS->name => 'Festivals, concerts, workshops, sports & local activities',
            ContentTypeEnum::INFORMATION->name => 'Tourist info office, emergency numbers, ATMs, post office, Wi-Fi hotspots & maps',
        ];

        $count = 0;
        foreach (ContentTypeEnum::cases() as $case) {
            $slug = $slugger->slug($case->value)->lower()->toString();
            $categories[$case->value] = [
                'title' => "category.$slug",
                'description' => $descriptions[$case->name],
                'order' => $count,
                'slug' => $slug,
                'image' => "images/categories/{$slug}.jpg",
                'contentType' => ContentTypeEnum::from($case->value),
            ];
            $count++;
        }

        return $categories;
    }
}
