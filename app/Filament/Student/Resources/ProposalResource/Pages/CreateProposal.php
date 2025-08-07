<?php

namespace App\Filament\Student\Resources\ProposalResource\Pages;

use App\Filament\Student\Resources\ProposalResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateProposal extends CreateRecord
{
    protected static string $resource = ProposalResource::class;
protected function getRedirectUrl(): string
{
    return $this->getResource()::getUrl('index');
}
}
