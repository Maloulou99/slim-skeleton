<?php

namespace PatrykZak\SlimSkeleton\model;

interface UserRepository
{
    public function save(User $user): void;

}