<?php
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

Route::get('/', function () {
    $recent_course          = App\Kursus::inRandomOrder()->limit(3)->get();
    $recent_news            = App\News::orderBy('id','DESC')->limit(2)->get();
    $recent_instruktur      = App\User::inRandomOrder()->where('role','instruktur')->where('stat','1')->limit(3)->get();
    return view('landing.index2', compact('recent_course','recent_news','recent_instruktur'));
});
//testing new layouts
route::post('/get_search','HomeController@searching')->name('search');

Auth::routes(['verify'=>true]);
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/logout','HomeController@logout')->name('/logout');
Route::get('/profile/{id}','ProfileController@index')->name('profile');
Route::post('/store-profile','ProfileController@store')->name('storeProfile');
//detail result for admin & instruktur
Route::get('/detail-result-siswa/{id}/{user_id}','MyCourseController@detailresultsiswa');
//forum untuk semua user
Route::get('/forum','ForumController@index')->name('forum');
Route::get('/forum-daftar-pertanyaan/{slug_k}/{slug_m}','ForumController@daftarpertanyaan');
Route::get('/forum-daftar-pertanyaan/premium/{slug_k}/{slug_m}','ForumController@daftarpertanyaanP');
// Route::get('/forum-detail-pertanyaan/{slug}','ForumController@detailpertanyaan')->name('forum-detail');
//new_ui_forum
Route::get('/forums','ForumController@index2')->name('forums');
Route::get('/forums-daftar-pertanyaan/{slug_k}/{slug_m}','ForumController@daftarpertanyaans');
Route::get('/forums-detail-pertanyaan/{slug}','ForumController@detailpertanyaanss')->name('forums-detail');

Route::get('/download/{file}', 'BookController@getdownload')->name('download');
Route::post('/post-komentar', 'KomentarController@postkomen')->name('post-komentar');
Route::get('/berita','NewsController@display')->name('berita');
Route::get('/semua-kursus','KursusController@allkursus')->name('allkursus');
Route::get('/semua-instruktur','ProfileController@allinstruktur')->name('allinstruktur');
Route::get('/instruktur-info/{id}','ProfileController@detailinstruktur')->name('detailInstruktur');
Route::get('/news-detail/{id}','NewsController@index2')->name('newsDetail');

Route::post('/daftar','AkunController@daftar')->name('daftar');
Route::post('/pertanyaan','ForumController@store')->name('pertanyaan');
Route::post('/pertanyaanPremium','ForumController@storeP')->name('pertanyaanP');
Route::get('/komenbenar','ChangeStatus@komentarbenar')->name('benar');

Route::group(['middleware'=>['auth','checkrole:admin,instruktur']], function(){
    //report user
    Route::get('/user-export-pdf', 'LaporanController@userPDF')->name('userpdf');
    //dashboard
    Route::get('/dashboard','AdminDashboardController@index')->name('dashboard');
    //pengguna
    Route::resource('daftar_user','UserController');
    Route::post('/hapusUser','ProfileController@dell')->name('hapusUser');
    Route::get('/changeStatus','ChangeStatus@changestatus')->name('changestatus');
    Route::post('/aktifkankursus','ChangeStatus@aktifkankursus')->name('aktifkan');
    Route::post('/nonaktifkankursus','ChangeStatus@nonaktifankursus')->name('nonaktifkan');
    Route::post('/ubahpengguna','AkunController@ubahpengguna')->name('ubahpengguna');
    Route::get('/pengguna-belum-verifikasi','AkunController@notverif')->name('notverif');
    //kategori
    Route::get('/daftar-kategori','KategoriController@index')->name('daftarKategori');
    Route::post('/addMapel','KategoriController@storemapel')->name('addMapel');
    Route::post('/dellMapel','KategoriController@dellmapel')->name('dellMapel');
    Route::post('/addKelas','KategoriController@storekelas')->name('addKelas');
    Route::post('/dellKelas','KategoriController@dellkelas')->name('dellKelas');
    Route::post('/addKategoriKursus','KategoriController@storekategorikursus')->name('addKategori');
    Route::post('/dellKategoriKursus','KategoriController@dellkategori')->name('dellKategori');
    //kursus
    Route::get('/semua-kursus-admin','KursusController@allkursusadmin')->name('kursusAdmin');
    Route::get('/my-kursus','KursusController@mykursus')->name('my-kursus');
    Route::get('/daftar-kursus','KursusController@index')->name('daftarKursus');
    Route::post('/addKursus','KursusController@store')->name('addKursus');
    Route::get('/kursus/{slug}','KursusController@detail')->name('kursus');
    Route::post('/removeKursus','KursusController@remove')->name('removeKursus');
    //siswa dalam kursus
    Route::post('/removeSiswa','KursusController@removesiswa')->name('removeSiswa');
    Route::post('/addSiswaKursus','KursusController@addsiswa')->name('addSiswaKursus');
    //copy video encode decode tidak dipakai hanya tes belajar encode dan decode
    Route::get('/get_video_name','VideoController@get_video_name')->name('get_video_name');
    Route::get('/get_kelasId','VideoController@get_kelasId')->name('get_kelasId');
    Route::get('/get_mapelId','VideoController@get_mapelId')->name('get_mapelId');
    Route::get('/get_videoLink','VideoController@get_videoLink')->name('get_videoLink');
    Route::get('/get_slugV','VideoController@get_slugV')->name('get_slugV');
    //video
    Route::get('/my-video','VideoController@myvideo')->name('my-video');
    Route::post('/addVideo','VideoController@store')->name('addVideo');
    Route::post('/copyVideo','VideoControllerller@copy')->name('copyVideo');
    Route::post('/storecopyVideo','VideoController@storecopy')->name('storecopy');
    Route::post('/removeVideo','VideoController@removeVid')->name('removeVid');
    Route::post('/removeVideoPermanen', 'VideoController@removeVideoPermanen')->name('removeVideoPermanen');
    //kuis
    Route::get('/my-kuis','KuisController@mykuis')->name('my-kuis');
    Route::post('/addKuis','KuisController@store')->name('addKuis');
    Route::post('/salinKuis','KuisController@salin')->name('salinKuis');
    Route::post('/removeKuis','KuisController@remove')->name('removeKuis');
    Route::post('/hapusKuisPermanen', 'KuisController@hapusKuisPermanen')->name('hapusKuisPermanen');
    //book
    Route::get('/my-book','BookController@mybook')->name('my-book');
    Route::post('/addBook','BookController@store')->name('addBook');  
    Route::post('/salinBuku', 'BookController@salin')->name('salinBuku');  
    Route::post('/removeBuku', 'BookController@remove')->name('removeBuku');
    route::post('/hapusBukuPermanen', 'BookController@hapusBukuPermanen')->name('hapusBukuPermanen');
    //Soal
    Route::get('/create-soal/{slug}','SoalController@create')->name('createSoal');
    Route::get('/create-soals/{id}','SoalController@creates')->name('createSoals');
    Route::post('/storeSoal','SoalController@store')->name('storeSoal');
    Route::get('/detail-soal/{slug}','SoalController@detail')->name('detailSoal');
    Route::get('/details-soal/{id}','SoalController@details')->name('detailsSoal');
    Route::get('/edit-soal/{id}','SoalController@edit')->name('editSoal');
    Route::post('/update-soal/{id}','SoalController@update');
    //news
    Route::get('/news','NewsController@index')->name('news');
    Route::post('/post','NewsController@store')->name('postNews');
    Route::post('/remove' ,'NewsController@remove')->name('removeNews');
    Route::get('/editnews/{id}','NewsController@edit')->name('editNews');
    Route::post('/update/news','NewsController@update')->name('updateNews');
    //dashboard result
    Route::get('/detail-result/{slug}','MyCourseController@detailresult');
    Route::post('/reset-kuis','MyCourseController@resetkuis')->name('resetkuis');
    Route::get('/getreset','AdminDashboardController@getreset');
    //forum
    
            
});

