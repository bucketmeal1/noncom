<?php

namespace App\Filament\User\Widgets;

use App\Models\Consultation;
use App\Models\Patient;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;


class StatOverview extends BaseWidget
{
    protected static ?int $sort = 1;
    protected function getStats(): array
    
    {
        return [
            Stat::make('Total Patient', Patient::count())
            ->description('Increase in Patient')
            ->descriptionIcon('heroicon-m-arrow-trending-up')
            ->color('success')
            ->chart([7,3,4,5,6,3,5,3]),

            Stat::make('Total Consultation', Consultation::count())
            ->description('Increase in Patient')
            ->descriptionIcon('heroicon-m-arrow-trending-up')
            ->color('success')
            ->chart([7,3,4,5,6,3,5,3]),

            Stat::make('Male Patient', Patient::where('gender','male')->count())
            ->description('Increase in Patient')
            ->descriptionIcon('heroicon-m-arrow-trending-up')
            ->color('success')
            ->chart([7,3,4,5,6,3,5,3]),

            Stat::make('Female Patient', Patient::where('gender','female')->count())
            ->description('Increase in Patient')
            ->descriptionIcon('heroicon-m-arrow-trending-up')
            ->color('success')
            ->chart([7,3,4,5,6,3,5,3]),
        ];
    }
}
