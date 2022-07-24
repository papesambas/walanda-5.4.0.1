<?php

namespace App\Test\Controller;

use App\Entity\Niveaux;
use App\Repository\NiveauxRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class NiveauxControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private NiveauxRepository $repository;
    private string $path = '/niveaux/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->repository = (static::getContainer()->get('doctrine'))->getRepository(Niveaux::class);

        foreach ($this->repository->findAll() as $object) {
            $this->repository->remove($object, true);
        }
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Niveau index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first());
    }

    public function testNew(): void
    {
        $originalNumObjectsInRepository = count($this->repository->findAll());

        $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'niveau[designation]' => 'Testing',
            'niveau[slug]' => 'Testing',
            'niveau[cycle]' => 'Testing',
            'niveau[categories]' => 'Testing',
        ]);

        self::assertResponseRedirects('/niveaux/');

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Niveaux();
        $fixture->setDesignation('My Title');
        $fixture->setSlug('My Title');
        $fixture->setCycle('My Title');
        $fixture->setCategories('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Niveau');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Niveaux();
        $fixture->setDesignation('My Title');
        $fixture->setSlug('My Title');
        $fixture->setCycle('My Title');
        $fixture->setCategories('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'niveau[designation]' => 'Something New',
            'niveau[slug]' => 'Something New',
            'niveau[cycle]' => 'Something New',
            'niveau[categories]' => 'Something New',
        ]);

        self::assertResponseRedirects('/niveaux/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getDesignation());
        self::assertSame('Something New', $fixture[0]->getSlug());
        self::assertSame('Something New', $fixture[0]->getCycle());
        self::assertSame('Something New', $fixture[0]->getCategories());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();

        $originalNumObjectsInRepository = count($this->repository->findAll());

        $fixture = new Niveaux();
        $fixture->setDesignation('My Title');
        $fixture->setSlug('My Title');
        $fixture->setCycle('My Title');
        $fixture->setCategories('My Title');

        $this->repository->add($fixture, true);

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertSame($originalNumObjectsInRepository, count($this->repository->findAll()));
        self::assertResponseRedirects('/niveaux/');
    }
}
