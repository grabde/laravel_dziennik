<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

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

Auth::routes();

//----------------------------------------------------------------ALL------------------------------------------------------

//[ALL] contact
Route::get('/contact_{suffix?}', function(){
    return view('contact'.session('suffix'));
});

//[All] show publications
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//[All] show publications
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//[ALL] mail compose
Route::post('/mail_compose', [App\Http\Controllers\HomeController::class, 'mail_compose'])->name('mail_compose');

//[ALL] send mail
Route::post('/send_mail', [App\Http\Controllers\HomeController::class, 'send_mail'])->name('send_mail');

//[ALL] mail received
Route::post('/mail_received', [App\Http\Controllers\HomeController::class, 'mail_received'])->name('mail_received');

//[ALL] mail sent
Route::post('/mail_sent', [App\Http\Controllers\HomeController::class, 'mail_sent'])->name('mail_sent');

//[ALL] show sent mail
Route::get('mail_{id_mail?}', function(String $id_mail){
    $mail = DB::table('mail')
    ->select('mail.*', 'users.name', 'users.surname')
    ->join('users', 'users.id', 'mail.id_to')
    ->where('id_mail', $id_mail)
    ->get();

    return view('show_sent_mail', ['mail' => $mail]);
});

//[ALL] show received mail
Route::get('received_{id_mail?}', function(String $id_mail){
    $mail = DB::table('mail')
    ->select('mail.*', 'users.name', 'users.surname')
    ->join('users', 'users.id', 'mail.id_to')
    ->where('id_mail', $id_mail)
    ->get();

    return view('show_received_mail', ['mail' => $mail]);
});

//[ALL] reply sent
Route::post('/reply_mail', [App\Http\Controllers\HomeController::class, 'reply_mail'])->name('reply_mail');

//[ALL] send reply mail
Route::post('/send_reply_mail', [App\Http\Controllers\HomeController::class, 'send_reply_mail'])->name('send_reply_mail');

//--------------------------------------------------------STUDENTS/PARENT--------------------------------------------------

//[Student, parents] list subjects
Route::get('/marks', [App\Http\Controllers\HomeController::class, 'marks'])->name('marks');
Route::post('/marks', [App\Http\Controllers\HomeController::class, 'marks'])->name('marks');

//[Student, parents] show notes
Route::get('/notes', [App\Http\Controllers\HomeController::class, 'notes'])->name('notes');
Route::post('/notes', [App\Http\Controllers\HomeController::class, 'notes'])->name('notes');

//[Student, parents] show schedule
Route::get('/schedule', [App\Http\Controllers\HomeController::class, 'schedule'])->name('schedule');
Route::post('/schedule', [App\Http\Controllers\HomeController::class, 'schedule'])->name('schedule');

//--------------------------------------------------------------TEACHER----------------------------------------------------

//[Teacher] when click marks list class
Route::get('/class_N&O', [App\Http\Controllers\HomeController::class, 'class_N_O'])->name('class_N_O');
Route::post('/class_N&O', [App\Http\Controllers\HomeController::class, 'class_N_O'])->name('class_N_O');

//[Teacher] when click persence list class
Route::get('/class_N&P', [App\Http\Controllers\HomeController::class, 'class_N_P'])->name('class_N_P');
Route::post('/class_N&P', [App\Http\Controllers\HomeController::class, 'class_N_P'])->name('class_N_P');

//[Teacher] when click notes list class
Route::get('/class_N&U', [App\Http\Controllers\HomeController::class, 'class_N_U'])->name('class_N_U');
Route::post('/class_N&U', [App\Http\Controllers\HomeController::class, 'class_N_U'])->name('class_N_U');

//[Teacher] when click on class return view with subjects or list students for notes
Route::get('/class_N_{id_class?}', function(String $id_class){
    session(['id_class' => $id_class]);
    switch (session('id_view')){
        case 'notes_ext':
            $students = DB::table('class')
            ->select('class.id_user', 'users.name', 'users.surname')
            ->join('users', 'users.id', 'class.id_user')
            ->where('class.id_class', session('id_class'))
            ->get();
            return view('list_students'.session('suffix'), ['students' => $students]);
        default:
            $subjects = DB::table('subject')
            ->get();
            return view('list_subjects'.session('suffix'), ['subjects' => $subjects]);
    }
});

//[Teacher] when click on subject return view generate in HomeController
Route::get('/subject_N_{id_subject?}', function(String $id_subject){
    
    //get students for class
    session(['id_subject' => $id_subject]);
    $students = DB::table('class')
    ->select('class.id_user', 'users.name', 'users.surname')
    ->join('users', 'users.id', 'class.id_user')
    ->where('class.id_class', session('id_class'))
    ->get();
    session(['sfm' => $students]);

    //name class
    $n_class = DB::table('class')
    ->select('class.name')
    ->where('class.id_class', session('id_class'))
    ->get();
    $var = $n_class[0]->name;
    session(['n_class' => $var]);

    //name subject
    $n_subject = DB::table('subject')
    ->select('subject.name')
    ->where('subject.id_subject', session('id_subject'))
    ->get();
    $var = $n_subject[0]->name;
    session(['n_subject' => $var]);

    //current date
    $date = Carbon::now();
    session(['current_date' => $date->format('Y-m-d')]);

    //types of marks
    $marks_types = DB::table('marks_types')
    ->get();
    session(['mtfm' => $marks_types]);

    //marks
    $marks = DB::table('marks')
    ->select('id_user', 'id_marks_types', 'value')
    ->where('id_subject', session('id_subject'))
    ->get();
    session(['marks' => $marks]);

    return view(session('id_view').session('suffix'), ['students' => $students, 'marks_types' => $marks_types]);
});

