<?php


namespace App\Shared\Infrastructure\Bus\Command\Middleware;


use App\Shared\Domain\Bus\Command\CommandInterface;
use Doctrine\ORM\EntityManagerInterface;

final class DoctrineTransactionMiddleware extends MiddlewareHandler
{
    public function __construct(private EntityManagerInterface $entityManager)
    {
    }

    public function handle(CommandInterface $command): void
    {
        if ($this->entityManager->getConnection()->isTransactionActive()) {
            $this->nextHandler->handle($command);
            return;
        }

        $this->entityManager->beginTransaction();
        $this->nextHandler->handle($command);

        try {
            $this->entityManager->flush();
            $this->entityManager->commit();
            $this->entityManager->clear();
        } catch (\Throwable $e) {
            $this->entityManager->close();
            $this->entityManager->rollback();
            throw $e;
        }
    }
}