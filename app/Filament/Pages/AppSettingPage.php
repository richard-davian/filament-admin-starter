<?php

namespace App\Filament\Pages;

use App\Models\AppSetting;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Actions;
use Filament\Schemas\Components\Form;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use UnitEnum;
use BezhanSalleh\FilamentShield\Traits\HasPageShield;

/**
 * @property-read Schema $form
 */
class AppSettingPage extends Page implements HasForms
{
    use HasPageShield;
    use InteractsWithForms;

    protected string $view = 'filament.pages.app-setting-page';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::AdjustmentsHorizontal;
    protected static ?int $navigationSort                   = 91;
    protected static string|UnitEnum|null $navigationGroup  = 'Settings';
    protected static ?string $navigationLabel               = 'App Settings';
    protected static ?string $title                         = 'App Settings';

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill($this->getRecord()?->attributesToArray());
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Form::make([
                    Tabs::make('Settings')
                        ->columns(2)
                        ->tabs([
                            Tab::make('General')
                                ->schema([
                                    TextInput::make('app_name')
                                        ->label('App Name')
                                        ->required()
                                        ->maxLength(150),

                                    TextInput::make('tagline')
                                        ->label('Tagline')
                                        ->maxLength(200)
                                        ->helperText('Slogan singkat yang ditampilkan di bawah nama aplikasi.')
                                        ->placeholder('Contoh: Mudah. Cepat. Terpercaya.'),

                                    Textarea::make('description')
                                        ->label('Description')
                                        ->rows(4)
                                        ->columnSpanFull(),

                                    FileUpload::make('logo_url')
                                        ->label('Logo')
                                        ->image()
                                        ->imageEditor()
                                        ->disk('public')
                                        ->directory('settings')
                                        ->openable()
                                        ->downloadable()
                                        ->helperText('Format PNG atau JPG. Disarankan bentuk persegi atau landscape.'),

                                    FileUpload::make('favicon_url')
                                        ->label('Favicon')
                                        ->image()
                                        ->imageEditor()
                                        ->disk('public')
                                        ->directory('settings')
                                        ->openable()
                                        ->downloadable()
                                        ->helperText('Ikon kecil yang tampil di tab browser. Disarankan ukuran 32x32px, format PNG atau ICO.'),
                                ]),

                            Tab::make('Contact')
                                ->schema([
                                    TextInput::make('domain')
                                        ->label('Domain')
                                        ->maxLength(150)
                                        ->helperText('Alamat domain tanpa "https://", contoh: contoh.com')
                                        ->placeholder('contoh.com'),

                                    TextInput::make('email')
                                        ->label('Email')
                                        ->email()
                                        ->maxLength(150),

                                    TextInput::make('phone')
                                        ->label('Phone Number')
                                        ->tel()
                                        ->maxLength(30)
                                        ->helperText('Nomor telepon kantor, bisa telepon rumah atau HP.')
                                        ->placeholder('021-5551234'),

                                    TextInput::make('whatsapp_number')
                                        ->label('WhatsApp Number')
                                        ->tel()
                                        ->maxLength(30)
                                        ->helperText('Dipakai untuk tombol chat WhatsApp. Gunakan format internasional, tanpa "+" atau spasi.')
                                        ->placeholder('6281234567890'),

                                    Textarea::make('address')
                                        ->label('Address')
                                        ->rows(3)
                                        ->columnSpanFull(),

                                    TextInput::make('map_url')
                                        ->label('Map URL')
                                        ->url()
                                        ->maxLength(255)
                                        ->helperText('A location link from Google Maps, OpenStreetMap, or another map service.'),

                                    Textarea::make('map_embed_code')
                                        ->label('Map Embed Code')
                                        ->helperText('Paste the <iframe> embed code from Google Maps, OpenStreetMap, or another map service that supports embedding.')
                                        ->rows(3)
                                        ->columnSpanFull(),
                                ]),

                            Tab::make('Legal & Compliance')
                                ->schema([
                                    Textarea::make('copyright_text')
                                        ->label('Copyright Text')
                                        ->rows(2)
                                        ->columnSpanFull()
                                        ->helperText('Teks hak cipta di footer. Kosongkan jika ingin dibuat otomatis.')
                                        ->placeholder('© ' . date('Y') . ' My Application. All rights reserved.'),

                                    TextInput::make('privacy_url')
                                        ->label('Privacy Policy URL')
                                        ->maxLength(255)
                                        ->helperText('Link ke halaman Kebijakan Privasi.')
                                        ->placeholder('/privacy-policy'),

                                    TextInput::make('terms_url')
                                        ->label('Terms of Service URL')
                                        ->maxLength(255)
                                        ->helperText('Link ke halaman Syarat & Ketentuan.')
                                        ->placeholder('/terms'),
                                ]),

                            Tab::make('Localization')
                                ->schema([
                                    TextInput::make('timezone')
                                        ->label('Timezone')
                                        ->default('Asia/Jakarta')
                                        ->helperText('Zona waktu server dengan format Wilayah/Kota.')
                                        ->placeholder('Asia/Jakarta'),

                                    TextInput::make('locale')
                                        ->label('Locale')
                                        ->default('id')
                                        ->helperText('Kode bahasa aplikasi (ISO 639-1), contoh: "id" untuk Indonesia, "en" untuk Inggris.')
                                        ->placeholder('id'),

                                    TextInput::make('currency')
                                        ->label('Currency')
                                        ->default('IDR')
                                        ->helperText('Kode mata uang internasional (ISO 4217), contoh: IDR, USD, EUR.')
                                        ->placeholder('IDR'),
                                ]),

                            Tab::make('Operational')
                                ->schema([
                                    Toggle::make('maintenance_mode')
                                        ->label('Maintenance Mode')
                                        ->live()
                                        ->helperText('Jika diaktifkan, pengunjung akan melihat halaman "sedang perbaikan" alih-alih tampilan normal.'),

                                    Textarea::make('maintenance_message')
                                        ->label('Maintenance Message')
                                        ->rows(3)
                                        ->columnSpanFull()
                                        ->helperText('Pesan yang ditampilkan ke pengunjung saat mode maintenance aktif.')
                                        ->visible(fn($get) => $get('maintenance_mode')),
                                ]),
                        ]),
                ])
                    ->livewireSubmitHandler('save')
                    ->footer([
                        Actions::make([
                            Action::make('save')
                                ->label('Save Settings')
                                ->submit('save')
                                ->keyBindings(['mod+s']),
                        ]),
                    ]),
            ])
            ->record($this->getRecord())
            ->statePath('data');
    }

    public function save(): void
    {
        $data = $this->form->getState();

        $record = $this->getRecord();

        if (! $record) {
            $record = new AppSetting();
        }

        $record->fill($data);
        $record->save();

        Notification::make()
            ->title('Settings saved successfully')
            ->success()
            ->send();
    }

    public function getRecord(): ?AppSetting
    {
        return AppSetting::query()->find(1);
    }
}