Route::group(['middleware'=>['auth','checkrole:siswa,pengunjung,instruktur,admin']], function(){
        
    Route::get('/my-course/{slug}','MyCourseController@courseform')->name('myCourse');
    //video
    Route::get('/my-video/instruktur/{slug}','VideoController@myvideoinstruktur')->name('myvidInstruktur');
    //Kuis
    Route::get('/latihan-soal/instruktur/{slug}','KuisController@mykuisinstruktur')->name('mykuisInstruktur');
    Route::post('/tambah-latihan-soal','KuisController@store')->name('tambahkuis');
    Route::post('/hapus-latihan-soal','KuisController@hapuskuispermanen')->name('hapuskuis');
    Route::get('/kuis-form-latihan-soal/{slug}/{slug2}','MyCourseController@kuisform2')->name('kuisForm');
    Route::get('/detail-latihan-soal/{slug}','SoalController@detailkuiss');//kuis instruktur yang belom dimasukan ke kursus
    Route::get('/detail-latihan-soal/{slug}/{slug2}','SoalController@detailkuis')->name('detailKuis');//kuis instruktur yang sudah dimasukan ke kursus
    //soal
    Route::get('/buat-soal/{id}/{slug}','SoalController@createss')->name('buatSoals');
    Route::get('/edit-latihan-soal/{id}','SoalController@edits')->name('editSoals');
    Route::post('/update-latihan-soal/{id}','SoalController@updates')->name('updateSoals');
    //artikel
    Route::get('/artikel/instruktur/{slug}','ArtikelController@index')->name('myArtikel');
    Route::get('/artikel-create-new-artikel/{slug}','ArtikelController@create')->name('createArtikel');
    Route::post('/artikel/post','ArtikelController@store')->name('uploadArtikel');
    Route::get('/artikel/edit/{slug}/{slug2}','ArtikelController@edit')->name('editArtikel');
    Route::get('/artikel/{id}/{slug}','ArtikelController@detail')->name('artikels');
    Route::post('/add-artikel-kursus','ArtikelController@salin')->name('salinArtikel');
    Route::post('/remove-artikel','ArtikelController@remove')->name('removeArtikel');
    //book
    Route::post('/add-book','BookController@store')->name('addBook');
    //kuis
    Route::post('/submit-kuis','MyCourseController@submitkuis')->name('submit-kuis');        
    Route::get('/akun','AkunController@index')->name('akun');
    Route::post('/ajukan-reset', 'MyCourseController@ajukanreset')->name('ajukan-reset');
    route::get('/landing/land', 'ProfileController@landing')->name('landing');
    //formresetkuis
    route::get('/form-reset-kuis', 'MyCourseController@formreset')->name('formreset');
});