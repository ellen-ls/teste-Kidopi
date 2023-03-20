<?php

namespace App\Service;

use App\Entity\SalveInfo;
use App\Exception\CountryNotFoundException;
use App\Repository\SalveInfoRepository;

class AcessService
{
    public function __construct(
        private SalveInfoRepository $repository
    ) { }

    public function saveAccess(string $country): SalveInfo
    {
        if (empty($country)) {
            throw new \InvalidArgumentException('country not found.');
        }

        $covid = (new SalveInfo())
            ->setDate(new \DateTime('now'))
            ->setCountry($country)

        ;

        $this->repository->save($covid, true);

        return $covid;
    }

    public function getLastAcess(): ?SalveInfo
    {
     return $this->repository->findOneBy([],['date' => 'DESC']);
    }
}