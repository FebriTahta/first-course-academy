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
    return view('landing.index');
});
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
Route::get('/forum-detail-pertanyaan/{slug}','ForumController@detailpertanyaan')->name('forum-detail');
Route::get('/download/{file}', 'BookController@getdownload')->name('download');
Route::post('/post-komentar', 'KomentarController@postkomen')->name('post-komentar');
Route::get('/berita','NewsController@display')->name('berita');
Route::get('/semua-kursus','KursusController@allkursus')->name('allkursus');
Route::get('/my-course/{slug}','MyCourseController@courseform')->name('myCourse');
Route::post('/daftar','AkunController@daftar')->name('daftar');
Route::post('/pertanyaan','ForumController@store')->name('pertanyaan');
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

Route::group(['middleware'=>['auth','checkrole:siswa,pengunjung']], function(){
    //new
    Route::get('kursus-saya','KursusSayaController@index')->name('kursus-saya');
    //old    
    Route::post('/submit-kuis','MyCourseController@submitkuis')->name('submit-kuis');    
    Route::get('/kuis-form/{id}','MyCourseController@kuisform');    
    Route::get('/akun','AkunController@index')->name('akun');
    Route::post('/ajukan-reset', 'MyCourseController@ajukanreset')->name('ajukan-reset');        
});