//[Student, parents] show marks for subject
Route::get('/subject{id_subject?}', function(String $id_subject){

    //student
    $students = DB::table('class')
    ->select('class.id_user', 'users.name', 'users.surname')
    ->join('users', 'users.id', 'class.id_user')
    ->where('id_user', session('id'))
    ->get();

    //marks
    $marks = DB::table('marks')
    ->select('id_user', 'id_marks_types', 'value')
    ->where('id_subject', $id_subject)
    ->where('id_user', session('id'))
    ->get();
    session(['marks' => $marks]);

    //name subject
    $n_subject = DB::table('subject')
    ->select('subject.name')
    ->where('subject.id_subject', $id_subject)
    ->get();
    $var = $n_subject[0]->name;
    session(['n_subject' => $var]);

    //types of marks
    $marks_types = DB::table('marks_types')
    ->get();
    session(['mtfm' => $marks_types]);

    return view('marks_ext'.session('suffix'), ['students' => $students, 'marks_types' => $marks_types]);
});

//[Teacher] when click student, show view to enter note
Route::get('/student_N_{id_student?}', function(String $id_student){
    session(['id_student' => $id_student]);
    $student = DB::table('users')
    ->select('users.name', 'users.surname')
    ->where('users.id', session('id_student'))
    ->get();
    $var = $student[0]->name;
    session(['student_name' => $var]);
    $var = $student[0]->surname;
    session(['student_surname' => $var]);
    return view('enter_note'.session('suffix'));
});

//[Teacher] enter note
Route::post('/enter_note', [App\Http\Controllers\HomeController::class, 'enter_note'])->name('enter_note');

//[Teacher] chosen date
Route::post('/chosen_date', [App\Http\Controllers\HomeController::class, 'chosen_date'])->name('chosen_date');

//[Teacher] enter presence
Route::post('/enter_presence', [App\Http\Controllers\HomeController::class, 'enter_presence'])->name('enter_presence');

//[Teacher] enter presence
Route::post('/enter_marks', [App\Http\Controllers\HomeController::class, 'enter_marks'])->name('enter_marks');


//--------------------------------------------------------------ADMIN-----------------------------------------------------

//[Admin] select user
Route::post('/select_user', [App\Http\Controllers\HomeController::class, 'select_user'])->name('select_user');

//[Admin] new user
Route::post('/new_user', [App\Http\Controllers\HomeController::class, 'new_user'])->name('new_user');
Route::get('/new_user', [App\Http\Controllers\HomeController::class, 'new_user'])->name('new_user');

//[Admin] when create student
Route::post('/create_user_U', [App\Http\Controllers\HomeController::class, 'create_user_U'])->name('create_user_U');

//[Admin] when create parent
Route::post('/create_user_R', [App\Http\Controllers\HomeController::class, 'create_user_R'])->name('create_user_R');

//[Admin] new user ext
Route::post('/new_user_ext', [App\Http\Controllers\HomeController::class, 'new_user_ext'])->name('new_user_ext');

//[Admin] change user
Route::post('/change_user', [App\Http\Controllers\HomeController::class, 'change_user'])->name('change_user');

//[Admin] when update data admin or teacher
Route::post('/update_AN', [App\Http\Controllers\HomeController::class, 'update_AN'])->name('update_AN');

//[Admin] when update data student
Route::post('/update_U', [App\Http\Controllers\HomeController::class, 'update_U'])->name('update_U');

//[Admin] when update data parent
Route::post('/update_R', [App\Http\Controllers\HomeController::class, 'update_R'])->name('update_R');

//[Admin] list users to mark to delete
Route::post('/list_users_tmtd', [App\Http\Controllers\HomeController::class, 'list_users_tmtd'])->name('list_users_tmtd');

//[Admin] del user
Route::post('/del_user', [App\Http\Controllers\HomeController::class, 'del_user'])->name('del_user');

//[Admin] new publication
Route::post('/new_publication', [App\Http\Controllers\HomeController::class, 'new_publication'])->name('new_publication');

//[Admin] create publication
Route::post('/create_publication', [App\Http\Controllers\HomeController::class, 'create_publication'])->name('create_publication');

//[Admin] change publication
Route::post('/change_publication', [App\Http\Controllers\HomeController::class, 'change_publication'])->name('change_publication');

//[Admin] when click publication
Route::get('/publication_{id?}', function(String $id){
    $publication = DB::table('publication')
    ->where('id_publication', $id)
    ->get();

    return view('change_data_publication'.session('suffix'), ['publication' => $publication]);
});

//[Admin] update publication
Route::post('/update_publication', [App\Http\Controllers\HomeController::class, 'update_publication'])->name('update_publication');

//[Admin] list publication
Route::post('/list_publication', [App\Http\Controllers\HomeController::class, 'list_publication'])->name('list_publication');

//[Admin] del publication
Route::post('/del_publication', [App\Http\Controllers\HomeController::class, 'del_publication'])->name('del_publication');