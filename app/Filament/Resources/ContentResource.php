<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Content;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\ContentResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\ContentResource\RelationManagers;

class ContentResource extends Resource
{
    protected static ?string $model = Content::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Content Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                    ->schema([
                        Group::make()
                            ->schema([
                                TextInput::make('name')
                                    ->required()
                                    ->placeholder('Masukan Nama Konten')
                                    ->label('Name'),
                                Select::make('type')
                                    ->options([
                                        'facebook' => 'Facebook',
                                        'twitter' => 'Twitter',
                                        'instagram' => 'Instagram',
                                        'address' => 'Address',
                                        'email' => 'Email',
                                        'phone' => 'Phone Number',
                                    ])
                                    ->unique(ignoreRecord: true)
                                    ->native(false)
                                    ->required()
                                    ->label('Type'),
                            ])->columns(2),
                        Textarea::make('content')
                            ->required()
                            ->placeholder('Masukan Link Atau Isi Konten')
                            ->label('Content'),
                    ])

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->label('ID')->sortable()->searchable(),
                TextColumn::make('name')->label('Name')->sortable()->searchable(),
                TextColumn::make('content')->label('Content')->sortable()->searchable()->toggleable(isToggledHiddenByDefault: false),
                TextColumn::make('type')->label('Type')->sortable()->searchable(),
                TextColumn::make('created_at')->label('Created At')->sortable()->searchable()->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListContents::route('/'),
            'create' => Pages\CreateContent::route('/create'),
            'edit' => Pages\EditContent::route('/{record}/edit'),
        ];
    }
}
