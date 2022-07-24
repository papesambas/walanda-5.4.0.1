<?php

namespace App\Test\Controller;

use App\Entity\Publications;
use App\Repository\PublicationsRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PublicationsControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private PublicationsRepository $repository;
    private string $path = '/publications/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->repository = (static::getContainer()->get('doctrine'))->getRepository(Publications::class);

        foreach ($this->repository->findAll() as $object) {
            $this->repository->remove($object, true);
        }
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Publication index');

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
            'publication[titre]' => 'Testing',
            'publication[slug]' => 'Testing',
            'publication[contenu]' => 'Testing',
            'publication[featuredText]' => 'Testing',
            'publication[isActive]' => 'Testing',
            'publication[isPublished]' => 'Testing',
            'publication[publishedAt]' => 'Testing',
            'publication[favoris]' => 'Testing',
            'publication[createdAt]' => 'Testing',
            'publication[updatedAt]' => 'Testing',
            'publication[author]' => 'Testing',
            'publication[categorie]' => 'Testing',
            'publication[featuredImage]' => 'Testing',
        ]);

        self::assertResponseRedirects('/publications/');

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Publications();
        $fixture->setTitre('My Title');
        $fixture->setSlug('My Title');
        $fixture->setContenu('My Title');
        $fixture->setFeaturedText('My Title');
        $fixture->setIsActive('My Title');
        $fixture->setIsPublished('My Title');
        $fixture->setPublishedAt('My Title');
        $fixture->setFavoris('My Title');
        $fixture->setCreatedAt('My Title');
        $fixture->setUpdatedAt('My Title');
        $fixture->setAuthor('My Title');
        $fixture->setCategorie('My Title');
        $fixture->setFeaturedImage('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Publication');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Publications();
        $fixture->setTitre('My Title');
        $fixture->setSlug('My Title');
        $fixture->setContenu('My Title');
        $fixture->setFeaturedText('My Title');
        $fixture->setIsActive('My Title');
        $fixture->setIsPublished('My Title');
        $fixture->setPublishedAt('My Title');
        $fixture->setFavoris('My Title');
        $fixture->setCreatedAt('My Title');
        $fixture->setUpdatedAt('My Title');
        $fixture->setAuthor('My Title');
        $fixture->setCategorie('My Title');
        $fixture->setFeaturedImage('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'publication[titre]' => 'Something New',
            'publication[slug]' => 'Something New',
            'publication[contenu]' => 'Something New',
            'publication[featuredText]' => 'Something New',
            'publication[isActive]' => 'Something New',
            'publication[isPublished]' => 'Something New',
            'publication[publishedAt]' => 'Something New',
            'publication[favoris]' => 'Something New',
            'publication[createdAt]' => 'Something New',
            'publication[updatedAt]' => 'Something New',
            'publication[author]' => 'Something New',
            'publication[categorie]' => 'Something New',
            'publication[featuredImage]' => 'Something New',
        ]);

        self::assertResponseRedirects('/publications/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getTitre());
        self::assertSame('Something New', $fixture[0]->getSlug());
        self::assertSame('Something New', $fixture[0]->getContenu());
        self::assertSame('Something New', $fixture[0]->getFeaturedText());
        self::assertSame('Something New', $fixture[0]->getIsActive());
        self::assertSame('Something New', $fixture[0]->getIsPublished());
        self::assertSame('Something New', $fixture[0]->getPublishedAt());
        self::assertSame('Something New', $fixture[0]->getFavoris());
        self::assertSame('Something New', $fixture[0]->getCreatedAt());
        self::assertSame('Something New', $fixture[0]->getUpdatedAt());
        self::assertSame('Something New', $fixture[0]->getAuthor());
        self::assertSame('Something New', $fixture[0]->getCategorie());
        self::assertSame('Something New', $fixture[0]->getFeaturedImage());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();

        $originalNumObjectsInRepository = count($this->repository->findAll());

        $fixture = new Publications();
        $fixture->setTitre('My Title');
        $fixture->setSlug('My Title');
        $fixture->setContenu('My Title');
        $fixture->setFeaturedText('My Title');
        $fixture->setIsActive('My Title');
        $fixture->setIsPublished('My Title');
        $fixture->setPublishedAt('My Title');
        $fixture->setFavoris('My Title');
        $fixture->setCreatedAt('My Title');
        $fixture->setUpdatedAt('My Title');
        $fixture->setAuthor('My Title');
        $fixture->setCategorie('My Title');
        $fixture->setFeaturedImage('My Title');

        $this->repository->add($fixture, true);

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertSame($originalNumObjectsInRepository, count($this->repository->findAll()));
        self::assertResponseRedirects('/publications/');
    }
}
