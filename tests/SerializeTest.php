<?php
use App\Model\BowlingGame;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Serializer\SerializerInterface;

class SerializeTest extends KernelTestCase
{
    function testSerialize(): void
    {
        $this->bootKernel();
        
        $container = $this->getContainer();
        
        $serializer = $container->get(SerializerInterface::class);
        
        $deserialized = $serializer->deserialize(file_get_contents('tests/bowlinggame.json'), BowlingGame::class, 'json');
        
        dump($deserialized);
    }
}