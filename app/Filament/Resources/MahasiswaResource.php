<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MahasiswaResource\Pages;
use App\Filament\Resources\MahasiswaResource\RelationManagers;
use App\Models\Mahasiswa;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MahasiswaResource extends Resource
{
    protected static ?string $model = Mahasiswa::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('Nim')
                ->required()
                ->maxLength(20),
            Forms\Components\TextInput::make('Nama_Lengkap')
                ->required()
                ->maxLength(100),
            Forms\Components\DatePicker::make('Tanggal_Lahir')
                ->required(),

            // Dropdown kosong (sementara menunggu API)
            Forms\Components\Select::make('Id_Jk')
                ->label('Jenis Kelamin')
                ->options([])
                ->nullable(),
            Forms\Components\Select::make('Id_Agama')
                ->label('Agama')
                ->options([])
                ->nullable(),
            Forms\Components\Select::make('Id_Provinsi')
                ->options([])
                ->nullable(),
            Forms\Components\Select::make('Id_Kabupaten')
                ->options([])
                ->nullable(),
            Forms\Components\Select::make('Id_Kecamatan')
                ->options([])
                ->nullable(),
            Forms\Components\Select::make('Id_Kelurahan')
                ->options([])
                ->nullable(),

            Forms\Components\Textarea::make('Alamat')
                ->required(),
            Forms\Components\TextInput::make('Email')
                ->email()
                ->required()
                ->maxLength(30),
            Forms\Components\FileUpload::make('Foto_Profil')
                ->directory('foto_profil')
                ->nullable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('Nim')->searchable(),
            Tables\Columns\TextColumn::make('Nama_Lengkap')->searchable(),
            Tables\Columns\TextColumn::make('Tanggal_Lahir')->date(),
            Tables\Columns\TextColumn::make('Email'),
            Tables\Columns\TextColumn::make('Alamat'),

            // Tampilkan teks "Undefined" jika null
            Tables\Columns\TextColumn::make('Id_Jk')->label('Jenis Kelamin')
                ->formatStateUsing(fn ($state) => $state ?? 'Undefined'),
            Tables\Columns\TextColumn::make('Id_Agama')
                ->formatStateUsing(fn ($state) => $state ?? 'Undefined'),
            Tables\Columns\TextColumn::make('Id_Provinsi')
                ->formatStateUsing(fn ($state) => $state ?? 'Undefined'),
            Tables\Columns\TextColumn::make('Id_Kabupaten')
                ->formatStateUsing(fn ($state) => $state ?? 'Undefined'),
            Tables\Columns\TextColumn::make('Id_Kecamatan')
                ->formatStateUsing(fn ($state) => $state ?? 'Undefined'),
            Tables\Columns\TextColumn::make('Id_Kelurahan')
                ->formatStateUsing(fn ($state) => $state ?? 'Undefined'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
   Tables\Actions\DeleteAction::make(),
   Tables\Actions\ViewAction::make(),

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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMahasiswas::route('/'),
            'create' => Pages\CreateMahasiswa::route('/create'),
            'edit' => Pages\EditMahasiswa::route('/{record}/edit'),
        ];
    }
}
