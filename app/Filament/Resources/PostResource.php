<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\Post;
use Filament\Tables;
use App\Models\Category;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Tabs;
use Filament\Tables\Filters\Filter;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ColorColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\ColorPicker;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Columns\CheckboxColumn;
use Filament\Forms\Components\MarkdownEditor;
use App\Filament\Resources\PostResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\PostResource\RelationManagers;
use App\Filament\Resources\PostResource\RelationManagers\UserRelationManager;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-duplicate';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Tabs::make()
                    ->tabs([
                        Tab::make('Post Data')->icon('heroicon-o-folder')->schema([
                            Section::make('Create a Post')->schema([
                                TextInput::make('title')
                                    ->required()
                                    ->columnSpan('full'),
                                TextInput::make('slug')
                                    ->required()
                                    ->columnSpan('full'),
                                Select::make('category_id')
                                    ->label('Category')
                                    ->relationship('category', 'name')
                                    ->columnSpan('full'),
                                ColorPicker::make('color')
                                    ->required()
                                    ->columnSpan('full'),
                            ])->columns(1),
                            Section::make('Meta')->schema([
                                FileUpload::make('thumbnail')
                                    ->disk('public')
                                    ->directory('thumbnail')
                                    ->columnSpan('full'),
                                TagsInput::make('tags')
                                    ->required()
                                    ->columnSpan('full'),
                                Checkbox::make('published')
                                    ->columnSpan('full'),
                            ])->columns(1),
                        ]),
                        Tab::make('Content')->icon('heroicon-o-pencil-square')->schema([
                            Section::make('Make a Post')->schema([
                                MarkdownEditor::make('content')
                                    ->required()
                                    ->columnSpan('full'),
                            ])->columns(1),
                        ]),
                    ]),
            ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('slug')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('category.name')
                    ->searchable()
                    ->sortable(),
                ColorColumn::make('color')
                    ->searchable()
                    ->sortable(),
                ImageColumn::make('thumbnail')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('tags')
                    ->searchable()
                    ->sortable(),
                CheckboxColumn::make('published')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->label('Publised On')
                    ->date('Y M')
                    ->searchable()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                // Filter::make('Published Post')->query(
                //     function (Builder $query): Builder {
                //         return $query->where('published', true);
                //     }
                // ),
                TernaryFilter::make('published'),
                SelectFilter::make('category_id')
                    ->options(Category::all()->pluck('name', 'id'))
                    ->multiple()
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }
}
