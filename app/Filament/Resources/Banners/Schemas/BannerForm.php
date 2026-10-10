<?php

namespace App\Filament\Resources\Banners\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class BannerForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                FileUpload::make('image_path')
                    ->label('Image')
                    ->required()
                    ->image()
                    ->imageEditor()
                    ->disk('public')
                    ->directory('banners')
                    ->maxSize(2048)
                    ->openable()
                    ->downloadable()
                    ->columnSpanFull(),

                TextInput::make('title')
                    ->label('Title')
                    ->required()
                    ->maxLength(255),

                TextInput::make('subtitle')
                    ->label('Subtitle')
                    ->maxLength(255),

                TextInput::make('link_url')
                    ->label('Link URL')
                    ->url()
                    ->maxLength(255)
                    ->prefixIcon('heroicon-o-link'),

                Toggle::make('is_active')
                    ->label('Is Active')
                    ->default(true),
            ]);
    }
}
