<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\{CartController, CheckoutController, KategoriController, ProdukController, StokController, UkuranController, DiskonController, EmailController, HomeController, HomeProdukController, HomeDetailProdukController,PesananController as PesananDashboardController};

use App\Http\Controllers\Pelanggan\{ProfileController, AlamatController, PesananController};
use App\Http\Controllers\Auth\RegisterController;
use App\Mail\OrderCreated;
use App\Notifications\OrderCreated as OrderNotification;
use App\Models\{Kategori, Provinsi};
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;

use Illuminate\Notifications\Messages\MailMessage;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// ONGKIR SECTION

Route::get('/update-provinsi', function () {

    $request =  Http::withHeaders([
        'key' => '173c617ab5ce3c42930854ce4ae0f1a2',
    ])->get('https://api.rajaongkir.com/starter/province');

    $tampung = [];

    $tampung = collect($request->json()['rajaongkir']['results'])->map(function ($item, $key) {

        return ['nama' => $item['province']];
    });

    DB::table('provinsi')->insert($tampung->toArray());
});

Route::get('/update-kota', function () {

    $request =  Http::withHeaders([
        'key' => '173c617ab5ce3c42930854ce4ae0f1a2',
    ])->get('https://api.rajaongkir.com/starter/city');

    $tampung = [];

    $tampung = collect($request->json()['rajaongkir']['results'])->map(function ($item, $key) {

        return ['nama' => $item['city_name'], 'provinsi_id' => $item['province_id'], 'nama_provinsi' => $item['province'], 'type' => $item['type'], 'kode_pos' => $item['postal_code']];
    });

    DB::table('kota')->insert($tampung->toArray());
});


Route::get('/cek-ongkir/{cek}', function ($cek, $id = null) {
    $cek = $cek;

    $request =  Http::withHeaders([
        'key' => '173c617ab5ce3c42930854ce4ae0f1a2',
    ])->get('https://api.rajaongkir.com/starter/' . $cek);

    dd($request->json());
});

Route::get('/ngide', function () {
    Artisan::call('storage:link');
});


// OUTSIDE SECTION
// Home - Index
Route::get('/', [HomeController::class, 'home'])->name('outside.home');

// Home - Products
Route::get('/products', [HomeProdukController::class, 'index'])->name('outside.products');

// Home - Product
Route::get('/product/{produk:slug}', [HomeDetailProdukController::class, 'index'])->name('outside.product');

// Cart
Route::get('/view-cart', [CartController::class, 'view']);
Route::get('/clear-cart', [CartController::class, 'delete']);
Route::get('/cart', [CartController::class, 'edit'])->name('outside.cart.edit');

// About
Route::get('/about', function () {
    return view('heydrown.about');
})->name('outside.about');

// Contact
Route::get('/contact', function () {
    return view('heydrown.contact');
})->name('outside.contact');


Route::get('/login', function () {
    return view('heydrown.auth.login');
});



// DASHBOARD SECTION 
// Dashboard
Route::get('/dashboard', function () {
    return view('heydrown.dashboard.index');
})->name('dashboard')->middleware('auth');

// Kategori
Route::prefix('dashboard')->name('dashboard.')->middleware('auth')->group(function () {
    Route::resource('kategori', KategoriController::class)->scoped(['kategori' => 'slug']);
});

// Produk
Route::prefix('dashboard')->name('dashboard.')->middleware('auth')->group(function () {
    Route::resource('produk', ProdukController::class)->scoped(['produk' => 'slug']);
});

// Stok
Route::prefix('dashboard')->name('dashboard.')->middleware('auth')->group(function () {
    // Route::resource('stok', StokController::class)->parameters(['stok' => 'produk'])->scoped(['produk' => 'slug']);
    Route::get('stok', [StokController::class, 'index'])->name('stok.index');
    Route::post('stok/updated-stok', [StokController::class, 'ajax'])->name('stok.ajax');
});

// Ukuran
Route::prefix('dashboard')->name('dashboard.')->middleware('auth')->group(function () {
    Route::resource('ukuran', UkuranController::class)->scoped(['ukuran' => 'slug']);
});

// Diskon
Route::prefix('dashboard')->name('dashboard.')->middleware('auth')->group(function () {
    Route::get('diskon/create', [DiskonController::class, 'redirectTo']);
    Route::get('diskon/create/{produk:slug}', [DiskonController::class, 'create'])->name('diskon.create');
    Route::resource('diskon', DiskonController::class)->parameters(['diskon' => 'produk'])->scoped(['produk' => 'slug'])->except(['create']);
});

// Transaksi
Route::prefix('dashboard')->name('dashboard.')->middleware('auth')->group(function () {
    Route::get('pesanan', [PesananDashboardController::class, 'index'])->name('pesanan.index');
    Route::get('pesanan/{pesanan:kode}', [PesananDashboardController::class, 'show'])->name('pesanan.show');
    Route::patch('pesanan/{pesanan:kode}',[PesananDashboardController::class,'update'])->name('pesanan.update');
    Route::put('pesanan/resi/{pesanan:kode}',[PesananDashboardController::class,'resi'])->name('pesanan.resi');
    Route::get('pesanan/cek/expired',[PesananDashboardController::class,'expired'])->name('pesanan.expired');
});



// MEMBER AREA SECTION
// Pelanggan - Profile
Route::prefix('pelanggan')->name('pelanggan.')->middleware('auth')->group(function () {
    Route::get('profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::patch('profile/update/{user:email}', [ProfileController::class, 'update'])->name('profile.update');
});

// Pelanggan - Adress
Route::prefix('pelanggan')->name('pelanggan.')->middleware('auth')->group(function () {
    Route::get('address', [AlamatController::class, 'index'])->name('alamat.index');
});

// Pelanggan - Order
Route::prefix('pelanggan')->name('pelanggan.')->middleware('auth')->group(function () {
    Route::get('orders', [PesananController::class, 'index'])->name('pesanan.index');
    Route::get('orders/{pesanan:kode}', [PesananController::class, 'show'])->name('pesanan.show');
});


Auth::routes();

// AUTH SOCIALITE SECTION
// Login Socialite Google
Route::get('/login/{website}', [LoginController::class, 'redirectToProvider'])->name('social.login');
Route::get('/login/{website}/callback', [LoginController::class, 'handleProviderCallback'])->name('social.callback');

// Register Socialite Google
Route::get('/register/create/google', [RegisterController::class, 'registerGoogle'])->name('register.google.create');
Route::post('/register/store/google', [RegisterController::class, 'storeUserGoogle'])->name('register.google.store');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// CHECKOUT SECTION
Route::prefix('checkout')->name('outside.')->middleware('auth')->group(function () {
    Route::get('', [CheckoutController::class, 'index'])->name('checkout.index');
});







Route::get('/send-email', [EmailController::class, 'sendEmail']);

Route::get('/cek-view-email', function () {
    return new OrderCreated(1);

    die;
    return (new MailMessage)->from(env('MAIL_FROM_ADDRESS'))
        ->subject('New Order Created')
        ->greeting('Tagihan PSN-02')
        ->line('Order ID : ')
        ->line('Thank you for using our application!')
        ->action('Go to Website', url('/'));
});
