<?php

namespace App\Test\Controller;

use App\Entity\Comments;
use App\Repository\CommentsRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CommentsControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private CommentsRepository $repository;
    private string $path = '/comments/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->repository = (static::getContainer()->get('doctrine'))->getRepository(Comments::class);

        foreach ($this->repository->findAll() as $object) {
            $this->repository->remove($object, true);
        }
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Comment index');

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
            'comment[contenu]' => 'Testing',
            'comment[createdAt]' => 'Testing',
            'comment[rgpd]' => 'Testing',
            'comment[isActif]' => 'Testing',
            'comment[user]' => 'Testing',
            'comment[publication]' => 'Testing',
        ]);

        self::assertResponseRedirects('/comments/');

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Comments();
        $fixture->setContenu('My Title');
        $fixture->setCreatedAt('My Title');
        $fixture->setRgpd('My Title');
        $fixture->setIsActif('My Title');
        $fixture->setUser('My Title');
        $fixture->setPublication('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Comment');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Comments();
        $fixture->setContenu('My Title');
        $fixture->setCreatedAt('My Title');
        $fixture->setRgpd('My Title');
        $fixture->setIsActif('My Title');
        $fixture->setUser('My Title');
        $fixture->setPublication('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'comment[contenu]' => 'Something New',
            'comment[createdAt]' => 'Something New',
            'comment[rgpd]' => 'Something New',
            'comment[isActif]' => 'Something New',
            'comment[user]' => 'Something New',
            'comment[publication]' => 'Something New',
        ]);

        self::assertResponseRedirects('/comments/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getContenu());
        self::assertSame('Something New', $fixture[0]->getCreatedAt());
        self::assertSame('Something New', $fixture[0]->getRgpd());
        self::assertSame('Something New', $fixture[0]->getIsActif());
        self::assertSame('Something New', $fixture[0]->getUser());
        self::assertSame('Something New', $fixture[0]->getPublication());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();

        $originalNumObjectsInRepository = count($this->repository->findAll());

        $fixture = new Comments();
        $fixture->setContenu('My Title');
        $fixture->setCreatedAt('My Title');
        $fixture->setRgpd('My Title');
        $fixture->setIsActif('My Title');
        $fixture->setUser('My Title');
        $fixture->setPublication('My Title');

        $this->repository->add($fixture, true);

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertSame($originalNumObjectsInRepository, count($this->repository->findAll()));
        self::assertResponseRedirects('/comments/');
    }
}
